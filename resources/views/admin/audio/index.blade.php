@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Audio Files</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('audios.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus me-1"></i> Upload New Audio
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold">All Audio Files</h6>
            <div>
                <form class="d-flex">
                    <select class="form-select form-select-sm me-2" style="width: 150px;">
                        <option value="">All Categories</option>
                        <option>Morning Vibes</option>
                        <option>Evening Talks</option>
                        <option>Meditation</option>
                        <option>Educational</option>
                        <option>Music Jams</option>
                        <option>Storytelling</option>
                    </select>
                    <input class="form-control form-control-sm me-2" type="search" placeholder="Search" aria-label="Search"
                        style="width: 150px;">
                    <button class="btn btn-sm btn-outline-primary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 60px;">Cover</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Duration</th>
                            <th>Plays</th>
                            <th>Uploaded</th>
                            <th style="width: 150px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($audioFiles as $audio)
                            <tr>
                                <td>
                                    <img src="{{ $audio->cover_image ? asset('storage/' . $audio->cover_image) : 'https://via.placeholder.com/60' }}"
                                        class="audio-cover" alt="{{ $audio->title }}" width="60" height="60">
                                </td>
                                <td class="audio-title">{{ $audio->title }}</td>
                                <td>{{ $audio->category->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($audio->duration)->format('i:s') }}</td>
                                <td>{{ $audio->plays }}</td>
                                <td>{{ $audio->created_at->format('M d, Y') }}</td>
                                <td>
                                    <a href="{{ route('audios.edit', $audio->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('audios.destroy', $audio->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <nav aria-label="Page navigation" class="mt-4">
               {{ $audioFiles->links() }}
            </nav>
        </div>
    </div>
@endsection