<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Auth;

class CategoryController extends Controller
{
    public function all_category()
    {
    	$category = Category::all();
    	return view('product.categories.all',compact('category'));
    }
    public function add_category()
    {
    	return view('product.categories.add');
    }
    public function save_category(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2|unique:categories',
        ]);
        $user_id = Auth::user()->id;
        $category = new Category;
        $category->fill($request->all());
        \LogActivity::addToLog([
            'data' => 'Menambahkan Category ' . $request->name,
            'user' => $user_id,
        ]);
        $result = $category->save();
        if ($result) {
            alert()->success('Category Successfully Added', 'Success');
            return redirect('/categoryall');
        } else {
            alert()->error('Category Failed Added', 'Success');
            return back();
        }
    }
    public function edit_category($category_id)
    {
        $category = Category::findOrFail($category_id);
        return view('product.categories.edit', compact('category'));
    }
    public function update_category(Request $request, $category_id)
    {
        $this->validate($request, [
            'name' => 'required|min:2',
        ]);
        $user_id = Auth::user()->id;
        $category = Category::find($category_id);
        $category->fill($request->all());
        \LogActivity::addToLog([
            'data' => 'Update Category ' . $request->name,
            'user' => $user_id,
        ]);
        $category->update();
        alert()->success('Category Successfully Updated', 'Success');
        return redirect('/categoryall');
    }

    public function delete_category(Request $request,$category_id)
    {
        $user_id = Auth::user()->id;
        $category = Category::find($category_id);
        \LogActivity::addToLog([
            'data' => 'Delete Category ' . $request->name,
            'user' => $user_id,
        ]);
        $category->delete();
        alert()->success('Category Successfully Deleted', 'Success');
        return back();
    }

}
