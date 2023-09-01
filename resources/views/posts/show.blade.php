@extends('layouts.app')

@section('titulo')
    Titulo: {{ $post->titulo }}
@endsection

@section('contenido')
    {{-- <div>{{$post}}</div> --}}
    <div
        class="container mx-auto flex flex-col justify-start items-center sm:flex sm:flex-row sm:justify-around sm:items-start">
        <diV class="flex flex-col justify-center items-start mb-10 sm:block sm:ml-0 sm:mb-0 sm:w:1/2">
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}"
                class="max-h-80" />
            <diV class="flex items-center p-2 pt-3">
                @auth
                    @if ($post->checkLike(auth()->user()))
           
                    <form method="POST" action="{{ route('posts.likes.destroy', $post) }}" class="flex items-center">
                        @method('DELETE')
                        @csrf
                        <button type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" class="w-6 h-6">
                                <path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
                              </svg>
                              
                        </button>
                    </form>
                    @else
                        <form method="POST" action="{{ route('posts.likes.store', $post) }}" class="flex items-center">
                            @csrf
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>
                            </button>
                        </form>
                    @endif
                @endauth
           
                <p class="pl-1">{{$post->likes->count()}} likes</p>
            </diV>
            <div>
                <p class="font-bold pl-3">{{ $post->user->username }}</p>
                {{-- El diffforhumans formatea la fecha con una libreria de Laravel (Carbon) --}}
                <p class="text-xs text-gray-500 pl-3">{{ $post->created_at->diffForHumans() }}</p>
                <div class="mt-5 pl-3 rounded-md">{{ $post->descripcion }}</div>
            </div>
            @auth
                @if ($post->user_id === auth()->user()->id)
                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                        {{-- METODO SPOFFING, permite añadir directivas distintas de get y post que son las que admite el navegador. --}}
                        @method('DELETE')
                        @csrf
                        <input type="submit" value="Eliminar publicación"
                            class="bg-red-500 hover:bg-red-600 p-2 rounded text-white text-sm font-bold mt-10 cursor-pointer" />
                    </form>
                @endif
            @endauth
        </diV>
        @auth
            <div class="sm:w-1/2 sm:mt-4">
                <div class="shadow bg-white p-5 mb-5">
                    <p class="text-xl font-bold text-center mb-8">Agrega un comentario</p>
                    @if (session('mensaje'))
                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                            {{ session('mensaje') }}
                        </div>
                    @endif
                    <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user]) }}" method="POST"
                        novalidate>
                        @csrf
                        <div class="mb-2">
                            <label for="comentario" class="mt-3 mb-2 block uppercase text-gray-500 font-bold">Comentario</label>
                            <textarea id="comentario" name="comentario" type="text" placeholder="Agrega un comentario"
                                class="border p-3 w-full rounded-lg mb-2 
                        @error('comentario') border-red-600 bg-red-50 @enderror"></textarea>
                            @error('comentario')
                                <p class="text-red-600">* {{ $message }}</p>
                            @enderror
                        </div>
                        <input type="submit" value="Comentar"
                            class="bg-gray-600 hover:bg-gray-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg mb-2" />

                    </form>
                @endauth
            </div>
            <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll">
                @if ($post->comentarios->count())
                    @foreach ($post->comentarios as $comentario)
                        <div class="p-5 border-gray-300 border-b">
                            <a href="{{ route('posts.index', $comentario->user) }}" class="font-bold">
                                {{ $comentario->user->username }}
                            </a>
                            <p>{{ $comentario->comentario }}</p>
                            <p class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans() }}</p>
                        </div>
                    @endforeach
                @else
                    <p class="p-10 text-center">No hay comentarios</p>
                @endif
            </div>
        </div>
    </div>
@endsection
