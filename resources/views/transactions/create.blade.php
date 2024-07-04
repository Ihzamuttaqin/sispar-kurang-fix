@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Create Transaction</h1>
    <form action="{{ route('transactions.store',  $destination->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="destination_id">Destination : {{ $destination->nama_destination }}</label>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
