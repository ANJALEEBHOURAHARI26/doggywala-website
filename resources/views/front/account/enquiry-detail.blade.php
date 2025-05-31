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
                        <form method="GET" action="{{ route('account.enquiryList') }}" class="mb-3">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search by Name, Email or Phone" value="{{ request('search') }}">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>City</th>
                                        <th>Breed</th>
                                        <th>Price Range</th>
                                        <th>Message</th> 
                                        <th>Enquiry Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <tbody>
                                        @forelse($enquiries as $key => $enquiry)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $enquiry->name }}</td>
                                                <td>{{ $enquiry->email }}</td>
                                                <td>{{ $enquiry->phone }}</td>
                                                <td>{{ $enquiry->cityname }}</td>
                                                <td>{{ $enquiry->breedname }}</td>
                                                <td>{{ $enquiry->price_range }}</td>
                                                <td>{{ $enquiry->message }}</td>
                                                <td>{{ $enquiry->created_at->format('d-m-Y') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center text-danger">No enquiries found matching your search.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
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

