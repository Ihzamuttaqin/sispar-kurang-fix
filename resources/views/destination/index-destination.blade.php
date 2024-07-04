@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Destinations List</h1>
    <a href="{{ route('destinations.create') }}" class="btn btn-primary mb-4">Create New Destination</a>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div id="destination-table">
        @include('destination.table-destination')
    </div>
</div>
@endsection


{{-- @section('scripts')
<script>
    $(document).ready(function() {
        $('#menu-destinations').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('destinations.index') }}',
                method: 'GET',
                success: function(response) {
                    $('#content').html(response);
                }
            });
        });
    });
</script>
@endsection --}}
