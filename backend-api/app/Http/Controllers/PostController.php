<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'success',
            'result' => $post
        ], 200);
    }

    public function show($id)
    {
        //find post by ID
        $post = Post::find($id);

        //response if not found
        if (!$post) {
            return response()->json([
                'message' => 'data not found!'
            ], 404);
        }
        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'success',
            'result'    => $post 
        ], 200);
    }

    public function store(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'title'   => 'required',
            'content' => 'required',
        ]);
        
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $post = Post::create([
            'title'     => $request->title,
            'content'   => $request->content
        ]);

        //success save to database
        if($post) {
            return response()->json([
                'success' => true,
                'message' => 'create post success',
                'data'    => $post  
            ], 201);
        } 

        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'create post failed',
        ], 409);
    }

    public function update(Request $request, $id)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'title'   => 'required',
            'content' => 'required',
        ]);
        
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //find post by ID
        $post = Post::find($id);

        //response if not found
        if (!$post) {
            return response()->json([
                'status' => false,
                'message' => 'data not found!'
            ], 404);
        }

        if($post) {
            //update post
            $post->update([
                'title'     => $request->title,
                'content'   => $request->content
            ]);

            return response()->json([
                'success' => true,
                'message' => 'update post success',
                'data'    => $post  
            ], 200);
        }
    }

    public function destroy($id)
    {
        //find post by ID
        $post = Post::find($id);

        //response if not found
        if (!$post) {
            return response()->json([
                'status' => false,
                'message' => 'data not found!'
            ], 404);
        }

        if($post) {
            //delete post
            $post->delete();
            return response()->json([
                'success' => true,
                'message' => 'post delete success',
            ], 200);
        }
    }
}
