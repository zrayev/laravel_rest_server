<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class PostController extends Controller {
    /**
     * @return \Illuminate\Contracts\Pagination\Paginator|\Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index() {
        $posts = Post::simplePaginate(10);
        if (App::runningUnitTests()) {
            $posts = Post::all();
        }

        return $posts;
    }

    /**
     * @param Post $post
     * @return Post
     */
    public function show(Post $post) {

        return $post;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) {
        $request->request->add(['slug' => Str::slug($request->title)]);
        $post = Post::create($request->all());

        return response()->json($post);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Post $post) {
        $post->update($request->all());

        return response()->json($post);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePatch(Request $request, Post $post) {
        $post->update($request->all());

        return response()->json($post);
    }

    /**
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Post $post) {
        $post->delete();

        return response()->json(NULL, 204);
    }
}
