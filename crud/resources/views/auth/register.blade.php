<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center mb-4 bg-primary p-4">Register</h2>
        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data" class="p-2 border rounded bg-light">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required>
                @error('username')<span class="text-danger">{{ $message }}</span>@enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
                @error('email')<span class="text-danger">{{ $message }}</span>@enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
                @error('password')<span class="text-danger">{{ $message }}</span>@enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                @error('password_confirmation')<span class="text-danger">{{ $message }}</span>@enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Profile Image:</label>
                <input type="file" id="image" name="image" class="form-control" accept="image/*">
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role:</label>
                <select id="role" name="role" class="form-select" required>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="country" class="form-label">Country:</label>
                <select id="country" name="country" class="form-select" required>
                    @foreach($countries as $country)
                        <option value="{{ $country }}">{{ $country }}</option>
                    @endforeach
                </select>
                @error('country')<span class="text-danger">{{ $message }}</span>@enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
