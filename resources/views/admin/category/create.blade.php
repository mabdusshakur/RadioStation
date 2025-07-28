@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create New Category</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="admin-categories.html" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Categories
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">Category Details</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                    <small class="text-muted">Enter a descriptive name for the category</small>
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug">
                    <small class="text-muted">URL-friendly version of the name (auto-generated, but can be edited)</small>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    <small class="text-muted">Provide a brief description of the category</small>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Category Image</label>
                    <input type="file" class="form-control" id="cover_image" name="cover_image" accept="image/*" onchange="changeImagePreview(event)">
                    <small class="text-muted">Upload an image that represents the category (recommended size:
                        800x400px)</small>

                    <div class="image-preview mt-2" id="imagePreview">
                        <i class="fas fa-image text-secondary" id="imagePreviewIcon"> No image selected</i> 
                        <img id="imagePreviewImg" class="img-fluid d-none" width="120" height="120" alt="Category Image Preview">
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary">Create Category</button>
                </div>
            </form>
        </div>
    </div>
@endsection

<script>
    const changeImagePreview = (event) => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const img = document.getElementById('imagePreviewImg');
                img.src = e.target.result;
                img.classList.remove('d-none');
                document.getElementById('imagePreviewIcon').classList.add('d-none');
            };
            reader.readAsDataURL(file);
        } else {
            document.getElementById('imagePreviewImg').classList.add('d-none');
        }
    };
</script>