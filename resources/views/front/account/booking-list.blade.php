@extends('front.layouts.app')

<style>
  table {
    width: 100%;
    border-collapse: collapse;
  }
  td, th {
    padding: 8px;
    border: 1px solid #ddd;
    vertical-align: top;
  }
  .wrap-text {
    max-width: 180px;    
    word-wrap: break-word;
    white-space: normal;
  }
</style>

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Booking List</li>
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
                        <form method="GET" action="{{ route('account.bookingList') }}" class="mb-3">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search by Name, Phone or Service" value="{{ request('search') }}">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Phone Number</th>
                                        <th>Service</th>
                                        <th>Appointment Date</th>
                                        <th>Appointment Time</th>
                                        <th>Message</th>
                                        <th>Booking Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($bookings as $key => $booking)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $booking->name }}</td>
                                            <td>{{ $booking->phone }}</td>
                                            <td>{{ $booking->service }}</td>
                                            <td>{{ \Carbon\Carbon::parse($booking->appointment_date)->format('d-m-Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($booking->appointment_time)->format('h:i A') }}</td>
                                            <td class="wrap-text">{{ $booking->message ?? '-' }}</td>
                                            <td>{{ $booking->created_at->format('d-m-Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-danger">No bookings found matching your search.</td>
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
@endsection
