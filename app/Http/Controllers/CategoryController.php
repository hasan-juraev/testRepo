<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
{
    // AllCat method
    public function AllCat(){

        # Query builder
        // $categories = DB::table('categories')
        //     ->join('users', 'categories.user_id', 'users.id')
        //     ->select('categories.*', 'users.name')
        //     ->latest()->paginate(5);

        # Eloquent ORM
        // $categories = Category::latest()->get();
        $categories = Category::latest()->paginate(5);
        $trashCat = Category::onlyTrashed()->latest()->paginate(3);

        // pagination with Query Builder
        // $categories = DB::table('categories')->latest()->paginate(2);

        return view('category.index', compact('categories', 'trashCat'));
    }

    public function AddCat(Request $request){

        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
            
        ],
        [
            'category_name.required' => 'Please Input Category Name',
            
        ]);

        // after form validation
        // 1st method
        Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id, 
            'created_at' => Carbon::now()
        ]);
        
        // 2nd method to insert data into DB
        // $category = new Category();
        // $category->category_name = $request->category_name;
        // $category->user_id = Auth::user()->id;
        // $category->save();

        // 3rd method Insert data using Query Builder
        // $data = array();
        // $data['category_name'] = $request -> category_name;
        // $data['user_id'] = Auth::user() -> id;
        // DB::table('categories') -> insert($data);

        // user will be redirecte to the back page which is index.php
        return Redirect()->back()->with('success','Category inserted successfuly');
    }

    // Function Edit is made using Eloquent ORM
    public function Edit($id)
    {
        # Eloquent ORM
        # $categories = Category::find($id);

        # Query Builder
        $categories = DB::table('categories')-> where('id', $id)->first();

        return view('category.edit', compact('categories'));
    }

    // Function Edit is made using Eloquent ORM
    public function Update(Request $request, $id)
    {
        # Eloquent ORM
        // $update = Category::find($id)->update([
        //     'category_name' => $request->category_name,
        //     'user_id' => Auth::user()->id

        // ]);


        # Query Builder
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->where('id', $id)->update($data);

        return Redirect()->route('all.category')->with('success', 'Category Updated Successfully!');
    }

    public function SoftDelete($id){

        $delete = Category::find($id)->delete();
        return Redirect()->back()->with('success', 'Category Soft Deleted Successfully');
        
    }

    public function Restore($id){
        $delete = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success', 'Cateogry Restored Successfully');
    }

    public function Pdelete($id){
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success', 'Category Permanently Deleted');
    }

   

    
}