@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Edit Destination</h1>
    <form action="{{ route('destinations.update', $destination->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama_destination">Nama Destination</label>
            <input type="text" name="nama_destination" class="form-control" value="{{ $destination->nama_destination }}" required>
        </div>
        <div class="form-group">
            <label for="gambar_destination">Gambar Destination</label>
            <input type="file" name="gambar_destination" class="form-control">
            <img src="{{ asset('images/'.$destination->gambar_destination) }}" width="100" height="100">
        </div>
        <div class="form-group">
            <label for="harga_tiket">Harga Tiket</label>
            <input type="number" name="harga_tiket" class="form-control" value="{{ $destination->harga_tiket }}" required>
        </div>
        <div class="form-group">
            <label for="harga_guide">Harga Guide</label>
            <input type="number" name="harga_guide" class="form-control" value="{{ $destination->harga_guide }}" required>
        </div>
        <div class="form-group">
            <label for="harga_porter">Harga Porter</label>
            <input type="number" name="harga_porter" class="form-control" value="{{ $destination->harga_porter }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
