<!DOCTYPE html>
<html>
<head>
    <title>Account Created</title>
</head>
<body>
    <h2>Hello, {{ $user->name }}</h2>
    <p>Your account has been created successfully.</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Password:</strong> {{ $password }}</p>
    <p>You can login using the above credentials.</p>
</body>
</html>
