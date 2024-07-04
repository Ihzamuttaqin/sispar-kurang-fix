<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="{{ asset('sb-admin') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('sb-admin') }}/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>

    <div class="container">
        <h1 class="my-4">Payment</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Transaction #{{ $transaction->id }}</h5>
                <p class="card-text"><strong>User:</strong> {{ $transaction->user->name }}</p>
                <p class="card-text"><strong>Destination:</strong> {{ $transaction->destination->destination_name }}</p>
                <p class="card-text"><strong>Quantity:</strong> {{ $transaction->quantity }}</p>
                <p class="card-text"><strong>Total Price:</strong> {{ number_format($transaction->total_price, 2) }}</p>
                <form action="{{ route('process-payment', $transaction) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="payment_method">Payment Method</label>
                        <select name="payment_method" class="form-control" required>
                            <option value="credit_card">Credit Card</option>
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="paypal">PayPal</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Pay Now</button>
                </form>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('sb-admin') }}/vendor/jquery/jquery.min.js"></script>
  <script src="{{ asset('sb-admin') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('sb-admin') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('sb-admin') }}/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="{{ asset('sb-admin') }}/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('sb-admin') }}/js/demo/chart-area-demo.js"></script>
  <script src="{{ asset('sb-admin') }}/js/demo/chart-pie-demo.js"></script>

</body>
</html>
