<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = request()->get("page", 0);
        $pageSize = request()->get("pageSize", 0);
        $posts = Post::with("author")->paginate($pageSize, ["*"], "page", $page);

        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        request()->validate([
            "title" => "required|max:255",
            "content" => "required",
            "cover" => "required"
        ]);

        $post = new Post();
        $post->fill(request()->all());
        $post->userId = request()->user()->id;
        $post->save();

        return response()->noContent();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::query()->where("id", "=", $id)->with("author")->first();
        if ($post == null) {
            return response()->json([ "message" => "post not found" ], 404);
        }
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {

        $post = Post::query()->where("id", "=", $id)->first();
        if ($post == null) {
            return response()->json([ "message" => "post not found" ], 404);
        }

        if ($post->userId != request()->user()->id) {
            return response()->json([ "message" => "forbidden access" ], 403);
        }

        $post->fill(request()->all());
        $post->userId = request()->user()->id;
        $post->save();

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::query()->where("id", "=", $id)->first();
        if ($post == null) {
            return response()->json([ "message" => "post not found" ], 404);
        }

        if ($post->userId != request()->user()->id) {
            return response()->json([ "message" => "forbidden access" ], 403);
        }

        $post->delete();

        return response()->noContent();
    }
}
