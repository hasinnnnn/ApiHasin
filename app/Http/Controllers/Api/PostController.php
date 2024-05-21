<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Post::orderBy('created_at', 'desc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datapost = new Post;

        $rules = [
            'title' => 'required',
            'author' => 'required',
            'slug' => 'required',
            'body' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'data gagal ditambah',
                'data' => $validator->errors()
            ]);
        }

        $datapost->title = $request->title;
        $datapost->author = $request->author;
        $datapost->slug = $request->slug;
        $datapost->body = $request->body;

        $post = $datapost->save();
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditambah'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Post::find($id);
        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'

            ]);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $datapost = Post::find($id);
        if (empty($datapost)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',

            ], 404);
        }
        $rules = [
            'title' => 'required',
            'author' => 'required',
            'slug' => 'required',
            'body' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'data gagal diupdate',
                'data' => $validator->errors()
            ]);
        }

        $datapost->title = $request->title;
        $datapost->author = $request->author;
        $datapost->slug = $request->slug;
        $datapost->body = $request->body;

        $post = $datapost->save();
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diupdate'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $datapost = Post::find($id);
        if (empty($datapost)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',

            ], 404);
        }
        $post = $datapost->delete();
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
