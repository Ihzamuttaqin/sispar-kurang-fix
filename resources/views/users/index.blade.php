<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link href="{{ asset('sb-admin') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('sb-admin') }}/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Users List</h1>
        <div id="user-table">
            @include('users.table')
        </div>
    </div>

    <script src="{{ asset('sb-admin') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('sb-admin') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('sb-admin') }}/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="{{ asset('sb-admin') }}/js/sb-admin-2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#menu-users').on('click', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('users.index') }}',
                    method: 'GET',
                    success: function(response) {
                        $('#user-table').html(response);
                    }
                });
            });
        });
    </script>
</body>
</html>
