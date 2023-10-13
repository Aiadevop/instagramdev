@extends('layouts.app')

@section('titulo')
    <div>Editar perfil: {{ auth()->user()->username }}</div>
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form method="POST" action="{{route('perfil.store')}}" enctype="multipart/form-data" class="mt-10 md:mt-0">
                @csrf
                <div class="mb-2">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                    <input id="username" name="username" type="text" placeholder="Tu nombre de usuario"
                        class="border p-3 w-full rounded-lg mb-2
                        @error('username') border-red-600 bg-red-50 @enderror"
                        value="{{ auth()->user()->username }}" />
                    @error('username')
                        <p class="text-red-600">* {{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">Imagen perfil</label>
                    <input id="imagen" name="imagen" type="file" placeholder="Tu imagen de usuario"
                        class="border p-3 w-full rounded-lg mb-2"
                        value=""
                        accept=".jpg, .jpeg, .png" />
                    @error('imagen')
                        <p class="text-red-600">* {{ $message }}</p>
                    @enderror
                </div>
                <input type="submit" value="Guardar cambios"
                class="bg-gray-600 hover:bg-gray-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg mb-2" />
            </form>

        </div>
    </div>
@endsection
