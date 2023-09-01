<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class ImageController extends Controller
{
    public function store(Request $request)
    {
        // return "Desde ImageCotroller";

        // Asi enviamos el token
        $imagen = $request->file('file');
        // Nombre de imagen único
        $nombreImagen = Str::uuid(). "." . $imagen->extension();
        // Instancia de la imagen con Intervention Image
        $imagenServidor = Image::make($imagen);
        // Podemos usar esa instancia para modificar la imagen. Por ejemplo el tamaño.
        $imagenServidor ->fit (500,500, null, 'center');
        // Movemos la imagen al servidor.
        $imagenPath = public_path('uploads'). '/' . $nombreImagen;

        $imagenServidor -> save($imagenPath);


        return response()->json(['imagen'=>$nombreImagen]);

    }
}
