@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Edit Transaction</h1>
    <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="destination_id">Destination</label>
            <select name="destination_id" class="form-control" required>
                @foreach ($destinations as $destination)
                    <option value="{{ $destination->id }}" {{ $transaction->destination_id == $destination->id ? 'selected' : '' }}>{{ $destination->destination_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" class="form-control" value="{{ $transaction->quantity }}" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control" required>
                <option value="pending" {{ $transaction->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ $transaction->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="canceled" {{ $transaction->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
