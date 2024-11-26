<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Only allow admin to access this controller
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin'); // Custom middleware to check for admin role
    }

    public function index()
    {
        return view('auth.admin_dashboard');
    }

    public function getUsers()
    {

         $users = User::all();

$response = [];
foreach ($users as $user) {
    $response[] = [
        'name' => $user->name,
        'username' => $user->username,
        'email' => $user->email,
        'role' => $user->role,
        'id' => $user->id
    ];
}

return response()->json(['data' => $response]);

    }

    public function deleteUser($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(['success' => true, 'message' => 'User deleted successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    public function editUser($id)
    {
        $user = User::findOrFail($id); // Fetch user by ID
        return view('auth.edit', compact('user')); // Return the edit view
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return redirect("/admin/dashboard")->with('message', 'User updated successfully');
    }

}
