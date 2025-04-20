<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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
        try {
            $validated = $request->validate([
                'fullname' => 'required|max:50',
                'email' => 'required|email|max:100|unique:users',
                'phone' => 'nullable|max:11',
                'password' => 'required|min:6',
                'description' => 'nullable',
                'role' => 'required|in:ADMIN,STAFF',
            ]);
    
            $validated['password'] = Hash::make($validated['password']);
            User::create($validated);
    
            return redirect()->route('admin.user')->with('toast', [
                'title' => 'Tạo mới thành công',
                'text' => 'Tạo thông tin người dùng mới thành công',
                'icon' => 'success'
            ]);
        } catch (ValidationException $e) {
            $firstField = array_key_first($e->errors()); 
            $firstError = $e->errors()[$firstField][0];  
    
            return redirect()->route('admin.user.create')->with('toast', [
                'title' => 'Lỗi tạo người dùng',
                'text' => $firstError,
                'icon' => 'error'
            ]);
        } catch (\Exception $e) {
            return redirect()->route('admin.user.create')->with('toast', [
                'title' => 'Tạo mới thất bại',
                'text' => 'Lỗi: ' . $e->getMessage(),
                'icon' => 'error'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('pages.admin.users.show', compact('user'));
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
        try {
            $request->merge([
                'active' => $request->has('active')
            ]);
            
            $validated = $request->validate([
                'fullname' => 'required|max:50',
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
            
            return redirect()->back()->with('toast', [
                'title' => 'Cập nhật thành công',
                'text' => 'Cập nhật thông tin người dùng thành công',
                'icon' => 'success'
            ]);
        } catch(ValidationException $e) {
            $firstField = array_key_first($e->errors()); 
            $firstError = $e->errors()[$firstField][0];  
    
            return redirect()->back()->with('toast', [
                'title' => 'Lỗi cập nhật thông tin người dùng',
                'text' => $firstError,
                'icon' => 'error'
            ]);
        } catch(\Exception $e) {
            return redirect()->back()->with('toast', [
                'title' => 'Lỗi cập nhật thông tin người dùng',
                'text' => $e->getMessage(),
                'icon' => 'error'
            ]);
        }
    }

    public function toggleActive(User $user)
    {
        try {
            $user->active = !$user->active;
            $user->save();
            return redirect()->back()->with('toast', [
                'title' => 'Cập nhật trạng thái',
                'text' => 'Cập nhật trạng thái người dùng '. $user->fullname .' thành công',
                'icon' => 'success'
            ]);
        } catch(\Exception $e) {
            return redirect()->back()->with('toast', [
                'title' => 'Lỗi cập nhật trạng thái',
                'text' => $e->getMessage(),
                'icon' => 'error'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();

            return redirect()->route('admin.user')->with('toast', [
                'title' => 'Xóa thành công',
                'text' => 'Xóa thông tin người dùng thành công',
                'icon' => 'success'
            ]);
        } catch (\Exception $e) {
            return redirect()->route('admin.user')->with('toast', [
                'title' => 'Lỗi xóa người dùng',
                'text' => $e->getMessage(),
                'icon' => 'error'
            ]);
        }
    }
}
