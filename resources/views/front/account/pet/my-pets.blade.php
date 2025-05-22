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
                            <h3 class="fs-4 mb-0">My Pets</h3>
                            <a href="{{ route('account.createPet') }}" class="btn btn-primary">Post a Pet</a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Breed</th>
                                        <th>Age</th>
                                        <th>Location</th>
                                        <th>Created At</th> <!-- New Created At column -->
                                        <th>Actions</th> <!-- Actions column -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($pets->isNotEmpty())
                                        @foreach ($pets as $pet)
                                            <tr>
                                                <td>{{ $pet->id }}</td>
                                                <td>
                                                    @if ($pet->photo_path)
                                                        <img width="50" src="{{ asset('uploads/photos/' . $pet->photo_path) }}" alt="{{ $pet->name }}">
                                                    @else
                                                        <img width="50" src="{{ asset('uploads/photos/default.jpg') }}" alt="Default Image"> <!-- Default image if none -->
                                                    @endif
                                                </td>
                                                <td>{{ $pet->name }}</td>
                                                <td>{{ $pet->type }}</td>
                                                <td>{{ $pet->breed ?? 'N/A' }}</td>
                                                <td>{{ $pet->age }}</td>
                                                <td>{{ $pet->location }}</td>
                                                <td>{{ \Carbon\Carbon::parse($pet->created_at)->format('d M, Y') }}</td> <!-- Added Created At -->
                                                <td>
                                                    <a href="{{ route('account.edit',$pet->id) }}" class="btn btn-dark btn-sm">Edit</a>
                                                    <a href="#" onclick="deletePet({{ $pet->id  }});" class="btn btn-success btn-sm">Delete</a>
                                                    <form id="delete-product-from-{{ $pet->id  }}" action="{{ route('account.destroy',$pet->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </td>
                                                
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="9" class="text-center">No pets found.</td> <!-- Adjusted colspan to 9 -->
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{ $pets->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

<script>
    function deletePet(id) {
        if (confirm("Are you sure you want to delete pet?")) {
            document.getElementById("delete-product-from-"+id).submit();
        }
    }
</script>
