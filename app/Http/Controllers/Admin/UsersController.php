<?php

namespace App\Http\Controllers\Admin;

use App\User;
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
                    ->orWhere('birthday', 'like', '%' . $searchValue . '%');
            });
        }
        $users = $query->paginate($length);
        return ['data' => $users, 'draw' => $request->input('draw')];
    }

    public function create()
    {
        $user = new User();
        $routeAction = route('admin.users.add.post');

        return view('admin.users.add_edit', compact('user', 'routeAction'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $routeAction = [
            'admin.users.edit.post',
            $user->id
        ];

        return view('admin.users.add_edit', compact('user', 'routeAction'));
    }

    public function destroy(Request $request, $id)
    {
        $user = User::find($id);
        $userData['fullname'] = $user->fullname;

        $user->delete();

        return ['data' => $userData, 'draw' => $request->input('draw')];
    }
}
