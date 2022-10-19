<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{


    public function forceDelete($post)
    {
        Post::onlyTrashed()->where(['id' => $post])->forceDelete();

        return redirect()->route('posts.trashed');

    }

    public function restore($post)
    {
        $post = Post::onlyTrashed()->where(['id' => $post])->first();

        if($post->trashed()){
            $post->restore(); 
        }

        return redirect()->route('posts.trashed');
    }

    public function trashed()
    {

        $posts = Post::onlyTrashed()->get();


        return view('posts.trashed', ['posts' => $posts]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //  $posts = Post::where('created_at', '>=', date('Y-m-d H:i:s'))
        //  ->orderBy('title', 'desc')
        // ->take(2)
        //  ->get();

         // foreach($posts as $post)
        // {
        //     echo "<h1>{$post->title}</h1>";
        //     echo "<h2>{$post->subtitle}</h2>";
        //     echo "<p>{$post->description}</p>";
        //     echo "</hr>";

        // }

           // $post = Post::where('created_at', '>=', date('Y-m-d H:i:s'))->first();
           // $post = Post::where('created_at', '>=', date('Y-m-d H:i:s'))->firstOrFail();

            // echo "<h1>{$post->title}</h1>";
            // echo "<h2>{$post->subtitle}</h2>";
            // echo "<p>{$post->description}</p>";
           // echo "</hr>";

        //    $post = Post::find(1);
        //    echo "<h1>{$post->title}</h1>";
        //    echo "<h2>{$post->subtitle}</h2>";
        //    echo "<p>{$post->description}</p>";
        //    echo "</hr>";



       // $posts = Post::all();
       $posts = Post::withTrashed()->get();

        return view('posts.index', ['posts' => $posts]);

    //     foreach($posts as $post)
    //  {
    //     echo "<h1>{$post->title}</h1>";
    //        echo "<h2>{$post->subtitle}</h2>";
    //        echo "<p>{$post->description}</p>";
    //        echo "</hr>";

    //      }


       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $postRequest = [
        //    'title' => $request->title,
            
        // ];

        $post = new Post;

        $post->title = $request->title;
        $post->subtitle = $request->subtitle;
         $post->description = $request->description;
        $post->save();


        // Post::create([
        //     'title' => $request->title,
        //     'subtitle' => $request->subtitle,
        //     'description' => $request->description
        // ]);

    //    $post =  Post::firstOrNew([
    //         'title' => 'zxzx'
    //    ], [
    //         'subtitle' => 'zxzxz',
    //         'description' => 'zxzxz'
    //    ]);

    //    $post->save();

    
//     $post =  Post::firstOrCreate([
//            'title' => 'zxzx'
//     ], [
//             'subtitle' => 'zxzxz',
//             'description' => 'zxzxz'
//        ]);
//    $post->save();

    return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
     //   $post = new Post;

         $post = Post::find($post->id);
         $post->title = $request->title;
         $post->subtitle = $request->subtitle;
         $post->description = $request->description;
         $post->save();

        // $post = Post::updateOrCreate([
        //               'title' => 'teste6'
        //            ],[
        //                'subtitle' => 'teste7',
        //                'description' => 'teste7'
        //           ]);

        Post::where('created_at', '>=', date('Y-m-d H:i:s'))->update(['description' => 'teste']);
        
        return redirect()->route('posts.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Post::find($post->id)->delete();
        // Post::destroy([2,3 ]);
        // Post::destroy($post->id);
        // Post::where('created_at', '>=', date('Y-m-d H:i:s'))->delete();
        return redirect()->route('posts.index');
    }
}
