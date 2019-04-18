<?php
namespace App\Http\Services;

use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Laravolt\Avatar\Facade as Avatar;

class Avatars
{
    public function createRandomAvatar($savePath, $user)
    {

        if (!file_exists($savePath)) {
            Avatar::create($user->fullname)->save($savePath);
        }
    }

    public function uploadAvatar($savePath, $pathname)
    {
        $img = Image::make($pathname)->orientate();
        $img->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $img->resizeCanvas(100, 100);

        $img->save($savePath);
    }
}
