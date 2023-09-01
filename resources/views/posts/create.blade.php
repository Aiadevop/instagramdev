@extends('layouts.app')



@section('titulo')
    Crea un nuevo post.
@endsection

{{-- Este push carga los estilos que hemos puesto en stack exclusivamente donde lo coloquemos --}}
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('contenido')
    <div class="flex flex-col md:flex-row justify-between items-center gap-10 mt-10 ml-12 md:mx-10">
        <div class="w-full md:w-1/2">
            <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data" id="dropzone"
                class="dropzone border-dashed border-2 w-full h-80 rounded-lg shadow-xl flex flex-col justify-center items-center">
                @csrf
            </form>
        </div>
        <div class="w-full m-5 md:m-0 md:w-6/12 bg-white p-6 rounded-lg shadow-xl h-80">
            <form action="{{ route('posts.store') }}" method="POST" novalidate>
                @csrf
                <div class="mb-2">
                    <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">Título</label>
                    <input id="titulo" name="titulo" type="text" placeholder="Título de la publicación"
                        class="border p-3 w-full rounded-lg mb-2 
                        @error('titulo') border-red-600 bg-red-50 @enderror"
                        value="{{ old('titulo') }}" />
                    @error('titulo')
                        <p class="text-red-600">* {{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">Descripción</label>
                    <textarea id="descripcion" name="descripcion" type="text" placeholder="Descripción de la publicación"
                        class="border p-3 w-full rounded-lg mb-2 
                        @error('descripcion') border-red-600 bg-red-50 @enderror">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <p class="text-red-600">* {{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <input name="imagen" type="hidden" value="{{old('imagen')}}"/>
                    @error('imagen')
                        <p class="text-red-600">* {{ $message }}</p>
                    @enderror
                </div>
                <input type="submit" value="Crear Post"
                    class="bg-gray-600 hover:bg-gray-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg mb-2" />

            </form>
        </div>

    </div>
@endsection
