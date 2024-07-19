<?php
namespace App\Http\Controllers\Blogs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Controllers\Admin\Auth;
class BlogController extends Controller
{
    use ApiResponseTrait;
    public function index(){
        $blogs = Blog::orderBy('id','desc')->get();
        return view('blogs.index', compact('blogs'));
    }
    public function list()
    {
        return Blog::all();
    }
    public function create(){
        $categories = Category::all();
        $users = User::all();
        return view('blogs.create', compact('categories', 'users'));
    }
    public function store(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);
        $blog = new Blog($request->all());
        $blog->status = 1;
        $blog->save();
        return redirect()->route('blogs.index')->with('success', 'Blog added successfully!');
    }
    public function show($id){
        $blog = Blog::findOrFail($id);
        return view('blogs.show', compact('blog'));
    }
    public function destroy($id){
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully!');
    }
    public function updateStatus($id, $status){
        $blog = Blog::findOrFail($id);
        $blog->status = $status;
        $blog->save();
        return redirect()->route('blogs.index')->with('success', 'Status updated successfully');
    }
    public function edit($id){
        $blog = Blog::findOrFail($id);
        $categories = Category::all();
        $users = User::all();
        return view('blogs.edit', compact('blog', 'categories', 'users'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);
        $blog = Blog::findOrFail($id);
        $blog->update($request->all());
        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully!');
    }
    public function apiStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);
        if ($validator->fails()) {
            return $this->apiErrorResponse($validator->errors()->first(), 422);
        }
        $blog = new Blog($request->all());
        $blog->status = 1;
        $blog->save();
        return $this->apiSuccessResponse('Blog created successfully.', $blog, 201);
    }

    public function apiShow($id)
    {
        $blog = Blog::findOrFail($id);
        if(!$blog){
            return $this->apiErrorResponse('Not found', 404, $validator->errors());
        }
        return $this->apiSuccessResponse('Blog.', $blog, 201);
    }
    public function apiUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return $this->apiErrorResponse('Blog not updated.', 422, $validator->errors());
        }

        $blog = Blog::findOrFail($id);
        $blog->update($request->all());
        return $this->apiSuccessResponse('Blog updated successfully.', $blog);
    }
    public function apiDestroy($id)
    {
        $blog = Blog::findOrFail($id);
        if (!$blog) {
            return $this->apiErrorResponse('Blog not found.', 404, $validator->errors());
        }
        $blog->delete();
        return $this->apiSuccessResponse('Blog deleted successfully.');
    }
    public function apiUpdateStatus($id, $status)
    {
        $blog = Blog::findOrFail($id);
        $blog->status = $status;
        $blog->save();

        return response()->json(['message' => 'Blog status updated successfully.', 'blog' => $blog], 200);
    }
}
