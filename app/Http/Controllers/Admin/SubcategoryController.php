<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;


class SubcategoryController extends Controller
{
    private $category;
    public function __construct()
    {
        $this->middleware('auth');
    }

    //index method for read data
    public function index(){
        //query builder
//        $data=DB::table('subcategories')->leftJoin('categories','subcategories.category_id','categories.id')
//            ->select('subcategories.*','categories.category_name')->get();

        //Elequent orm
        $data=Subcategory::all();
        $category=Category::all();
        return view('admin.category.subcategory.index',compact('data','category'));
    }
    //store method
    public function store(Request $request){
        $validated = $request->validate([
            'subcategory_name' => 'required|max:255',
            ]);
        $data= array();
        $data['category_id']=$request->category_id;
        $data['subcategory_name']=$request->subcategory_name;
        $data['subcat_slug']=$slug = Str::slug($request->subcategory_name, '-');
       DB::table('subcategories')->insert($data);

        $notification=array('message' => 'SubCategory Inserted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    public function destroy($id){
        $category=Subcategory::find($id);
        $category->delete();

        $notification=array('message' => 'SubCategory Deleted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    //edit subcategory
    public function edit ($id){
        $data=Subcategory::find($id);
        $category=Category::all();
        return view('admin.category.subcategory.edit',compact('data','category'));
    }

    //subcategory update
    public function update(Request $request){
//        $subcategory=Subcategory::where('id',$request->id)->first();
//        $subcategory->update([
//            'category_id'=>$request->category_id,
//            'subcategory_name'=>$request->subcategory_name,
//            'subcat_slug'=>Str::slug($request->subcategory_name, '-')
//           ]);

        $data= array();
        $data['category_id']=$request->category_id;
        $data['subcategory_name']=$request->subcategory_name;
        $data['subcat_slug']=$slug = Str::slug($request->subcategory_name, '-');
        DB::table('subcategories')->where('id',$request->id)->update($data);

        $notification=array('message' => 'SubCategory Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
