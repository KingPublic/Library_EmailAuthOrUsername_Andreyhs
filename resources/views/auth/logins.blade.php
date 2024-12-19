<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Library Management</title>
    <!-- You can include your Bootstrap or custom CSS here -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div>
    <p>Admin username: admin_username</p>
    <p>Admin password: password123</p>
    <p>Admin Email : admin@example.com</p>
    <br><p>Bisa di check pada bagian UserSeeder kalau ingin diubah yg admin..</p><br>
    <p>Librarian username: librarian_username</p>
    <p>Librarian password : password123</p>
    <p>Librarian Email : librarian@example.com</p>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h3>Login</h3>
                </div>
                <div class="card-body">
                    <!-- Display error messages, if any -->
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Login form -->
                    <form action="{{ route('auth.login') }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="email_or_username" class="form-label">Email or Username</label>
                                <input type="text" class="form-control" id="email_or_username" name="email_or_username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3 text-center">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>


                    <!-- Tombol Login sebagai Tamu -->
                    <div class="text-center mt-3">
                        <a href="{{ route('guest.login') }}" class="btn btn-secondary">Login sebagai Tamu</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>