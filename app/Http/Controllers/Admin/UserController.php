<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\ApiResponseTrait;
class UserController extends Controller
{
    use ApiResponseTrait;
    // public function __construct()
    // {
    //     $this->middleware('check.permissions:User Listing')->only(['index', 'show']);
    //     $this->middleware('check.permissions:User Add')->only(['create', 'store']);
    //     $this->middleware('check.permissions:User Edit')->only(['edit', 'update']);
    //     $this->middleware('check.permissions:User Delete')->only('destroy');
    //     $this->middleware('check.permissions:User Change Status')->only('updateStatus');
    // }
    public function list()
    {
        return User::all();
    }

    public function index()
    {
        $users = User::with('role')->orderBy('id', 'desc')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::where('name', '!=', 'super admin')->get();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'address' => 'nullable|string|max:255',
            'gender' => 'required|in:Male,Female',
            'phone' => 'nullable|numeric|unique:users|digits_between:11,15',
            'role_id' => 'required|exists:roles,id',
        ]);
        if ($validator->fails()) {
            return $this->apiErrorResponse($validator->errors()->first(), 422);
        }
        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->role_id = $request->role_id;

        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $user->profile_photo = $filename;
        }

        $user->save();
        return redirect()->route('users.index')->with('success', 'User added successfully.');
    }

    public function apiStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'address' => 'nullable|string|max:255',
            'gender' => 'required|in:Male,Female',
            'phone' => 'nullable|numeric|unique:users|digits_between:11,15',
            'role_id' => 'required|exists:roles,id',
        ]);
        if ($validator->fails()) {
            return $this->apiErrorResponse($validator->errors()->first(), 422);
        }
        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->role_id = $request->role_id;

        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $user->profile_photo = $filename;
        }
        $user->save();
        return $this->apiSuccessResponse('User added successfully.', $user, 201);
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function apiShow($id)
    {
        $user = User::findOrFail($id);
        if(!$user){
            return $this->apiErrorResponse($validator->errors());
        }
        return $this->apiSuccessResponse('User',$user, 201);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        if (request()->expectsJson()) {
            return response()->json(compact('user', 'roles'));
        }
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'address' => 'nullable|string|max:255',
            'gender' => 'required|in:Male,Female',
            'phone' => 'nullable|numeric|unique:users,phone,' . $id . '|digits_between:11,15',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::findOrFail($id);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->phone = $request->phone;

        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            if ($user->profile_photo) {
                $oldFilePath = public_path('uploads/' . $user->profile_photo);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
            $user->profile_photo = $filename;
        }

        $user->save();
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function apiUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'address' => 'nullable|string|max:255',
            'gender' => 'required|in:Male,Female',
            'phone' => 'nullable|numeric|unique:users,phone,' . $id . '|digits_between:11,15',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::findOrFail($id);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->phone = $request->phone;

        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            if ($user->profile_photo) {
                $oldFilePath = public_path('uploads/' . $user->profile_photo);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
            $user->profile_photo = $filename;
        }
        if ($validator->fails()) {
            return $this->apiErrorResponse('User not updated.', 422, $validator->errors());
        }
        $user->save();
        return $this->apiSuccessResponse('User updated successfully.', $user);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User not found.');
        }
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
    public function apiDestroy($id)
    {
        $user = User::findOrFail($id);
        if (!$user) {
            return $this->apiErrorResponse('User not found.', 404, $validator->errors());
        }
        $user->delete();
        return $this->apiSuccessResponse('User deleted successfully.');
    }
    public function updateStatus($id, $status)
    {
        $user = User::findOrFail($id);
        $user->status = $status;
        $user->save();
        return redirect()->route('users.index')->with('success', $status == 1 ? 'User activated successfully.' : 'User deactivated successfully.');
    }
    public function apiUpdateStatus($id, Request $request)
    {
        $user = User::findOrFail($id);
        $user->status = $request->status;
        $user->save();
        return $this->apiSuccessResponse('User status updated successfully.', $user);
    }
}
