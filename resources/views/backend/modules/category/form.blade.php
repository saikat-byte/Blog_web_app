<form action="{{ route('category.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="category_name" class="form-label">Name</label>
        <input type="text" class="form-control @error('category_name') is-invalid @enderror"
            name="category_name" value="{{ old('name') }}" id="category_name"
            aria-describedby="category_name" placeholder="Category name">
        @error('category_name')
            <div class="form-text text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" class="form-control @error('slug_name') is-invalid @enderror" name="slug_name"
            value="{{ old('slug') }}" id="slug" aria-describedby="slug_name"
            placeholder="Slug name">
        @error('slug_name')
            <div class="form-text text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="order_by" class="form-label">category serial</label>
        <input type="slug" class="form-control @error('order_by') is-invalid @enderror"
            name="order_by" value="{{ old('order_by') }}" id="order_by"
            aria-describedby="order_by" placeholder="category serial">
        @error('order_by')
            <div class="form-text text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Category Status</label>
        <select name="status" id="status" class="form-control">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Create category</button>
</form>
