@csrf
<div class="form-group">
    <label class="col-form-label">Name</label>
    <input class="form-control" type="text" name="title" placeholder="Slider title" required value="{{old('title', isset($slider)?$slider->title:'')}}">
</div>

<div class="form-group">
    <label class="col-form-label">Body</label>
    <textarea id="summernote" class="form-control" name="body" cols="30" rows="10">{{old('body', isset($slider)?$slider->body:'')}}</textarea>
</div>
