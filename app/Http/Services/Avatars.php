<?php
namespace App\Http\Services;

use App\User;
use Illuminate\Support\Facades\Config;
use Intervention\Image\Facades\Image;
use Laravolt\Avatar\Facade as Avatar;

class Avatars
{
    protected $avatarsConfig;

    public function __construct()
    {
        $this->avatarsConfig = Config::get('constants.avatars');
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
    public function uploadAvatar($filename, $pathname)
    {
        $savePath = $this->avatarsConfig['save_path']
            . $filename
            . $this->avatarsConfig['file_extension'];

        $img = Image::make($pathname)->orientate();
        $img->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $img->resizeCanvas(100, 100);

        $img->save($savePath);
    }
}
