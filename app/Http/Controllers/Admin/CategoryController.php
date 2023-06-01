<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //Category showing method
    public function index(){
       // $data=DB::table('categories')->get();
        $data=Category::all();
        return view('admin.category.category.index',compact('data'));
    }
    //category Method
    public function store(Request $request){
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ]);


        Category::insert([
            'category_name'=>$request->category_name,
            'category_slug'=>$slug = Str::slug($request->category_name, '-')

        ]);
        $notification=array('message' => 'Category Inserted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);

    }

    //edit method
    public function edit($id){
        $data=Category::find($id);
        return response ()->json($data);
    }

    //update method

    public function update(Request $request){
        $category=Category::where('id',$request->id)->first();
        $category->update([
            'category_name'=>$request->category_name,
            'category_slug'=>$slug = Str::slug($request->category_name, '-')


        ]);
        $notification=array('message' => 'Category Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    //delete  Method
    public function destroy($id){
        $category=Category::find($id);
        $category->delete();

        $notification=array('message' => 'Category Deleted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
