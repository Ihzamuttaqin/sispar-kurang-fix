<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        return view('transactions.index', compact('transactions'));
    }

    public function create(Destination $destination)
    {

        return view('transactions.create', compact('destination'));
    }

    public function store(Request $request, Destination $destination)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);


        $total_price = ($destination->harga_tiket + $destination->harga_guide + $destination->harga_porter) * $request->quantity;

        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'destination_id' => $destination->id,
            'quantity' => $request->quantity,
            'total_price' => $total_price,
            'status' => 'pending',
        ]);

        $transaction;

        return redirect()->route('payment',$transaction->id)->with('success', 'Transaction created successfully.');
    }

    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        $destinations = Destination::all();
        return view('transactions.edit', compact('transaction', 'destinations'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'quantity' => 'required|integer|min=1',
            'status' => 'required|in:pending,completed,canceled',
        ]);

        $destination = Destination::find($request->destination_id);
        $total_price = $destination->price * $request->quantity;

        $transaction->update([
            'destination_id' => $request->destination_id,
            'quantity' => $request->quantity,
            'total_price' => $total_price,
            'status' => $request->status,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }


    // Existing methods...

    public function order(Request $request, Destination $destination)
    {
        $request->validate([
            'quantity' => 'required|integer|min=1',
        ]);

        $total_price = $destination->price * $request->quantity;

        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'destination_id' => $destination->id,
            'quantity' => $request->quantity,
            'total_price' => $total_price,
            'status' => 'pending',
        ]);

        return view('transactions.receipt', compact('transaction'));
    }

    public function payment(Transaction $transaction)
    {
        return view('transactions.payment', compact('transaction'));
    }

    public function processPayment(Request $request, Transaction $transaction)
    {
        // Proses pembayaran di sini (misalnya, menggunakan gateway pembayaran)

        // Misalkan pembayaran berhasil, perbarui status transaksi
        $transaction->update(['status' => 'completed']);

        return redirect()->route('receipt', $transaction)->with('success', 'Payment completed successfully.');
    }
    public function receipt(Transaction $transaction)
    {
        return view('transactions.receipt', compact('transaction'));
    }
}
