@extends('layouts.admin')

@section('admin_content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Category</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                          <button class="btn btn-primary" data-toggle="modal" data-target="#categoryModal">+ Add New</button>
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
                                <h3 class="card-title">All Category List Here</h3>
                            </div>
                            <!-- /.card-header -->
                            <table id="example1" class="table table-bordered table-striped table-sm">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Category Name</th>
                                    <th>Category Slug</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $key=>$row)
                                <tr>
                                    <td>{{$key +1}}</td>
                                    <td>{{$row->category_name}}</td>
                                    <td>{{$row->category_slug}}</td>
                                    <td>
                                        <a href="#" class="btn btn-info btn-sm edit" data-id="{{$row->id}}" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>
                                        <a href="{{route('category.delete',$row->id)}}" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
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
    <div class="modal fade" id="categoryModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add New Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{route('category.store')}}" method="Post">
                    @csrf
                <div class="modal-body">

                        <div class="form-group">
                            <label for="category_name">Category Name</label>
                            <input type="text" class="form-control" id="category_name" name="category_name" required="">
                            <small id="emailHelp" class="form-text text-muted">This is your Main Category</small>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
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
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{route('category.update')}}" method="Post">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="category_name">Add Category </label>
                            <input type="text" class="form-control" id="e_category_name" name="category_name" required="">
                            <input type="hidden" class="form-control" id="e_category_id" name="id">
                            <small id="emailHelp" class="form-text text-muted">This is your Main Category</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script type="text/javascript">

            $('body').on('click','.edit',function(){
                let cat_id=$(this).data('id');
                $.get("category/edit/" +cat_id, function(data){
                     $('#e_category_name').val(data.category_name);
                    $('#e_category_id').val(data.id);
                });
            });

    </script>

@endsection
