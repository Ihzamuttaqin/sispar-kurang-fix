@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Transaction Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Transaction #{{ $transaction->id }}</h5>
            <p class="card-text"><strong>User:</strong> {{ $transaction->user->name }}</p>
            <p class="card-text"><strong>Destination:</strong> {{ $transaction->destination->destination_name }}</p>
            <p class="card-text"><strong>Quantity:</strong> {{ $transaction->quantity }}</p>
            <p class="card-text"><strong>Total Price:</strong> {{ number_format($transaction->total_price, 2) }}</p>
            <p class="card-text"><strong>Status:</strong> {{ ucfirst($transaction->status) }}</p>
            <a href="{{ route('transactions.index') }}" class="btn btn-primary">Back to List</a>
        </div>
    </div>
</div>
@endsection
