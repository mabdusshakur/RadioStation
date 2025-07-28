@extends('layouts.app')

@section('content')
    <div class="row mb-4">
        <div class="col-md-4 mb-4 mb-md-0">
            <div class="card shadow-sm h-100">
                <img src="https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bW9ybmluZ3xlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60"
                    class="card-img-top" alt="Morning Vibes">
                <div class="card-body">
                    <h3 class="card-title">{{ $category->name }}</h3>
                    <p class="card-text">{{ $category->description }}</p>
                    <p class="card-text">
                        <small class="text-muted">
                            <i class="fas fa-headphones me-1"></i> {{ $category->audios->count() }} audio files
                        </small>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h4 class="mb-0">Audio Files</h4>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <!-- Audio Item 1 -->
                        @foreach ($category->audios as $audio)
                            <a href="{{ route('audio.show', ['id' => $audio->id]) }}" class="list-group-item list-group-item-action d-flex align-items-center">
                                <img src="{{ Storage::url($audio->cover_image) }}" class="me-3" width="60" height="60" alt="{{ $audio->title }}">
                                <div>
                                    <h5 class="mb-1">{{ $audio->title }}</h5>
                                    <p class="mb-1 text-muted small">
                                        <i class="fas fa-play-circle me-1"></i> {{ $audio->plays }} plays
                                        <span class="mx-2">|</span>
                                        <i class="fas fa-clock me-1"></i> {{ Carbon\Carbon::parse($audio->duration)->format('i:s') ?? 'N/A' }}
                                    </p>
                                </div>
                                <div class="ms-auto">
                                    <i class="fas fa-play"></i>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <h3 class="mb-4">You Might Also Like</h3>
        </div>

        @foreach ($relatedCategories as $category)
               <div class="col-md-4 mb-4">
            <div class="card h-100 category-card shadow-sm">
                <img src="{{ Storage::url($category->image) }}"
                    class="card-img-top" alt="Evening Talks">
                <div class="card-body">
                    <h5 class="card-title">{{$category->name}}</h5>
                    <p class="card-text">
                        {{ Str::limit($category->description, 70) }} ...
                    </p>
                </div>
                <div class="card-footer bg-white border-top-0">
                    <a href="{{ route('category.show', ['slug' => $category->slug]) }}" class="btn btn-primary w-100">
                        <i class="fas fa-play-circle me-1"></i> Listen Now
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection