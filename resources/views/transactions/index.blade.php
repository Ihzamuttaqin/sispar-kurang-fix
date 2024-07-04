@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Transactions List</h1>
    {{-- <a href="{{ route('transactions.create') }}" class="btn btn-primary mb-4">Create New Transaction</a>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Destination</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
            <tr>
                <td>{{ $transaction->id }}</td>
                <td>{{ $transaction->user->name }}</td>
                <td>{{ $transaction->destination->destination_name }}</td>
                <td>{{ $transaction->quantity }}</td>
                <td>{{ number_format($transaction->total_price, 2) }}</td>
                <td>{{ ucfirst($transaction->status) }}</td>
                <td>
                    <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-info btn-sm">Show</a>
                    <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
