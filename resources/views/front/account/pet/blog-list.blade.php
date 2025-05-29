@extends('front.layouts.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Account Settings</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                @include('front.account.sidebar')
            </div>
            <div class="col-lg-9">
                @include('front.message')
                <div class="card border-0 shadow mb-4 p-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="fs-4 mb-0">Blog List</h3>
                            <a href="{{ route('account.createBlog') }}" class="btn btn-primary">Post a Blog</a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Description</th>
                                        <th>Created At</th>
                                        <th>Actions</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($blogList->isNotEmpty())
                                        @foreach ($blogList as $key=>$blogList)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>
                                                    @if ($blogList->image)
                                                        <img width="50" src="{{ asset('uploads/blogs/' . $blogList->image) }}" alt="{{ $blogList->name }}">
                                                    @else
                                                        <img width="50" src="{{ asset('uploads/photos/default.jpg') }}" alt="Default Image"> 
                                                    @endif
                                                </td>
                                                <td>{{ $blogList->title }}</td>
                                                <td>{{ $blogList->description }}</td>
                                                <td>{{ \Carbon\Carbon::parse($blogList->created_at)->format('d M, Y') }}</td> 
                                                <td>
                                                    <a href="" class="btn btn-dark btn-sm">Edit</a>
                                                    <a href="#"  class="btn btn-success btn-sm">Delete</a>
                                                    <form  action="" method="post">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </td>
                                                
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="9" class="text-center">No blogs found.</td> <!-- Adjusted colspan to 9 -->
                                        </tr>
                                    @endif
                                                                      
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

