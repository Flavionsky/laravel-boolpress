<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\PostRequest;

use App\Post;

use App\Category;

use App\PostInformation;

use App\Tag;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {

        $this->middleware('auth')->except('index', 'show');
    }

    public function index()
    {
        $posts = Post::all();
        $userLogged = Auth::user();


        return view('posts.index', compact('posts', 'userLogged'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();

        return view('posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        //validation
        $data = $request->validated();

        //new instance
        $newPost = new Post;

        //inserts fillables and filters the other fields
        $newPost->fill($data);


        $newPost->category()->associate(
            Category::firstOrCreate(
                ['title' => $data['category']],
                ['slug' => Str::slug($data['category'], '-')]
            )
        );

        $newPost->user()->associate(Auth::user());

        if ($request->file('image') != null) {

            $newPost->image_url = $request->file('image')->storePublicly('images');
        }
        
        $newPost->save();
        
        $newPostInfo = new PostInformation();
        $newPostInfo->post_id = $newPost->id;
        $newPostInfo->slug = Str::slug($newPost->title);
        $newPostInfo->description = $data['description'];

        $newPostInfo->save();
        
        //creates tags from the tags string
        
        $tagsIDs = array_map(function($el){
            $tag = Tag::firstOrCreate(
                ['name' => $el ],
            );
            return $tag->id;
        }, explode(' ', $data['tags']));

        //associa i tag al post
        $newPost->tags()->attach($tagsIDs);

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $userLogged = Auth::user();

        $data = [
            'categories' => Category::all(),
            'tags' => Tag::all(),
            'post' => $post
        ];

        if ($userLogged->id == $post->user->id) {

            return view('posts.edit', $data);
        } else {
            return redirect()->route('posts.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $data = $request->all();

        $post->update([
            'title' => $data['title'],
            'author' => $data['author'],
            'category_id' => $data['category_id']
        ]);

        $post->postInfo()->update(['description' => $data['description']]);

        $post->tags()->sync($data['tags']);

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->postInfo->delete();

        foreach ($post->tags as $tag) {

            $post->tags()->detach($tag->id);
        }

        $post->delete();

        return redirect()->back();
    }
}
