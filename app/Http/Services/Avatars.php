<?php
namespace App\Http\Services;

use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Laravolt\Avatar\Facade as Avatar;

class Avatars
{
    protected function createRandomAvatar($user, $savePath)
    {
        Avatar::create($user->fullname)->save($savePath);
    }

    public function uploadAvatar($user, Request $request)
    {
        $savePath = public_path('data/avatars/' . $user->id . '.png');

        if ($request->hasFile('avatar')) {
            if ($request->file('avatar')->isValid()) {
                $pathname = $request->file('input_photo')->getPathname();

                $img = Image::make($pathname)->orientate();
                $img->resize(100, 100, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $img->resizeCanvas(100, 100);
            }
        } else {
            if (!file_exists($savePath)) {
                $this->createRandomAvatar($user, $savePath);
            }
        }
    }
}
