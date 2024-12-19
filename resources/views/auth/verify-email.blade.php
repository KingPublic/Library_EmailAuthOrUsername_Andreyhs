<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email</title>
</head>
<body>
    <h1>Verifikasi Email Anda</h1>
    <p>Silakan periksa email Anda untuk menyelesaikan proses verifikasi.</p>
    <form method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit">Kirim Ulang Link Verifikasi</button>
    </form>
</body>
</html>
