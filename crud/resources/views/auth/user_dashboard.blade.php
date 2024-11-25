<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>
<body>
    <h3>Welcome to your dashboard,</h3>
    <h1> {{ Auth::user()->name }}!</h1>
</body>
</html>
