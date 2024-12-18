<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    function getLoggedUser() {
        $user = request()->user();
        return response()->json(["user" => $user]);
    }

    function show($id) {
        $user = User::query()->where("id", "=", $id)->first();
        if ($user == null) {
            return response()->json([
                "message" => "user not found"
            ], 404);
        }
        return response()->json(["user" => $user]);
    }

    function index() {
        $page = request()->get("page", 0);
        $pageSize = request()->get("pageSize", 0);
        $users = User::query()->paginate($pageSize, ["*"], "page", $page);

        return response()->json($users);
    }

    function posts($id) {
        $page = request()->get("page", 0);
        $pageSize = request()->get("pageSize", 0);
        $posts = Post::with("author")
            ->where("userId", "=", $id)
            ->paginate($pageSize, ["*"], "page", $page);

        return response()->json($posts);
    }
}
