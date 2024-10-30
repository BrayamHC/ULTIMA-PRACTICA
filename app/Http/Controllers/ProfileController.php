<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Imagick;

class ProfileController extends Controller
{
    // Muestra la vista principal del perfil
    public function show()
    {
        return view('profile');
    }

    // Busca un usuario por el nombre proporcionado y redirige a su perfil si es encontrado
    public function search(Request $request)
    {
        $query = $request->input('search'); // Obtiene el término de búsqueda

    // Busca el usuario por nombre utilizando LIKE para permitir coincidencias parciales
        $user = User::where('nombre', 'LIKE', '%' . $query . '%')->first();
        if (!$user) {
            // Si no se encuentra el usuario, regresa a la misma página con un mensaje de error
            return redirect()->back()->with('error', 'Usuario no encontrado.');
        }

        // Redirige a la vista de detalles del usuario
        return redirect()->route('profile.showDetail', ['id' => $user->id]);
    }

    // Muestra los detalles del usuario especificado por su nombre
    public function showDetail($nombre)
    {
        $user = User::findOrFail($nombre); // Encuentra el usuario o lanza una excepción
        return view('profile_detail', compact('user')); // Retorna la vista de detalles con los datos del usuario
    }

    // Actualiza la imagen de perfil del usuario
    public function update(Request $request, $id)
    {
        // Valida que la imagen sea opcional, de tipo jpeg/png, y menor de 3 MB
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png',
        ]);

        $user = User::findOrFail($id); // Obtiene el usuario o lanza una excepción

        // Si hay una imagen en la solicitud
        if ($request->hasFile('image')) {
            $file = $request->file('image'); // Obtiene el archivo de imagen

            // Verifica que el archivo sea válido
            if (!$file->isValid()) {
                return redirect()->route('profile.showDetail', ['id' => $user->id])
                                 ->with('error', 'La imagen no es válida.');
            }

            // Genera un nombre único para la imagen y la guarda en 'public/uploads'
            $imageName = uniqid() . '.' . $file->extension();
            $path = $file->storeAs('public/uploads', $imageName);

            if ($path === false) {
                // Error al guardar la imagen
                return redirect()->route('profile.showDetail', ['id' => $user->id])
                                 ->with('error', 'Error al guardar la imagen.');
            }

            try {
                $imagick = new Imagick(storage_path('app/' . $path)); // Carga la imagen con Imagick
                $width = $imagick->getImageWidth(); // Obtiene el ancho de la imagen

                // Redimensiona solo si la imagen es mayor de 1200 píxeles de ancho
                if ($width > 1200) {
                    $imagick->thumbnailImage(1200, 0); // Redimensiona la imagen
                }

                $imagick->writeImage(storage_path('app/' . $path)); // Guarda la imagen redimensionada
                $imagick->clear();
                $imagick->destroy();
            } catch (\Exception $e) {
                // Maneja errores en el procesamiento de la imagen
                return redirect()->route('profile.showDetail', ['id' => $user->id])
                                 ->with('error', 'Error al procesar la imagen: ' . $e->getMessage());
            }

            // Asigna la ruta de la imagen al usuario y crea miniaturas
            $user->url_imagen = 'uploads/' . $imageName;
            $this->createThumbnails($imageName);

            // Guarda el usuario en la base de datos
            if (!$user->save()) {
                return redirect()->route('profile.showDetail', ['id' => $user->id])
                                 ->with('error', 'Error al guardar la ruta de la imagen en la base de datos.');
            }
        }

        // Redirige con un mensaje de éxito
        return redirect()->route('profile.showDetail', ['id' => $user->id])
                         ->with('success', 'Imagen actualizada correctamente.');
    }

    // Crea miniaturas de la imagen en tamaños específicos
    private function createThumbnails($imageName)
    {
        $sizes = [
            ['width' => 100, 'height' => 100],
            ['width' => 300, 'height' => 200],
            ['width' => 400, 'height' => 400],
        ];

        // Recorre cada tamaño y crea una miniatura
        foreach ($sizes as $size) {
            $this->cropImage($imageName, $size['width'], $size['height']);
        }
    }

    // Realiza un recorte en lugar de un redimensionado para las miniaturas
    private function cropImage($imageName, $width, $height)
    {
        try {
            $imagick = new Imagick(storage_path('app/public/uploads/' . $imageName)); // Carga la imagen original
            $imagick->cropThumbnailImage($width, $height); // Recorta la imagen al tamaño especificado
            $thumbnailName = str_replace('.', "_{$width}x{$height}.", $imageName); // Nombre para la miniatura
            $imagick->writeImage(storage_path('app/public/uploads/' . $thumbnailName)); // Guarda la miniatura
            $imagick->clear();
            $imagick->destroy();
        } catch (\Exception $e) {
            // Maneja errores en el procesamiento de la miniatura
        }
    }
}
