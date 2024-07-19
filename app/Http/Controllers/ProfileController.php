<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
class ProfileController extends Controller
{
    use ApiResponseTrait;
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }
    public function apiShow()
    {
        $user = Auth :: user();
        return response()->json(['user' => $user]);
    }
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }
    public function update(Request $request)
    {
        $user = Auth::user();
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'address' => 'nullable|string|max:255',
            'gender' => 'required|in:male,female',
            'phone' => 'nullable|numeric|unique:users,phone,' . $user->id . '|min:11',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
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

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }
    public function apiUpdate(Request $request)
    {
        $user = Auth::user();
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'address' => 'nullable|string|max:255',
            'gender' => 'required|in:male,female',
            'phone' => 'nullable|numeric|unique:users,phone,' . $user->id . '|min:11',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
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
        return $this->apiSuccessResponse('User updated successfully.', $user);
    }

}
