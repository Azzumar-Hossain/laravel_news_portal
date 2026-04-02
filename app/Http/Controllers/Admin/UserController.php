<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    // Show the user management dashboard
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    // Save a new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,editor'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    // Show the form to edit a user
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Save the updated user details (and reset password if provided)
    public function update(Request $request, User $user)
    {
        // 1. Validate basic info (Notice we tell the email rule to ignore THIS user's current email)
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => ['required', 'in:admin,editor'],
        ];

        // 2. If the Admin typed in a new password, validate it too
        if ($request->filled('password')) {
            $rules['password'] = ['confirmed', Rules\Password::defaults()];
        }

        $request->validate($rules);

        // 3. Update the user
        $user->name = $request->name;
        $user->email = $request->email;
        
        // Don't let the admin accidentally downgrade themselves to an editor!
        if (auth()->id() !== $user->id) {
            $user->role = $request->role;
        }

        // 4. Hash and save the new password ONLY if the Admin typed one in
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    // Delete a user
    public function destroy(User $user)
    {
        // Safety check: Prevent the admin from accidentally deleting themselves!
        if (auth()->id() === $user->id) {
            return redirect()->route('users.index')->with('error', 'You cannot delete your own account!');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}