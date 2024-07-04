<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Destination</th>
            <th>Gambar Destination</th>
            <th>Harga Tiket</th>
            <th>Harga Guide</th>
            <th>Harga Porter</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($destinations as $destination)
        <tr>
            <td>{{ $destination->id }}</td>
            <td>{{ $destination->nama_destination }}</td>
            <td><img src="{{ asset('images/' . $destination->gambar_destination) }}" alt="{{ $destination->nama_destination }}" width="100"></td>
            <td>{{ $destination->harga_tiket }}</td>
            <td>{{ $destination->harga_guide }}</td>
            <td>{{ $destination->harga_porter }}</td>
            <td>
                <a href="{{ route('destinations.edit', $destination) }}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ route('destinations.destroy', $destination) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
