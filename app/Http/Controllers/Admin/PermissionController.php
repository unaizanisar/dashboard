<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Controllers\Admin\Auth;
class PermissionController extends Controller
{
    use ApiResponseTrait;
    // public function __construct()
    // {
    //     $this->middleware('check.permissions:Permissions Listing')->only('index');
    //     $this->middleware('check.permissions:Permissions Add')->only(['create', 'store']);
    //     $this->middleware('check.permissions:Permissions Edit')->only(['edit', 'update']);
    //     $this->middleware('check.permissions:Permissions Delete')->only('destroy');
    //     $this->middleware('check.permissions:Permissions Change Status')->only('updateStatus');
    // }
    public function index(){
        $permissions = Permission :: orderBy('id','desc')->get();
        return view('permissions.index',compact('permissions'));
    }
    public function list()
    {
        return Permission::all();
    }
    public function create(){
        return view('permissions.create');
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'module' => 'required|string|max:255',
        ]);
        Permission::create($request->all());
        return redirect()->route('permissions.index')->with('success','Permission added successfully!');
    }
    public function show($id){
        $permission = Permission :: findOrFail($id);
        return view('permissions.show',compact('permission'));
    }
    public function edit($id){
        $permission = Permission :: findOrFail($id);
        return view('permissions.edit',compact('permission'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'module' => 'nullable|string',
        ]);
        $permission = Permission::findOrFail($id);
        $permission->update($request->all());
        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully!');
    }
    public function destroy($id){
        $permission = Permission :: findOrFail($id);
        $permission->delete();
        return redirect()->route('permissions.index')->with('success','Permission deleted successfully!');
    }
    public function updateStatus($id, $status){
        $permission = Permission :: findOrFail($id);
        $permission->status = $status;
        $permission->save();
        return redirect()->route('permissions.index')->with('success','Status Updated successfully!');
    }
    public function apiStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'module' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return $this->apiErrorResponse($validator->errors()->first(), 422);
        }
        $permission = Permission::create($request->all());
        return $this->apiSuccessResponse('Permission added successfully.', $permission, 201);
    }
    public function apiShow($id)
    {
        $permission = Permission::findOrFail($id);
        if(!$permission){
            return $this->apiErrorResponse($validator->errors());
        }
        return $this->apiSuccessResponse('Permission.', $permission, 201);
    }
    public function apiUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'module' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return $this->apiErrorResponse($validator->errors());
        }
        $permission = Permission::findOrFail($id);
        $permission->update($request->all());
        return $this->apiSuccessResponse('Permission updated successfully', $permission, 200);
    }
    public function apiDestroy($id)
    {
        $permission = Permission::findOrFail($id);
        if(!$permission){
            return $this->apiErrorResponse($validator->errors());
        }
        $permission->delete();
        return $this->apiSuccessResponse('Permission deleted successfully.');
    }
    public function apiUpdateStatus($id, $status)
    {
        $permission = Permission::findOrFail($id);
        $permission->status = $status;
        $permission->save();
        return response()->json(['message' => 'Permission status updated successfully.', 'permission' => $permission], 200);
    }
}
