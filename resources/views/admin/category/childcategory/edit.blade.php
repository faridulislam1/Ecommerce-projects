<form action="{{route('childcategory.update')}}" method="Post" id="add-form">
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
                            <option value="{{$row->id}}" @if ($row->id==$data->subcategory_id) selected @endif>{{$row->subcategory_name}} </option>
                        @endforeach
                    </optgroup>
                @endforeach

            </select>
        </div>
        <input type="hidden" name="id" value="{{$data->id}}">
        <div class="form-group">
            <label for="category_name"> Child Category Name</label>
            <input type="text" class="form-control" id="subcategory_name" name="childcategory_name" required="" value="{{$data->childcategory_name}}">
            <small id="emailHelp" class="form-text text-muted">This is your Childcategory</small>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary"><span class="d-none">loading.......</span>Update</button>
    </div>
</form>