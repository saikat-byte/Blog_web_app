<form action="{{ route('sub-category.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="sub_category_name" class="form-label text-capitalize">Name</label>
        <input type="text" class="form-control @error('sub_category_name') is-invalid @enderror"
            name="sub_category_name" value="{{ old('sub_category_name') }}" id="sub_category_name"
            aria-describedby="sub_category_name" placeholder="Sub category name">
        @error('sub_category_name')
            <div class="form-text text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="slug" class="form-label text-capitalize">Slug</label>
        <input type="text" class="form-control @error('slug_name') is-invalid @enderror" name="slug_name"
            value="{{ old('slug_name') }}" id="slug" aria-describedby="slug_name"
            placeholder="Slug name">
        @error('slug_name')
            <div class="form-text text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="category" class="form-label text-capitalize">Select category</label>
        <select name="category_id" id="category" class="form-select">
            <option value="" selected>Select category</option>
            @foreach($categories as $id => $category_name)
            <option value="{{ old('category_id', $id)  }}">{{ $category_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="order_by" class="form-label text-capitalize">sub category serial</label>
        <input type="slug" class="form-control @error('order_by') is-invalid @enderror"
            name="order_by" value="{{ old('order_by') }}" id="order_by"
            aria-describedby="order_by" placeholder="Sub category serial">
        @error('order_by')
            <div class="form-text text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="status" class="form-label text-capitalize">Sub category Status</label>
        <select name="status" id="status" class="form-select">
            <option value="" selected>Select status</option>
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success text-capitalize">Create sub category</button>
</form>
