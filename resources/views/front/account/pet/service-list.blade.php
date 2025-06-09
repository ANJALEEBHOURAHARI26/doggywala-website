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
                            <h3 class="fs-4 mb-0">Service List</h3>
                            <a href="{{ route('account.createServices') }}" class="btn btn-primary">Post a Service</a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Service Name</th>
                                        <th>Title</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Actions</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($services as $key=>$service)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>
                                                @if ($service->image)
                                                    <img src="{{ asset('uploads/services/' . $service->image) }}" alt="Service Image" width="60" height="60" style="object-fit: cover;">
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>{{ $service->name }}</td>
                                            <td>{{ $service->title }}</td>
                                            <td>
                                                @if($service->price)
                                                    ₹{{ number_format($service->price, 2) }}
                                                @else
                                                    Not Set
                                                @endif
                                            </td>
                                            <td>
                                                @if ($service->status)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('account.editService',$service->id) }}" class="btn btn-dark btn-sm">Edit</a>
                                                <a href="#"  onclick="deleteService({{ $service->id  }});" class="btn btn-success btn-sm">Delete</a>
                                                <form id="delete-service-from-{{ $service->id  }}" action="{{ route('account.destroyBlog',$service->id) }}"   method="post">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No services found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>           
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function deleteBlog(id) {
        if (confirm("Are you sure you want to delete service?")) {
            document.getElementById("delete-service-from-"+id).submit();
        }
    }
</script>
@endsection

