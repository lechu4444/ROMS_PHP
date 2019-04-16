<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Services\Avatars;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function getData(Request $request)
    {
        $columns = ['name', 'surname', 'birthday', 'email'];
        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');
        $query = User::select('id','name', 'surname', 'birthday', 'email')->orderBy($columns[$column], $dir);
        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%')
                    ->orWhere('surname', 'like', '%' . $searchValue . '%')
                    ->orWhere('email', 'like', '%' . $searchValue . '%')
                    ->orWhere('birthday', 'like', '%' . $searchValue . '%');
            });
        }
        $users = $query->paginate($length);
        return ['data' => $users, 'draw' => $request->input('draw')];
    }

    public function create()
    {
        $user = new User();
        $user->birthday = '1990-01-01';
        $maxYear = Carbon::now()->format('Y');

        $routeAction = ['admin.users.add.post'];

        return view('admin.users.add_edit', compact('user', 'routeAction', 'maxYear'));
    }

    public function store(StoreUserRequest $request, Avatars $avatars)
    {
        $user = new User();
        $user->fill($request->only(['name', 'surname', 'birthday', 'email']));

        if(!is_null($request->password)) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        $avatars->uploadAvatar($user, $request);

        return redirect(route('admin.users.index'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $maxYear = Carbon::now()->format('Y');

        $routeAction = [
            'admin.users.edit.post',
            $user->id
        ];

        return view('admin.users.add_edit', compact('user', 'routeAction', 'maxYear'));
    }

    public function update(UpdateUserRequest $request, Avatars $avatars, $id)
    {
        $user = User::findOrFail($id);
        $user->fill($request->only(['name', 'surname', 'birthday', 'email']));

        if(!is_null($request->password)) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        $avatars->uploadAvatar($user, $request);

        return redirect(route('admin.users.index'));
    }

    public function destroy(Request $request, $id)
    {
        $user = User::find($id);
        $userData['fullname'] = $user->fullname;

        $user->delete();

        return ['data' => $userData, 'draw' => $request->input('draw')];
    }
}
