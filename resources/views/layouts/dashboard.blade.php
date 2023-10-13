@extends('layouts.app')

@section('titulo')
    Usuario: {{ $user->username }}
@endsection

@section('contenido')
    <div class="flex justify-center">
        <div class="w-8/12 lg:w-6/12 md:flex">
            <div class="md:w-8/12 lg:w-6/12 px-2 bg-gray-200 rounded-full py-3 items-center md:mr-10">
                <img src="{{ asset('https://res.cloudinary.com/dguhnftxe/image/upload/v1691999830/devstagram/cutbot_nzqzhl.png') }}"
                    alt="user_image_profile" class="rounded-full" />
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 items-center md:items-start flex flex-col justify-center py-10 md:ml-10">
                <div class="flex items-center mb-4 gap-3">
                    <p class="text-gray-700 text-2xl">{{ $user->username }}</p>
                    @auth
                    @if ($user->id === auth()->user()->id)
                    <a href="{{route('perfil.index')}}" class="mt-2 text-gray-500 hover:text-gray-700 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                        </svg>                              
                    </a>
                    @endif
                    @endauth
                </div>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal">Seguidores</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal">Siguiendo</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal">Posts</span>
                </p>
            </div>
        </div>
    </div>
    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>

        @if($posts->count())
        <div class="grid ml-10 grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            @foreach ($posts as $post)
                <div>
                    <a href="{{route ('posts.show', ['post'=>$post, 'user'=>$user])}}">
                        <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}" />
                    </a>
                </div>
            @endforeach
        </div>
        <div class="ml-10" >
            {{$posts->links('pagination::tailwind')}}
        </div>
        @else
        <p class="text-gray-600 text-sm text-center font-bold">No hay publicaciones</p>
        @endif
    </section>
@endsection
