<?php

namespace App\Http\Controllers\Admin;

use App\MenuCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuCategoriesController extends Controller
{
    public function index()
    {
        return view('admin.menu_categories.index');
    }

    public function get(Request $request)
    {
        $columns = ['name'];
        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');
        $query = MenuCategory::select('id', 'name')->orderBy($columns[$column], $dir);
        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%');
            });
        }
        $menuCategories = $query->paginate($length);

        return ['data' => $menuCategories, 'draw' => $request->input('draw')];
    }

    public function create()
    {
        $menuCategory = new MenuCategory();

        $routeAction = ['admin.menu_categories.add.post'];

        return view('admin.menu_category.add_edit', compact('menuCategory', 'routeAction'));
    }

    public function store(Request $request)
    {
        $menuCategory = new MenuCategory();

        $menuCategory->fill($request->all());
        $menuCategory->save();

        return redirect(route('admin.menu_categories.index'));
    }

    public function edit($id)
    {
        $menuCategory = MenuCategory::find($id);

        $routeAction = [
            'admin.menu_categories.edit.post',
            $menuCategory->id
        ];

        return view('admin.menu_category.add_edit', compact('menuCategory', 'routeAction'));
    }

    public function update(Request $request, $id)
    {
        $menuCategory = MenuCategory::find($id);

        $menuCategory->fill($request->all());
        $menuCategory->save();

        return redirect(route('admin.menu_categories.index'));
    }

    public function destroy(Request $request, $id)
    {
        $menuCategory = MenuCategory::find($id);
        $menuCategoryData['name'] = $menuCategory->name;
        $menuCategoryData['id'] = $menuCategory->id;

        $menuCategory->delete();

        return ['data' => $menuCategoryData, 'draw' => $request->input('draw')];
    }
}
