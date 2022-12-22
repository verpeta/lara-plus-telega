<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
    /**
     * Отображает список ресурсов
     *
     * @return Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('posts.index', compact('posts'));
    }

    /**
     * Выводит форму для создания нового ресурса
     *
     * @return Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Помещает созданный ресурс в хранилище
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        Post::create($request->all());

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    /**
     * Отображает указанный ресурс.
     *
     * @param \App\Models\Post $post
     * @return Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Выводит форму для редактирования указанного ресурса
     *
     * @param \App\Models\Post $post
     * @return Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Обновляет указанный ресурс в хранилище
     *
     * @param Request $request
     * @param \App\Models\Post $post
     * @return Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $post->update($request->all());

        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    /**
     * Удаляет указанный ресурс из хранилища
     *
     * @param \App\Models\Post $post
     * @return Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'post deleted successfully');
    }
}
