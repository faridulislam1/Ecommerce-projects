<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Illuminate\Support\Str;
use Image;
use File;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
//        dd('hellow world');
        if ($request->ajax()) {

            $data=DB::table('brands')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $actionbtn='<a href="#" class="btn btn-info btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>
                            <a href="'.route('brand.delete',[$row->id]).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i></a>';
                    return $actionbtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.category.brand.index');

    }
    public function store(Request $request){
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|max:55',
        ]);
        $slug=Str::slug($request->brand_name, '-');

        $data= array();
        $data['brand_name']=$request->brand_name;
        $data['brand_slug']=Str::slug($request->brand_name, '-');
        //working with image
        $photo=$request->brand_logo;
        $photoname=$slug.'.'.$photo->getClientOriginalExtension();
        $photo->move('public/files/brand/',$photoname);

        $data['brand_logo']='public/files/brand/'.$photoname; //.jpg
        DB::table('brands')->insert($data);

        $notification=array('message' => 'Brand Inserted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    public function destroy($id){
        $data=DB::table('brands')->where('id',$id)->first();
        $image=$data->brand_logo;
        if(File::exists($image)){
            unlink($image);
        }
        DB::table('brands')->where('id',$id)->delete();
        $notification=array('message' => 'Brand Deleted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    public function edit($id){
        $data=DB::table('brands')->where('id',$id)->first();
        return view('admin.category.brand.edit',compact('data'));
    }
    public function update(Request $request){
        $slug=Str::slug($request->brand_name, '-');
        $data= array();
        $data['brand_name']=$request->brand_name;
        $data['brand_slug']=Str::slug($request->brand_name, '-');
        if($request->brand_logo) {
            if(File::exists($request->old_logo)) {
                unlink($request->old_logo);
            }
            $photo=$request->brand_logo;
            $photoname=$slug.'.'.$photo->getClientOriginalExtension();
            $photo->move('public/files/brand/',$photoname);
            $data['brand_logo']='public/files/brand/'.$photoname; //.jpg
            DB::table('brands')->where('id',$request->id)->update($data);
            $notification=array('message' => 'Brand updated!', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
        else{
            $data['brand_logo']=$request->old_logo;
            DB::table('brands')->where('id',$request->id)->update($data);
            $notification=array('message' => 'Brand updated!', 'alert-type' => 'success');
            return redirect()->back()->with($notification);

        }
    }
}
