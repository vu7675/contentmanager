@csrf
<div class="row">
    <div class="col-9">
        <div class="form-group">
            <label class="col-form-label">Name</label>
            <input class="form-control" type="text" name="title" placeholder="Post title" required value="{{old('title', isset($post)?$post->title:'')}}">
        </div>
        <div class="form-group">
            <label class="col-form-label">Description</label>
            <input class="form-control" type="text" name="description" placeholder="Description" required value="{{old('description', isset($post)?$post->description:'')}}">
        </div>
        <div class="form-group">
            <label class="col-form-label">Body</label>
            <textarea id="summernote" class="form-control" name="summer_note" cols="30" rows="10">{{old('summer_note', isset($post)?$post->body:'')}}</textarea>
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <label class="col-form-label">Post cover</label><br>
            <input type="file" name="cover"><br><br>
            @if(isset($post))
                <img src="{{$post->getCover()}}" alt="{{$post->title}}" class="img-fluid img-thumbnail">
            @endif
        </div>
        <div class="form-group">
            <label class="col-form-label">Categories</label>
            <select name="categories[]" class="form-control select2" multiple="multiple">
                @foreach($categories as $category)
                    <option value="{{$category->id}}"
                    @if(collect(old('categories', !isset($post)?:$post->categories->pluck('id')->toArray()))->contains($category->id)==true)
                        selected
                    @endif
                    >{{$category->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
