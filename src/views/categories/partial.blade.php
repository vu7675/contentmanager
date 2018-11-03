@csrf
<div class="form-group">
    <label class="col-form-label">Name</label>
    <input class="form-control" type="text" name="title" placeholder="Category title" required value="{{old('title', isset($category)?$category->title:'')}}">
</div>

<div class="form-group">
    <label class="col-form-label">Body</label>
    <textarea id="summernote" class="form-control" name="body" cols="30" rows="10">{{old('body', isset($category)?$category->body:'')}}</textarea>
</div>
