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
                <p class="text-gray-700 text-2xl mb-4">{{ $user->username }}</p>
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
