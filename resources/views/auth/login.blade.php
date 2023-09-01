@extends ("layouts.app")

@section('titulo')
    <div class="mx-5">
        Inicia sesión en Devstagram
    </div>
@endsection

@section('contenido')
    <div class="md:flex justify-center md:justify-around items-center">
        <div class="md:ml-20 flex justify-center items-center  mb-10">
            <img src="{{ asset('https://res.cloudinary.com/dguhnftxe/image/upload/v1691999830/devstagram/cutbot_nzqzhl.png') }}"
                class=" rounded-full max-w-xs" alt="Login users image">
        </div>
        <div class="md:mr-20 bg-white p-6 rounded-lg shadow-xl mb-10">
            <form action="{{ route('login') }}" method="POST" novalidate>
                @csrf


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

                <div class="mb-5">
                    <input type="checkbox" name="remember"><label class=" text-gray-500 text-sm"> Mantener mi sesión abierta</label>
                </div>
                @if (session('mensaje'))
                    <p class="text-red-600 pb-4">* {{ session('mensaje') }}</p>
                @endif
                <input type="submit" value="Iniciar sesión"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg mb-2" />
            </form>
        </div>
    </div>
@endsection
