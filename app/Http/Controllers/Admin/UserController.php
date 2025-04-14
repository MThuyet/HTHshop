<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('limit-row-length', 10);
        $search = $request->get('search');

        $query = User::query();

        if($search) {
            $query->where('fullname', 'like', "%{$search}%")
                ->orWhere('username', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        }
        $users = $query->paginate($perPage);
        
        return view('pages.admin.users.index', compact('users', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'fullname' => 'required|max:50',
            'username' => 'required|max:20|unique:users',
            'email' => 'required|email|max:100|unique:users',
            'phone' => 'nullable|max:11',
            'password' => 'required|min:6',
            'description' => 'nullable',
            'role' => 'required|in:ADMIN,STAFF',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admin.user')->with('success', 'User Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('pages.admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->merge([
            'active' => $request->has('active')
        ]);
        
        $validated = $request->validate([
            'fullname' => 'required|max:50',
            'username' => 'required|max:20|unique:users,username,' . $user->id,
            'email' => 'required|email|max:100|unique:users,email,' . $user->id,
            'phone' => 'nullable|max:11',
            'description' => 'nullable',
            'role' => 'required|in:ADMIN,STAFF',
            'active' => 'boolean',
            'password' => 'nullable|min:6'
        ]);

        if ($request->password) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);
        
        return redirect()->route('admin.user')->with('success', 'User updated!');
    }

    public function toggleActive(User $user)
    {
        $user->active = !$user->active;

        $user->save();
    
        return redirect()->route('admin.user')->with('success', 'User active status updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.user')->with('success', 'User deleted'); 
    }
}
