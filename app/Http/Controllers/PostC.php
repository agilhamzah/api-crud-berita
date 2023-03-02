<?php

namespace App\Http\Controllers;

use App\Models\PostM;
use Illuminate\Http\Request;
use App\Http\Resources\PostR;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostC extends Controller
{
    public function index()
    {
        $posts = PostM::latest()->paginate(5);
        return new PostR(true, 'List Data Posts', $posts);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webm',
            'title' => 'required',
            'content' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $image = $request->file('image');
        $image->storeAs('public/posts', $image->hashName());

        $post = PostM::create([
            'image' => $image->hashName(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return new PostR(true, 'Data Post Berhasil Ditambahkan!', $post);
    }

    public function show(PostM $post){
        return new PostR(true, 'Data Post Ditemukan!', $post);
    }

    public function update(Request $request, PostM $post){
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'content' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('image')){
           
            $image = $request->file('image');
            $image->storeAs('public/posts', $image->hashName());

            Storage::delete('public/posts/'.$post->image);

            $post->update([
                'image' => $image->hashName(),
                'title' => $request->title,
                'content' => $request->content,
            ]);
       
        } else {

            $post->update([
                'title' => $request->title,
                'content' => $request->content,
            ]);
        }

        return new PostR(true, 'Data Berhasil Diubah!', $post);
    }

    public function destroy(PostM $post){
        Storage::delete('public/posts/'.$post->image);

        $post->delete();

        return new PostR(true, 'Data Post Berhasil Dihapus!', null);
    }
}
