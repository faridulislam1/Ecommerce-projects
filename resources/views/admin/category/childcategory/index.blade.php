@extends('layouts.admin')

@section('admin_content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> Child Category</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">+ Add New</button>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Child Category List Here</h3>
                            </div>
                            <!-- /.card-header -->
                            <table id="" class="table table-bordered table-striped table-sm ytable">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>ChildCategory Name</th>
                                    <th>Category Name</th>
                                    <th>SubCategory Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    {{--    //category insert modal uses--}}
    <!-- Modal -->
    <div class="modal fade" id="addModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBacdropLabel">Add New Child Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{route('childcategory.store')}}" method="Post" id="add-form">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="category_name">Category/SubCategory Name</label>
                            <select class="form-control" name="subcategory_id" required="">

                                @foreach($category as $row)
                                    @php
                                    $subcat=DB::table('subcategories')->where('category_id',$row->id)->get();
                                    @endphp
                                    <optgroup label="{{$row->category_name}}">

                                   @foreach($subcat as $row)
                                       <option value="{{$row->id}}">{{$row->subcategory_name}} </option>
                                @endforeach
                                    </optgroup>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="category_name"> Child Category Name</label>
                            <input type="text" class="form-control" id="subcategory_name" name="childcategory_name" required="">
                            <small id="emailHelp" class="form-text text-muted">This is your Childcategory</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><span class="d-none">loading.......</span>Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{--Edit modal--}}
    <div class="modal fade" id="editModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Child Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="modal_body">

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

    <script type="text/javascript">

        $(function childcategory(){
            var table=$('.ytable').DataTable({
              processing:true,
              serverSide:true,
               ajax:"{{ route('childcategory.index') }}",
               columns:[
                   {data:'DT_RowIndex'  ,name:'DT_RowIndex'},
                    {data:'childcategory_name'  ,name:'childcategory_name'},
                     {data:'category_name'  ,name:'category_name'},
                     {data:'subcategory_name'  ,name:'subcategory_name'},
                     {data:'action',name: 'action',orderable:true,searchable:true},

             ],

         });
       });

        $('body').on('click','.edit',function(){
            let id=$(this).data('id');
            $.get("childcategory/edit/"+id, function(data){
                $("#modal_body").html(data);

            });
        });
    </script>

@endsection
