<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller {
    /**
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function index() {
        $users = User::simplePaginate(10);

        return $users;
    }

    /**
     * @param User $user
     * @return User
     */
    public function show(User $user) {
        return $user;
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(User $user) {
        $user->delete();

        return response()->json(NULL, 204);
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function posts(User $user) {
        return response()->json([
            ['User' => $user],
            ['Posts' => $user->posts],
        ]);
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function postsDelete(User $user) {
        $userId = $user->id;
        Post::whereIn('user_id', [$userId])->delete();;

        return response()->json(NULL, 204);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function postsStore(Request $request, User $user) {
        $userId = $user->id;
        $request->request->add(['user_id' => $userId]);
        $request->request->add(['slug' => Str::slug($request->title)]);
        $post = Post::create($request->all());

        return response()->json($post);
    }
}
