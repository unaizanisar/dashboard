<?php

namespace App\Http\Controllers\Blogs;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Controllers\Admin\Auth;

class CategoryController extends Controller
{
    use ApiResponseTrait;
    // public function __construct()
    // {
    //     $this->middleware('check.permissions:Category Listing')->only('index');
    //     $this->middleware('check.permissions:Category Add')->only(['create', 'store']);
    //     $this->middleware('check.permissions:Category Edit')->only(['edit', 'update']);
    //     $this->middleware('check.permissions:Category Delete')->only('destroy');
    //     $this->middleware('check.permissions:Category Change Status')->only('updateStatus');
    // }
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('categories.index', compact('categories'));
    }
    public function list()
    {
        return Category::all();
    }

    public function create()
    {
        return view('categories.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        Category::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.show', compact('category'));
    }
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
    public function updateStatus($id, $status)
    {
        $category = Category::findOrFail($id);
        $category->status = $status;
        $category->save();
        return redirect()->route('categories.index')->with('success', 'Category status updated successfully.');
    }
    public function apiStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return $this->apiErrorResponse($validator->errors()->first(), 422);
        }
        $category = Category::create($request->all());
        return $this->apiSuccessResponse('Category created successfully.', $category, 201);
    }

    public function apiShow($id)
    {
        $category = Category::findOrFail($id);
        if(!$category){
            return $this->apiErrorResponse($validator->errors());
        }
        return $this->apiSuccessResponse('Category.', $category, 201);

    }
    public function apiUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);
        if ($validator->fails()) {
            return $this->apiErrorResponse('Category not updated.', 422, $validator->errors());
        }
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return $this->apiSuccessResponse('Category updated successfully.', $category);
    }

    public function apiDestroy($id)
    {
        $category = Category::findOrFail($id);
        if(!$category){
            return $this->apiErrorResponse($validator->errors());
        }
        $category->delete();
        return $this->apiSuccessResponse('Category deleted successfully.');
    }

    public function apiUpdateStatus($id, $status)
    {
        $category = Category::findOrFail($id);
        $category->status = $status;
        $category->save();

        return response()->json(['message' => 'Category status updated successfully.', 'category' => $category], 200);
    }
}
