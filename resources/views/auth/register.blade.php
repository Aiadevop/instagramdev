@extends ("layouts.app")

@section('titulo')
    <div class="mx-5">
        Registrate en Devstagram
    </div>
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="m-10 md:w-6/12 flex items-center ">
            <img src="{{ asset('img/vsc2.png') }}" alt="Imagen registro de usuarios" class="rounded-full">
        </div>
        <div class="m-5 md:m-0 md:w-6/12 bg-white p-6 rounded-lg shadow-xl">
            <form action="{{ route('register') }}" method="POST" novalidate>
                @csrf
                <div class="mb-2">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">Nombre</label>
                    <input id="name" name="name" type="text" placeholder="Tu nombre"
                        class="border p-3 w-full rounded-lg mb-2 
                        @error('name') border-red-600 bg-red-50 @enderror"
                        value="{{ old('name') }}" />
                    @error('name')
                        <p class="text-red-600">* {{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                    <input id="username" name="username" type="text" placeholder="Tu nombre de usuario"
                        class="border p-3 w-full rounded-lg mb-2
                        @error('username') border-red-600 bg-red-50 @enderror"
                        value="{{ old('username') }}" />
                    @error('username')
                        <p class="text-red-600">* {{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input id="email" name="email" type="email" placeholder="Tu email"
                        class="border p-3 w-full rounded-lg mb-2    @error('email') border-red-600 bg-red-50 @enderror"
                        value="{{ old('email') }}" />
                    @error('email')
                        <p class="text-red-600">* {{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password</label>
                    <input id="password" name="password" type="password" placeholder="Tu password"
                        class="border p-3 w-full rounded-lg mb-2  @error('password') border-red-600 bg-red-50 @enderror"
                        value="{{ old('password') }}" />
                    @error('password')
                        <p class="text-red-600">* {{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Repetir
                        password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                        placeholder="Repite tu password"
                        class="border p-3 w-full rounded-lg mb-2 @error('password_confirmation') border-red-600 bg-red-50 @enderror"
                        value="{{ old('password_confirmation') }}" />
                    @error('password-confirmation')
                        <p class="text-red-600">* {{ $message }}</p>
                    @enderror
                </div>
                <input type="submit" value="Crear Cuenta"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg mb-2" />
            </form>
        </div>
    </div>
@endsection
