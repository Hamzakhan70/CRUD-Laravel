<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
</head>
<body>
    <h1>Admin Dashboard</h1>
    {{-- @if (session('message'))
    <span class="alert alert-success">{$message}</span>
    @endif --}}
    <table id="users-table" class="display">
        <thead>
            <tr>
                <th>Name</th>
                <th>UserName</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                searching:true,
                ajax: '/admin/getusers',
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'username', name: 'username' },
                    { data: 'email', name: 'email' },
                    { data: 'role', name: 'role' },
                    // { data: 'image', name: 'image' },
                    // { data: 'country', name: 'country' },
                    {
                        data: 'id',
                        render: function(data, type, row) {
                            return `
                                <a href="#" class="edit-user" data-id="${data}">Edit</a> |
                                <a href="#" class="delete-user" data-id="${data}">Delete</a>
                            `;
                        },
                        orderable: true
                    }
                ]

            });
        });

        $(document).on('click', '.delete-user', function(e) {
            e.preventDefault();
            var userId = $(this).data('id');
            if (confirm("Are you sure you want to delete this user?")) {
                $.ajax({
                    url: '/admin/users/' + userId,
                    type: 'DELETE',
                    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
                    success: function(result) {
                        alert('User deleted successfully!');
                        $('#users-table').DataTable().ajax.reload();
                    }
                });
            }
        });

        $(document).on('click', '.edit-user', function(e) {
            e.preventDefault();
            var userId = $(this).data('id');
            window.location.href = '/admin/users/' + userId + '/edit';
        });
    </script>
</body>
</html>
