@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12 mb-4">
            <div class="bg-dark text-white p-5 rounded-3 shadow">
                <div class="container-fluid py-3">
                    <h1 class="display-5 fw-bold">Welcome to Radio Station</h1>
                    <p class="col-md-8 fs-4">Listen to your favorite audio content across various categories.</p>
                    <p>Explore our categories below and enjoy the audio experience.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col">
            <h2 class="border-bottom pb-2">Browse Categories</h2>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($categories as $category)
            <div class="col">
                <div class="card h-100 category-card shadow-sm">
                    <img src="{{ $category->cover_image ? asset('storage/' . $category->cover_image) : ''}}" class="card-img-top" alt="{{ $category->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->name }}</h5>
                        <p class="card-text">
                            {{ $category->description }}
                        </p>
                        <p class="card-text">
                            <small class="text-muted">
                                <i class="fas fa-headphones me-1"></i> {{ $category->audios->count() }} audio files
                            </small>
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