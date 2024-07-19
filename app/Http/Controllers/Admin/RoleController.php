<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;
class RoleController extends Controller
{
    use ApiResponseTrait;
    // public function __construct()
    // {
    //     $this->middleware('check.permissions:Roles Listing')->only('index');
    //     $this->middleware('check.permissions:Roles Add')->only(['create', 'store']);
    //     $this->middleware('check.permissions:Roles Edit')->only(['edit', 'update']);
    //     $this->middleware('check.permissions:Roles Delete')->only('destroy');
    //     $this->middleware('check.permissions:Roles Change Status')->only('updateStatus');
    // }
    public function index(){
        $roles = Role::orderBy('id', 'desc')->get();
        return view('roles.index',compact('roles'));
    }
    public function list()
    {
        return Role::all();
    }
    public function create(){
        $permissionsByModule = Permission::all()->groupBy('module');
        return view('roles.create',compact('permissionsByModule'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'array',
            'permissions.*' => 'integer|exists:permissions,id',
        ]);
        DB::transaction(function() use($request){
            $role = Role::create($request->only('name'));
            if($request->has('permissions')){
                $role->permissions()->sync($request->permissions);
            }
        });
        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }
    public function show($id){
        $role = Role::findOrFail($id);
        return view('roles.show', compact('role'));
    }
    public function edit($id){
        $role = Role::findOrFail($id);
        $permissionsByModule = Permission::all()->groupBy('module');
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        return view('roles.edit', compact('role', 'permissionsByModule', 'rolePermissions'));
    }
    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'permissions'=> 'array',
            'permissions.*' => 'integer|exists:permissions,id',
        ]);
        $role = Role::findOrFail($id);
        DB::transaction(function() use($request, $role){
            $role->update($request->only('name'));
            if ($request->has('permissions')) {
                $role->permissions()->sync($request->permissions);
            } else {
                $role->permissions()->sync([]);
            }
        });
        return redirect()->route('roles.index')->with('success','Role updated successfully!');
    }
    public function destroy($id){
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('roles.index')->with('success','Role deleted successfully!');
    }
    public function updateStatus($id, $status){
        $role = Role::findOrFail($id);
        $role->status = $status;
        $role -> save();
        return redirect()-> route('roles.index')->with('success','Status updated successfully!');
    }
    function search($name){
        return Role::where("name",$name)->get();
    }
    public function apiStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->apiErrorResponse($validator->errors()->first(), 422);
        }

        $role = Role::create($request->all());

        return $this->apiSuccessResponse('Role created successfully.',$role,201);
    }

    public function apiShow($id)
    {
        $role = Role::findOrFail($id);
        if(!$role){
            return $this->apiErrorResponse($validator->errors());
        }
        return $this-> apiSuccessResponse('Role',$role,201);
    }

    public function apiUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->apiErrorResponse($validator->errors());
        }

        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->save();

        return $this->apiSuccessResponse('Role updated successfully.', $role, 200);
    }

    public function apiDestroy($id)
    {
        $role = Role::findOrFail($id);
        if(!$role){
            return $this->apiErrorResponse($validator->errors());
        }
        $role->delete();
        return $this->apiSuccessResponse('Role deleted successfully.');
    }

    public function apiUpdateStatus($id, $status)
    {
        $role = Role::findOrFail($id);
        $role->status = $status;
        $role->save();

        return response()->json(['message' => 'Role status updated successfully.', 'role' => $role], 200);
    }
}
