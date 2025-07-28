<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\PostModel;
use Illuminate\Support\Facades\Storage;
class PostSectionController extends Controller
{
    public function index()
    {
        $posts = PostModel::all();
        return view('admin.Home.post_section',compact('posts'));
    }

    public function storePost(Request $request){
        $validatedData = $request -> validate([
            'heading' => 'required',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,gif,jpg|max:2048'
        ]);
        Log::info('validated data for post',$validatedData);

        $imagePath = null;
        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('postSection','public');
        }

        PostModel::create([
            'heading' => $validatedData['heading'],
            'description' => $validatedData['description'],
            'post_image' => $imagePath
        ]);
        return redirect()->back()->with('success','Post saved successfully');
    }
    public function updatePost(Request $request){
        $validatedData = $request->validate([
            'heading' => 'required',
            'description' => 'required|string',
        ]);
        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('postSection','public');
        }

        $update = PostModel::find($request->post_id);
        $update->heading = $validatedData['heading'];
        $update->description = $validatedData['description'];

        if($request->hasFile('image')){
            $update->post_image = $imagePath;
        }
        $update->save();
        return redirect()->back()->with('success','Slider update successfully');
    }
    public function destroyPost($id)
    {
        $post = PostModel::find($id);
        if(!$post){
            return redirect()->back()->with('error','Post not found');
        }
        if($post->post_image){
            Storage::disk('public')->delete($post->post_image);
        }
        $post->delete();

        return redirect()->back()->with('success','Post deleted successfully');
    }
}
