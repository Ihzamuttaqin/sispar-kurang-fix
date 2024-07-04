@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Create Destination</h1>
    <form action="{{ route('destinations.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nama_destination">Nama Destination</label>
            <input type="text" name="nama_destination" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="gambar_destination">Gambar Destination</label>
            <input type="file" name="gambar_destination" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="harga_tiket">Harga Tiket</label>
            <input type="number" name="harga_tiket" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="harga_guide">Harga Guide</label>
            <input type="number" name="harga_guide" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="harga_porter">Harga Porter</label>
            <input type="number" name="harga_porter" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection

