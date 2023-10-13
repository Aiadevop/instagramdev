<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('perfil.index');
    }
    public function store(Request $request)
    {

        //dd($request);
        //Modifica el Request
        $request->request->add(['username' => Str::slug($request->username)]);

        //El not_in hace que no se pueda acceder a esos usuarios, si lo haces con in: solo permite elegir los de la lista
        $this->validate($request, [
            'username' => ['required', 'min:3', 'unique:users,username,' .auth()->user()->id, 'max:20', 'not_in:twitter,editar-perfil'],
        ]);

        if ($request->imagen) {
            // Asi enviamos el token
            $imagen = $request->file('file');
            // Nombre de imagen único
            $nombreImagen = Str::uuid() . "." . $imagen->extension();
            // Instancia de la imagen con Intervention Image
            $imagenServidor = Image::make($imagen);
            // Podemos usar esa instancia para modificar la imagen. Por ejemplo el tamaño.
            $imagenServidor->fit(500, 500, null, 'center');
            // Movemos la imagen al servidor.
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;

            $imagenServidor->save($imagenPath);
        }

        //Guardar cambios
        $usuario = User::find(auth()->user()->id);
        $usuario-> username = $request->username;
        $usuario-> imagen = $nombreImagen ?? null;
        $usuario-> save();

        //Redireccionar usuario
        return redirect()->route('posts.index', $usuario->username);
    }
}