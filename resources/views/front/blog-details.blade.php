@extends('front.layouts.app')

@section('main')
<section class="py-5" style="background-color: #f9fff9;">
  <div class="container" style="margin-top: 117px;">
    <!-- Blog Title -->
    <div class="text-center mb-5">
      <h1 class="fw-bold" style="color: #1f2e4d;">{{ $blog->title }}</h1>
      <p class="text-muted">
        <i class="bi bi-person-circle text-primary"></i> {{ $blog->user->name }} |
        <i class="bi bi-calendar-date text-primary"></i> {{ \Carbon\Carbon::parse($blog->created_at)->format('d F Y') }}
      </p>
    </div>

    <!-- Blog Image -->
    <div class="text-center mb-4">
      <img src="{{ asset('uploads/blogs/' . $blog->image) }}" 
           alt="{{ $blog->title }}" 
           class="img-fluid rounded shadow" 
           style="max-height: 450px; object-fit: cover; width: 100%;">
    </div>

    <!-- Blog Description -->
    <div class="px-md-5 px-2">
      <div class="bg-white p-4 p-md-5 rounded shadow-sm" style="line-height: 1.8; font-size: 1.1rem; color: #333;">
        {!! nl2br(e($blog->description)) !!}
      </div>
    </div>
  </div>
</section>

<!-- Related Blogs Section -->
<section class="py-5 bg-light">
  <div class="container">
    <h3 class="mb-4 fw-bold text-center" style="color: #1f2e4d;">Related Blogs</h3>

    <div class="row g-4">
      @foreach($relatedBlogs as $item)
      <div class="col-md-3 col-sm-6">
        <a href="{{ route('blog.details', $item->id) }}" class="text-decoration-none text-dark">
          <div class="card h-100 shadow-sm border-0">
            <img src="{{ asset('uploads/blogs/' . $item->image) }}" class="card-img-top" alt="{{ $item->title }}" style="height: 180px; object-fit: cover;">
            <div class="card-body">
              <h5 class="card-title fw-semibold" style="font-size: 1.05rem;">{{ \Illuminate\Support\Str::limit($item->title, 50) }}</h5>
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</section>

@endsection
