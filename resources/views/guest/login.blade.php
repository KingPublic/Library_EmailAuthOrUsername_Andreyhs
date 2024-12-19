<!DOCTYPE html>
<html>
<head>
    <title>Guest Login</title>
</head>
<body>
    <form action="{{ route('guest.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="id_card">Upload ID Card:</label>
        <input type="file" id="id_card" name="id_card" required><br>
        
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>
        
        <label for="username">Username (6-12 characters):</label>
        <input type="text" id="username" name="username" minlength="6" maxlength="12" required><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        
        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required><br>
        
        <button type="submit">Login as Guest</button>
    </form>
</body>
</html>