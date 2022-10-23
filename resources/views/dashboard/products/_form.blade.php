@csrf
<div class="row">
    <div class="col-md-8">
        <div class="form-group mb-3">
            {{--  if you went to stay all value in form use old() in value
            <label for="name">products Name</label>
            <input type="text" id="name" value="{{ old('name', $products->name) }}" name="name"
                class="form-control    @error('name') is-invalid @enderror">
            {{--  @if ($errors->has('name'))
            <p class="text-danger">{{ $errors->first('name') }}</p>
            @endif  --}}
            {{--  @error('name')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror  --}}
            <x-form.input name="name" required="1" id="name" label="Product Name" :value="$products->name " />
        </div>
        <div class="form-group mb-3">
            <label for="category_id">category ID</label>
            <select type="text" id="category_id" name="category_id"
                class="form-control  @error('category_id') is-invalid @enderror ">
                <option value="">No category</option>
                @foreach (category::all() as $category)
                    <option value="{{ $category->id }}" @if ($category->id == old('category_id', $products->category_id)) selected @endif>
                        {{ $category->name }}</option>
                @endforeach
            </select>
            @error('parent_id')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-row">
            <div class="col-md-4">
                <div class="form-groub mb-3">
                    <x-form.input type="number" step="0.1" label="Price" name="price" id="price" :value="$products->price " />
{{--
                    <label for="price">price</label>
                    <input type="number" step="0.1" id="price" value="{{ old('price', $products->price) }}"
                        name="price" class="form-control    @error('price') is-invalid @enderror">
                    @error('price')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror  --}}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-groub mb-3">
                    {{--  if you went to stay all value in form use old() in value  --}}
                    {{--  <label for="compare_price">Compare price</label>
                    <input type="number" step="0.1" id="compare_price"
                        value="{{ old('compare_price', $products->compare_price) }}" name="compare_price"
                        class="form-control    @error('compare_price') is-invalid @enderror">
                    @error('compare_price')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror  --}}
                    <x-form.input type="number" label="compare price" id="compare_price" name="compare_price"  value="{{ $products->compare_price }}" />

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-groub mb-3">
                    <x-form.input type="number" label="Cost"  name="cost" id="cost" value="{{ $products->cost }}" />

                    {{--  if you went to stay all value in form use old() in value  --}}
                    {{--  <label for="cost">Cost</label>
                    <input type="number" step="0.1" id="cost" value="{{ old('cost', $products->cost) }}"
                        name="cost" class="form-control    @error('cost') is-invalid @enderror">
                    @error('cost')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror  --}}
                </div>
            </div>
        </div>
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-groub mb-3">
                        <x-form.input  label="SKU" id="sku" name="sku" id="sku" value="{{ $products->sku }}" />

                        {{--  <label for="sku">sku</label>
                        <input type="text" id="sku"
                            value="{{ old('sku', $products->sku) }}" name="sku"
                            class="form-control    @error('sku') is-invalid @enderror">
                        @error('sku')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror  --}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-groub mb-3">
                        <x-form.input  label="Barcode" id="barcode" name="barcode"  value="{{ $products->barcode }}" />


                        {{--  <label for="barcode">barcode</label>
                        <input type="text"  id="barcode"
                            value="{{ old('barcode', $products->barcode) }}" name="barcode"
                            class="form-control    @error('barcode') is-invalid @enderror">
                        @error('barcode')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror  --}}
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="availability">Availability</label>
                        <select type="text" id="availability" name="availability"
                        class="form-control  @error('availability') is-invalid @enderror ">
                        @foreach ($availabilitys as $key =>$availability)
                            <option value="{{ $key}}" @if ($key == old('availability', $products->availability)) selected @endif>
                                {{ $availability}}</option>
                        @endforeach
                    </select>

                        @error('availability')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-groub mb-3">
                        <x-form.input  label="quantity" id="quantity" name="quantity"  value="{{ $products->quantity }}" />


                        {{--  <label for="quantity">quantity</label>
                        <input type="text"  id="quantity"
                            value="{{ old('quantity', $products->quantity) }}" name="quantity"
                            class="form-control    @error('quantity') is-invalid @enderror">
                        @error('quantity')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror  --}}
                    </div>
                </div>
            </div>


    </div> {{-- dive close   --}}
    <div class="col-md-4">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="status">Status</label>
                <select type="text" id="status" name="status"
                    class="form-control  @error('status') is-invalid @enderror ">
                    @foreach ($status_options as $key =>$status)
                        <option value="{{ $key}}" @if ($key == old('status', $products->status)) selected @endif>
                            {{ $status}}</option>
                    @endforeach
                </select>
                @error('status')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="form-group mb-3">
            <label for="image">Thumbnail</label>
            <div class="mb-2">
                @if ($products->image)
                    <img id="thumbnail" src="{{ Storage::disk('uploads')->url($products->image) }}" alt=""
                        height="150">
                @else
                    <img id="thumbnail" src="{{ asset('uploads/default-thumbnail.jpg') }}" alt=""
                        height="150">
                @endif
            </div>
            <input type="file" style="display: none;" id="image" name="image"
                class="form-control  @error('image') is-invalid @enderror">
            @error('image')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>

    </div>
    <div class="col-md-12">
        <div class="form-group mb-3">
            <button type="submit" class="btn btn-primary">{{ $button }}</button>
            <a href="{{ route('dashboard.products.index') }}" class="btn btn-light">Cancel</a>
        </div>
    </div>
</div>
@push('script')
    <script>
        //to hide the input and on click at photo start to upload
        document.getElementById('thumbnail').addEventListener('click', function(e) {

            document.getElementById('image').click();


        });
        //to show prview of photo at moment
        document.getElementById('image').addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                document.getElementById('thumbnail').src = URL.createObjectURL(this.files[0]);

            }
        });
    </script>
@endpush
