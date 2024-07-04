<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $destinations = Destination::all();
        if ($request->ajax()) {
            return view('destination.table-destination', compact('destinations'))->render();
        }
        return view('destination.index-destination', compact('destinations'));
    }

    public function all(Request $request)
    {
        $destinations = Destination::all();
        return view('welcome', compact('destinations'));
    }
    public function show($id)
    {
        $destination = Destination::find($id);
        return view('destination.show', compact('destination'));
    }

    public function create()
    {
        return view('destination.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_destination' => 'required|string|max:255',
            'gambar_destination' => 'required|image|max:2048',
            'harga_tiket' => 'required|numeric',
            'harga_guide' => 'required|numeric',
            'harga_porter' => 'required|numeric',
        ]);

        $imageName = time().'.'.$request->gambar_destination->extension();
        $request->gambar_destination->move(public_path('images'), $imageName);

        Destination::create([
            'nama_destination' => $request->nama_destination,
            'gambar_destination' => $imageName,
            'harga_tiket' => $request->harga_tiket,
            'harga_guide' => $request->harga_guide,
            'harga_porter' => $request->harga_porter,
        ]);

        return redirect()->route('destinations.index')->with('success', 'Destination created successfully.');
    }

    public function edit(Destination $destination)
    {
        return view('destination.edit', compact('destination'));
    }

    public function update(Request $request, Destination $destination)
    {
        $request->validate([
            'nama_destination' => 'required|string|max:255',
            'gambar_destination' => 'nullable|image|max:2048',
            'harga_tiket' => 'required|numeric',
            'harga_guide' => 'required|numeric',
            'harga_porter' => 'required|numeric',
        ]);

        if ($request->hasFile('gambar_destination')) {
            $imageName = time().'.'.$request->gambar_destination->extension();
            $request->gambar_destination->move(public_path('images'), $imageName);
            $destination->gambar_destination = $imageName;
        }

        $destination->update([
            'nama_destination' => $request->nama_destination,
            'harga_tiket' => $request->harga_tiket,
            'harga_guide' => $request->harga_guide,
            'harga_porter' => $request->harga_porter,
        ]);

        return redirect()->route('destinations.index')->with('success', 'Destination updated successfully.');
    }

    public function destroy(Destination $destination)
    {
        $destination->delete();
        return redirect()->route('destinations.index')->with('success', 'Destination deleted successfully.');
    }
}

