@extends('layouts.app')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="category.html">Morning Vibes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Morning Meditation</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow audio-player mb-4">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ Storage::url($audioFile->cover_image) }}" class="img-fluid h-100 w-100"
                            style="object-fit: cover;" alt="{{ $audioFile->title }}">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title">{{ $audioFile->title }}</h3>
                            <p class="card-text">
                                <span class="badge bg-primary me-2">{{ $audioFile->category->name }}</span>
                            </p>
                            <p class="card-text">
                                {{ $audioFile->description ?? 'No description available.' }}
                            </p>
                            <p class="card-text">
                                <small class="text-muted">
                                    <i class="fas fa-play-circle me-1"></i> {{ $audioFile->plays }} plays
                                    <span class="mx-2">|</span>
                                    <i class="fas fa-clock me-1"></i>
                                    {{ Carbon\Carbon::parse($audioFile->duration)->format('i:s') ?? 'N/A' }}
                                </small>
                            </p>
                            <div class="mt-3">
                                <audio controls class="w-100">
                                    <source src="{{ Storage::url($audioFile->file_path) }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h4 class="mb-3">More from this category</h4>
            <div class="row row-cols-1 row-cols-md-2 g-4">

                @foreach ($similarAudios as $audio)
                    <div class="col">
                        <a href="{{ route('audio.show', $audio->id) }}" class="text-decoration-none">
                            <div class="card h-100 shadow-sm audio-item">
                                <div class="row g-0">
                                    <div class="col-4">
                                        <img src="{{ Storage::url($audio->cover_image) }}"
                                            class="img-fluid h-100" style="object-fit: cover;" alt="Coffee Break Jazz">
                                    </div>
                                    <div class="col-8">
                                        <div class="card-body">
                                            <h5 class="card-title text-dark">{{ $audio->title }}</h5>
                                            <p class="card-text text-muted small">
                                                <i class="fas fa-play-circle me-1"></i> {{ $audio->plays }} plays
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection