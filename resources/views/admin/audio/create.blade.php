@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Upload New Audio File</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('audios.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Audio Files
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">Audio File Details</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('audios.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-7">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                            <small class="text-muted">Enter a descriptive title for the audio file</small>
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select" id="category_id" name="category_id" required>
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">Select the category this audio file belongs to</small>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                            <small class="text-muted">Provide a detailed description of the audio content</small>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="mb-3">
                            <label class="form-label">Audio File</label>
                            <div class="audio-upload-container" id="audioUploadContainer">
                                <input type="file" id="audio_file" name="audio_file" accept="audio/*" required>
                                <i class="fas fa-music fa-3x mb-3 text-secondary"></i>
                                <p>Click to select audio file</p>
                                <p class="text-muted small">Supported formats: MP3, WAV, AAC, OGG (max 50MB)</p>
                            </div>
                            <div id="audioPlayerContainer" class="d-none">
                                <audio controls class="audio-player" id="audioPreview">
                                    <source src="" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <span id="audioFileName" class="small text-muted"></span>
                                    <button type="button" class="btn btn-sm btn-outline-danger" id="removeAudio">
                                        <i class="fas fa-times"></i> Remove
                                    </button>
                                </div>
                                <div id="audioDuration" class="small text-muted mt-1"></div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="cover_image" class="form-label">Cover Image</label>
                            <input type="file" class="form-control" id="cover_image" name="cover_image" accept="image/*" onchange="changeImagePreview(event)">
                            <small class="text-muted">Upload a cover image for the audio (recommended size:
                                400x400px)</small>

                            <div class="image-preview mt-2" id="imagePreview">
                                <i class="fas fa-image text-secondary" id="imagePreviewIcon"> No image selected</i>
                                <img id="imagePreviewImg" class="img-fluid d-none" width="120" height="120"
                                    alt="Category Image Preview">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary">Upload Audio File</button>
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