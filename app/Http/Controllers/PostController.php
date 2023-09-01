<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show','index']);
    }

    public function index(User $user)
    {
        //Si queremos que nos devuelva el usuario por pantalla.
        // dd(auth()->user());   
     
        // $posts = Post::where('user_id', $user->id)->get();
        $posts = Post::where('user_id', $user->id)->paginate(8);

        return view('layouts.dashboard', [
            'user' => $user,
            'posts'=> $posts
        ]);
    }

    public function create()
    {
        // dd('Creando post');
        return view('posts.create');
    }

    public function store(Request $request)
    {
        // dd('Creando publicación');

        //Validación
        $this->validate($request, [
            'titulo' => 'required | max:30',
            'descripcion' => ['required', 'min:3', 'max:200'],
            'imagen' => 'required',
        ]);

        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id,
        ]);

        //Otra forma de hacerlo
        // $post = new Post;
        // $post->titulo = $request->titulo;
        // $post->descripcion = $request->descripcion;
        // $post->imagen = $request->imagen;
        // $post->user_id = auth()->user()->id;
        // $post->save();

        //Otra forma de hacerlo
        // $request->user()->posts()->create(
        //     [
        //         'titulo' => $request->titulo,
        //         'descripcion' => $request->descripcion,
        //         'imagen' => $request->imagen,
        //         'user_id' => auth()->user()->id
        //     ]
        // );

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        //Eliminar la imagen
        $imagen_path= public_path('uploads/'. $post->imagen);

        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
