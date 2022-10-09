@csrf
<div class="row">
    <div class="col-md-8">
        <div class="form-group mb-3">
            {{--  if you went to stay all value in form use old() in value  --}}
            <label for="name">Category Name</label>
            <input type="text" id="name" value="{{ old('name',$category->name) }}" name="name"
                class="form-control    @error('name') is-invalid @enderror">
            {{--  @if ($errors->has('name'))
            <p class="text-danger">{{ $errors->first('name') }}</p>
            @endif  --}}
            @error('name')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="parent_id">Parent ID</label>
            <select type="text" id="parent_id" name="parent_id"
                class="form-control  @error('parent_id') is-invalid @enderror ">
                <option value="">No Parent</option>
                @foreach ($parents as $parent)
                    <option value="{{ $parent->id }}" @if ($parent->id == old('parent_id',$category->parent_id)) selected @endif>
                        {{ $parent->name }}</option>
                @endforeach
            </select>
            @error('parent_id')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="description">Category Description</label>
            <textarea type="text" id="description" name="description"
                class="form-control  @error('description') is-invalid @enderror">
                {{ old('description',$category->description) }}
        </textarea>
            @error('description')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label for="image">Thumbnail</label>
            <input type="file" id="image" name="image"
                class="form-control  @error('image') is-invalid @enderror">
            @error('image')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group mb-3">
            <button type="submit" class="btn btn-primary">{{ $button }}</button>
            <a href="{{ route('dashboard.categories.index') }}" class="btn btn-light">Cancel</a>
        </div>
    </div>
</div>
