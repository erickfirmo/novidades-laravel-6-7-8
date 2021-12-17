<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->post->orderBy('id', 'desc')->paginate(30);

        return view('posts.index', compact('posts'));
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
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        try {
            // Pegando dados da requisição
            $data = $request->all();

            // Criando post usando Active Record
            // $post = $this->post;
            // $post->title = $data['title'];
            // $post->description = $data['description'];
            // $post->save();

            // Criando post usando Mass Assignment
            $this->post->create($data);

            flash('Post criado com sucesso!')->success();
            return redirect()->route('posts.index');

        } catch (\Exception $e) {
            if(env('APP_DEBUG'))
            {
                flash($e->getMessage())->warning();
                return redirect()->back();
            }
            flash('Ocorreu um erro ao criar postagem!')->warning();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $post = $this->post->findOrFail($id);
        } catch (\Exception $e) {
            if(env('APP_DEBUG')) {
                flash($e->getMessage())->warning();
                return redirect()->back();
            }
            flash('Postagem não encontrada!')->warning();
            return redirect()->back();
        }

        return view('posts.edit', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect()->route('posts.show', ['post' => $id]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        try {
            $data = $request->all();
            $post = $this->post->findOrFail($id);
            $post->update($data);

            flash('Post atualizado com sucesso!')->success();

            return redirect()->route('posts.show', ['post' => $post->id]);
        } catch (\Exception $e) {
            if(env('APP_DEBUG')) {
                flash($e->getMessage())->warning();
                return redirect()->back();
            }
            flash('Ocorreu um erro ao atualizar a postagem!')->warning();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $post = $this->post->findOrFail($id);
            $post->delete();
        } catch (\Exception $e) {
            if(env('APP_DEBUG')) {
                flash($e->getMessage())->warning();
                return redirect()->back();
            }
            flash('Ocorreu um erro ao deletar postagem!')->warning();
            return redirect()->back();
        }
    }
}
