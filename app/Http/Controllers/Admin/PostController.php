<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    // 'slug' => 'required|string|max:100|unique:posts'
    // abbiamo trasformato lo slug in un array perché
    private $validations = [
        'slug'    => [
            'required',
            'string',
            'max:100',
        ],
        'title'   => 'required|string|max:100',
        'image'   => 'string|max:100',
        'uploaded_img' => 'image|max:1024',
        'content' => 'string',
        'excerpt' => 'string',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(5);

        return view('admin.posts.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        $request->validate($this->validations);

        $data = $request->all();

        //dd($data);

        $img_path = Storage::put('uploads', $data['uploaded_img']); //ricorda di fare il chmod 777 alla cartella storage/app/public

        // salvare i dati nel db
        $post = new Post();
        $post->slug         = $data['slug'];
        $post->title        = $data['title'];
        $post->image        = $data['image'];
        $post->uploaded_img = $img_path;
        $post->content      = $data['content'];
        $post->excerpt      = $data['excerpt'];
        $post->save();

        // ridirezionare (e non ritornare una view)
        return redirect()->route('admin.posts.show', ['post' => $post]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // validation
        $this->validations['slug'][] = Rule::unique('posts')->ignore($post);
        $request->validate($this->validations);

        $data = $request->all();

        $img_path = Storage::put('uploads', $data['uploaded_img']);
        Storage::delete($post->uploaded_img);

        // salvare i dati nel db
        $post->slug    = $data['slug'];
        $post->title   = $data['title'];
        $post->image   = $data['image'];
        $post->uploaded_img = $img_path;
        $post->content = $data['content'];
        $post->excerpt = $data['excerpt'];
        $post->update();

        // ridirezionare e non ritornare una view (spiegare il motivo)
        return redirect()->route('admin.posts.show', ['post' => $post]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success_delete', $post);
    }
}
