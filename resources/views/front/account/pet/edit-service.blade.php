@extends('front.layouts.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
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

                <form enctype="multipart/form-data" action="{{ route('account.updateService', $service->id) }}" method="post">
                    @method('put')
                    @csrf
                    <div class="card border-0 shadow mb-4">
                        <div class="card-body card-form p-4">
                            <h3 class="fs-4 mb-1">Edit Service</h3>
                            <div class="row">
                                {{-- Service Name --}}
                                <div class="col-md-6 mb-4">
                                    <label for="name" class="mb-2">Service Name <span class="req">*</span></label>
                                    <input value="{{ old('name', $service->name) }}" type="text" name="name" id="name" class="@error('name') is-invalid @enderror form-control" placeholder="Enter service name" required>
                                </div>

                                {{-- Title --}}
                                <div class="col-md-6 mb-4">
                                    <label for="title" class="mb-2">Title <span class="req">*</span></label>
                                    <input value="{{ old('title', $service->title) }}" type="text" name="title" id="title" class="@error('title') is-invalid @enderror form-control" placeholder="Enter title" required>
                                </div>
                            </div>

                            <div class="row">
                                {{-- Price --}}
                                <div class="col-md-6 mb-4">
                                    <label for="price" class="mb-2">Price<span class="req">*</span></label>
                                    <input value="{{ old('price', $service->price) }}" type="number" name="price" id="price" class="@error('price') is-invalid @enderror form-control" placeholder="Enter price" required>
                                </div>

                                {{-- Status --}}
                                <div class="col-md-6 mb-4">
                                    <label for="status" class="mb-2">Status</label>
                                    <select name="status" id="status" class="@error('status') is-invalid @enderror form-control">
                                        <option value="1" {{ old('status', $service->status) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', $service->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Description --}}
                            <div class="mb-4">
                                <label for="description" class="mb-2">Description <span class="req">*</span></label>
                                <textarea name="description" id="description" class="@error('description') is-invalid @enderror form-control" rows="5" placeholder="Description" required>{{ old('description', $service->description) }}</textarea>
                            </div>

                            {{-- Image --}}
                            <div class="mb-4">
                                <label for="image" class="mb-2">Image<span class="req">*</span></label>
                                <input type="file" name="image" id="image" class="@error('image') is-invalid @enderror form-control" accept="image/*" required>

                                @if ($service->image)
                                    <img src="{{ asset('uploads/services/' . $service->image) }}" alt="{{ $service->name }}" width="100" class="mt-3">
                                @endif
                            </div>
                        </div>

                        <div class="card-footer p-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection