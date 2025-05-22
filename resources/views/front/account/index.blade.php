<!-- resources/views/account/index.blade.php -->

@extends('front.layouts.app')

@section('main')
<section class="section-1 py-5"> 
    <div class="container">
        <h2>Search Results</h2>

        @if($pets->isEmpty())
            <p>No pets found matching your criteria.</p>
        @else
            <div class="row">
                @foreach($pets as $pet)
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="{{ asset('uploads/photos/' . $pet->photo_path) }}" class="card-img-top" alt="{{ $pet->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $pet->name }}</h5>
                                <p class="card-text">
                                    Type: {{ $pet->type }}<br>
                                    Location: {{ $pet->location }}<br>
                                    Age: {{ $pet->age }} years
                                </p>
                                <a href="#" class="btn btn-primary">View Details</a>
                            @if (Auth::check())
                                <a href="#" onclick="savePet({{ $pet->id }});" class="btn btn-secondary">Save</a>  
                            @else
                                <a href="{{  route('account.login') }}" class="btn btn-secondary">Login to Save</a>
                            @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection

@section('customJs')
<script type="text/javascript">
function savePet(id) {
    $.ajax({
        url : '{{ route("savePet") }}',
        type: 'post',
        data: {
            id: id,
            _token: '{{ csrf_token() }}' // Include CSRF token here
        },
        dataType: 'json',
        success: function(response) {
            if (response.status) {
                alert('Pet saved successfully!');
                window.location.href = "{{ url()->current() }}";

            } else {
                alert(response.message || 'Error saving the pet.');
            }
        },
        error: function() {
            alert('There was an error saving the pet.');
        }
    });
}
</script>
@endsection
