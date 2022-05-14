<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request, $categorySlug)
    {
        $posts = Post::with('category')
            ->whereRelation('category', 'slug', $categorySlug)
            ->isPublished()
            ->get();

        // SEO
        // $this->setTitle($category->name);
        // $this->setDescription(self::DESCRIPTION_PAGE);
        // $this->setImage(request()->url() . self::IMAGE_PAGE);
        // $this->setSEO();

        return view('pages.post-index', compact('posts'));
    }

    public function show(Request $request, $categorySlug, $id)
    {
        $post = Post::with(['category', 'user'])
            ->where('id', $id)
            ->whereRelation('category', 'slug', $categorySlug)
            ->firstOrFail();

        $this->_incrementView($post);

        $relatedPosts = $this->_getRelatedPosts($id);

        // SEO
        // $this->setTitle($post->title);
        // $this->setDescription($post->content_resume);
        // $this->setImage($post->image);
        // $this->setSEO();
        // $this->seo()->metatags()
        //     ->addKeyword([$post->title, 'Luật ' . $post->category->name])
        //     ->addMeta('article:published_time', $post->created_at->toW3CString(), 'property')
        //     ->addMeta('article:section', 'Luật ' . $post->category->name, 'property');

        return view('pages.post', compact('post', 'relatedPosts'));
    }

    private function _getRelatedPosts($postId = null)
    {
        $relatedPosts =  Post::with(['category', 'user']);
        if (!is_null($postId)) {
            $relatedPosts = $relatedPosts->whereNotIn('id', [$postId]);
        }
        $relatedPosts = $relatedPosts->isPublished()
            ->inRandomOrder()
            ->limit(4)
            ->get();
        return $relatedPosts;
    }

    private function _incrementView(Post $post)
    {
        $sessionKey = 'post__' . $post->slug;
        $sessionView = session()->get($sessionKey);
        if (!$sessionView) {
            session()->put($sessionKey, time());
            $post->increment('view');
        }
    }
}
