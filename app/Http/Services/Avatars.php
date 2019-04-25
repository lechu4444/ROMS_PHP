<?php
namespace App\Http\Services;

use App\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Laravolt\Avatar\Facade as Avatar;

class Avatars
{
    protected $avatarsConfig;
    protected $laravoltConfig;

    public function __construct()
    {
        $this->avatarsConfig = Config::get('constants.avatars');
        $this->laravoltConfig = Config::get('laravolt.avatar');
    }

    /**
     * @param User $user
     *
     * This function create new avatar for user via Laravolt Library and save it to public directory
     */
    public function createRandomAvatar($user)
    {
        $savePath = $this->avatarsConfig['save_path']
            . $user->id . '.'
            . $this->avatarsConfig['file_extension'];

        if (!file_exists($savePath)) {
            Avatar::create($user->fullname)->save($savePath);
        }
    }

    /**
     * @param string $filename
     * @param string $pathname
     *
     * This function gives possibility to save uploaded avatar in public directory
     */
    public function uploadAvatar($user)
    {
        $width = $this->laravoltConfig['width'];
        $height = $this->laravoltConfig['height'];

        $pathname = Input::file('avatar');

        $savePath = $this->avatarsConfig['save_path']
            . $user->id . '.'
            . $this->avatarsConfig['file_extension'];

        $img = Image::make($pathname)->orientate();
        $img->encode('png');
        $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $img->resizeCanvas($width, $height);

        $mask = Image::canvas($width, $height);
        $mask->circle($width, $width/2, $height/2, function ($draw) {
            $draw->background('#fff');
        });

        $img->mask($mask, false);
        $img->save($savePath);
    }
}
