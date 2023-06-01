@extends('layouts.admin')

@section('admin_content')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Brand</h1>
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
                                <h3 class="card-title">All Brand List Here</h3>
                            </div>
                            <!-- /.card-header -->
                            <table id="" class="table table-bordered table-striped table-sm ytable">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Brand Name</th>
                                    <th>Brand Slug</th>
                                    <th>Brand Logo</th>
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
                    <h5 class="modal-title" id="staticBacdropLabel">Add New Brand</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{route('brand.store')}}" method="Post" enctype="multipart/form-data" id="add-form">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="brand_name"> Brand Name</label>
                            <input type="text" class="form-control" id="subcategory_name" name="brand_name" required="">
                            <small id="emailHelp" class="form-text text-muted">This is your Brand</small>
                        </div>
                        <div class="form-group">
                            <label for="brand_logo"> Brand Logo</label>
                            <input type="file" class="dropify"  id="input-file-now" data-height="150" name="brand_logo" required="">
                            <small id="emailHelp" class="form-text text-muted">This is your Brand Logo</small>
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
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Brand</h5>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>

    <script type="text/javascript">
        $('.dropify').dropify();
    </script>

    <script type="text/javascript">

        $(function childcategory(){
            var table=$('.ytable').DataTable({
                processing:true,
                serverSide:true,
                ajax:"{{ route('brand.index') }}",
                columns:[
                    {data:'DT_RowIndex'  ,name:'DT_RowIndex'},
                    {data:'brand_name'  ,name:'brand_name'},
                    {data:'brand_slug'  ,name:'brand_slug'},
                    {data:'brand_logo'  ,name:'brand_logo',render: function(data, type, full, meta){
                        return "<img src=\"" +data+ "\" height=\"40\" />";
                        }},
                    {data:'action',name: 'action',orderable:true,searchable:true},

                ],

            });
        });
        $('body').on('click','.edit',function(){
            let id=$(this).data('id');
            $.get("brand/edit/"+id, function(data){
                $("#modal_body").html(data);

            });
        });
    </script>

@endsection
