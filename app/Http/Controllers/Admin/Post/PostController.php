<?php

namespace App\Http\Controllers\Admin\Post;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Http\Requests\Admin\Post\PostCreateRequest;
use App\Http\Requests\Admin\Post\PostUpdateRequest;

class PostController extends Controller
{
    const PATH_SAVE_IMAGE = 'storage/posts';
    const WIDTH_IMAGE = 400;
    const HEIGHT_IMAGE = 300;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search_term = $request->q ?? '';

        $posts = Post::query()->with(['user', 'category']);

        if ($request->category) {
            $posts = $posts->where('category_id', $request->category);
        }

        $posts = $posts->search($search_term)
            ->orderByDesc('view')
            ->latest()
            ->paginate(config('app.limit_page'))
            ->withQueryString();

        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\PostCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
        $input = $request->validated();
        $input['user_id'] = auth()->id();
        $input['image'] = $this->_saveImage($request);

        Post::create($input);

        return redirect()->route('admin.posts.index')->with([
            'notify' => config('message.create_success')
        ]);
    }

    private function _saveImage($request)
    {
        $file = $request->file('image');
        $file_name = time() . '.' . $file->getClientOriginalExtension();

        if (!file_exists(public_path(self::PATH_SAVE_IMAGE))) {
            mkdir(public_path(self::PATH_SAVE_IMAGE));
        }

        Image::make($file)
            ->fit(self::WIDTH_IMAGE, self::HEIGHT_IMAGE)
            ->save(public_path(self::PATH_SAVE_IMAGE . '/' . $file_name));

        return $file_name;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with('category')->findOrFail($id);
        return response()->json([
            'data' => $post
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\PostUpdateRequest  $request
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        $post->update($request->validated());

        return redirect()->route('admin.posts.index')->with([
            'notify' => config('message.update_success')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        $this->_removeImage($post->image_name);

        return back()->with([
            'notify' => config('message.delete_success'),
            'notify-type' => 'success'
        ]);
    }

    private function _removeImage($image_name)
    {
        if ($image_name && file_exists(public_path(self::PATH_SAVE_IMAGE . '/' . $image_name))) {
            unlink(public_path(self::PATH_SAVE_IMAGE . '/' . $image_name));
        }
    }
}
