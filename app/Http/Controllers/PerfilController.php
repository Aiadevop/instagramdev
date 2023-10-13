<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        $request->request->add(['name' => $request->name]);
        $request->request->add(['email' => $request->email]);


        //El not_in hace que no se pueda acceder a esos usuarios, si lo haces con in: solo permite elegir los de la lista
        $this->validate($request, [
            'username' => ['required', 'min:3', 'unique:users,username,' . auth()->user()->id, 'max:20', 'not_in:twitter,editar-perfil'],
            'name' => 'required | max:30',
            'email' => ['required', 'unique:users,email,' . auth()->user()->id, 'max:60'],


        ]);
        $usuario = User::find(auth()->user()->id);

        // Verificar el Password Antiguo solo si se proporciona
        if (!empty($request->password)) {
            if (!Hash::check($request->password, $usuario->password)) {
                return redirect()->back()->withErrors(['password' => 'La contraseña antigua es incorrecta']);
            }
        }
    
        // ... Resto del código ...
    
        // Actualizar la contraseña solo si se proporciona un Nuevo Password
        if (!empty($request->newpassword)) {
            $usuario->password = Hash::make($request->newpassword);
        }
        if ($request->imagen) {
            // Asi enviamos el token
            $imagen = $request->file('imagen');
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
        $usuario->username = $request->username;
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        // Actualizar la contraseña solo si se proporciona un Nuevo Password
        if (!empty($request->newpassword)) {
            $usuario->password = Hash::make($request->newpassword);
        }
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? '';
        $usuario->save();

        //Redireccionar usuario
        return redirect()->route('posts.index', $usuario->username);
    }
}
