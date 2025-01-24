<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <p>Name: {{ $user->name }}</p>
    <p>Email: {{ $user->email }}</p>
    <p>Role: {{ $user->is_admin ? "Admin" : "Member"}}</p>

    <form action="{{ route('edit_profile') }}" method="POST">
        @csrf
        <table>
            <tr>
                <td><label for="name">Name:</label></td>
                <td><input type="text" id="name" name="name" value="{{ $user->name }}" required></td>
            </tr>
            <tr>
                <td><label for="password">New Password:</label></td>
                <td><input type="password" id="password" name="password" required></td>
            </tr>
            <tr>
                <td><label for="password_confirmation">Confirm Password:</label></td>
                <td><input type="password" id="password_confirmation" name="password_confirmation" required></td>
            </tr>
            <tr>
                <td colspan="2"><button type="submit">Update Profile</button></td>
            </tr>
        </table>
    </form>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>
</html>
