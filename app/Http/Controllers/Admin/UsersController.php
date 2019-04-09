<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UsersDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('admin.index');
    }
}
