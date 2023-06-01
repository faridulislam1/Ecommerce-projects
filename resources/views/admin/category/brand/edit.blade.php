
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">

<form action="{{route('brand.update')}}" method="Post" enctype="multipart/form-data" id="add-form">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="brand_name">Edit Brand </label>
            <input type="text" class="form-control" id="subcategory_name" name="brand_name" value="{{$data->brand_name}}">
            <small id="emailHelp" class="form-text text-muted">This is your Brand</small>
        </div>
        <input type="hidden" name="id" value="{{$data->id}}">
        <div class="form-group">
            <label for="brand_logo"> Brand Logo</label>
            <input type="file" class="dropify"  data-height="150" name="brand_logo" >
            <input type="hidden" name="old_logo" value="{{$data->brand_logo}}">
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary"><span class="d-none">loading.......</span>Update</button>
    </div>
</form>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>

<script type="text/javascript">
    $('.dropify').dropify();
</script>