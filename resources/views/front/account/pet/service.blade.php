@extends('front.layouts.app')
<style>
    input#title {
        width: 200%;
    }
</style>
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

               <form enctype="multipart/form-data" action="{{ route('account.saveService') }}" method="post">
                    @csrf
                    <div class="card border-0 shadow mb-4">
                        <div class="card-body card-form p-4">
                            <h3 class="fs-4 mb-3">Create Service</h3>
                            <div class="row">
                                {{-- Service Name --}}
                                <div class="col-md-6 mb-4">
                                    <label for="name" class="mb-2">Service Name <span class="req">*</span></label>
                                    <input type="text" name="name" id="name" class="@error('name') is-invalid @enderror form-control" placeholder="Enter service name" required>
                                    @error('name')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Image --}}
                                <div class="col-md-6 mb-4">
                                    <label for="image" class="mb-2">Service Image<span class="req">*</span></label>
                                    <input type="file" name="image" id="image" class="@error('image') is-invalid @enderror form-control" accept="image/*" required>
                                    @error('image')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            {{-- Price --}}
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="price" class="mb-2">Price<span class="req">*</span></label>
                                    <input type="number" name="price" id="price" step="0.01" class="@error('price') is-invalid @enderror form-control" placeholder="e.g., 499.00" required>
                                    @error('price')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Status --}}
                                <div class="col-md-6 mb-4">
                                    <label for="status" class="mb-2">Status</label>
                                    <select name="status" id="status" class="@error('status') is-invalid @enderror form-control">
                                        <option value="1" selected>Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    @error('status')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                    <label for="name" class="mb-2">Title<span class="req">*</span></label>
                                    <input type="text" name="title" id="title" class="@error('title') is-invalid @enderror form-control" placeholder="Enter service title" required>
                                    @error('title')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                            </div>

                            {{-- Description --}}
                            <div class="mb-4">
                                <label for="description" class="mb-2">Description <span class="req">*</span></label>
                                <textarea name="description" id="description" class="@error('description') is-invalid @enderror form-control" rows="5" placeholder="Service details..." required></textarea>
                                @error('description')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <div class="card-footer p-4">
                           <button type="submit" class="btn btn-primary" id="submitBtn">
                                <span id="btnText">Save Service</span>
                                <span id="btnLoader" class="spinner-border spinner-border-sm d-none ms-2" role="status" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
    document.getElementById('submitBtn').closest('form').addEventListener('submit', function () {
        document.getElementById('btnText').textContent = 'Saving...';
        document.getElementById('btnLoader').classList.remove('d-none');
        document.getElementById('submitBtn').disabled = true;
    });
</script>

@endsection