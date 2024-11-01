<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Imagick;

class ProfileController extends Controller
{
    // Muestra la vista principal del perfil
    public function show()
    {
        return view('profile'); // Retorna la vista del perfil del usuario
    }
    
    // GENERADOR DE HASH DE ID
    public function idhash($id)
    {
        // Obtiene la variable de entorno URL_SALT del archivo .env
        $urlSalt = env('URL_SALT');
    
        try {
            // Obtiene al usuario de la base de datos por su id o lanza una excepción si no lo encuentra
            $user = User::findOrFail($id);
    
            // Genera un hash único combinando el URL_SALT y el id del usuario
            $hash = substr(hash('sha256', $urlSalt . $id), 0, 8);
    
            // Recupera el hash de la URL para compararlo
            $urlHash = request()->query('idsello');
    
            // Registra el valor de URL_SALT y los hashes generados para depuración
            \Log::info('URL_SALT: ' . $urlSalt);
            \Log::info('Hash generado: ' . $hash);
            \Log::info('Hash de la URL: ' . $urlHash);
    
            // Verifica si el hash de la URL existe
            if (is_null($urlHash)) {
                // Loguea el error y redirige al usuario con un mensaje
                \Log::error('El parámetro idsello no fue pasado en la URL.');
                return redirect()->route('profile.idhash')->with('error', 'Acceso no autorizado: falta el parámetro idsello.');
            }
    
            // Compara el hash generado con el hash de la URL
            if (!hash_equals($hash, $urlHash)) {
                // Loguea el error si no coinciden y redirige con mensaje de error
                \Log::error('Hash de URL no coincide con el hash generado.');
                return redirect()->route('profile.idhash')->with('error', 'Acceso no autorizado: No manipule la URL.');
            }
    
            // Retorna la vista de detalle del perfil, pasando el usuario y el hash
            return view('profile_detail', [
                'user' => $user,
                'hash' => $hash
            ]);
        } catch (\Exception $e) {
            // Loguea cualquier error y redirige al usuario con un mensaje genérico
            \Log::error('Error en showDetail: ' . $e->getMessage());
            return redirect()->route('profile.show')->with('error', 'Se produjo un error al acceder al perfil.');
        }
    }

       // Muestra los detalles del usuario especificado por su ID
       public function showDetail($id)
       {
           $user = User::findOrFail($id); // Encuentra el usuario o lanza una excepción
           return view('profile_detail', compact('user')); // Retorna la vista de detalles con los datos del usuario
       }

    
    // Busca un usuario por nombre y redirige a su perfil si lo encuentra
    public function search(Request $request)
    {
        // Obtiene el término de búsqueda ingresado en el formulario
        $query = $request->input('search');
    
        // Busca usuarios cuyo nombre contenga el término de búsqueda (LIKE permite coincidencias parciales)
        $usuarios = User::where('nombre', 'LIKE', '%' . $query . '%')->get();
    
        if ($usuarios->isEmpty()) {
            // Si no se encuentran usuarios, redirige de vuelta con mensaje de error
            return redirect()->back()->with('error', 'Usuario no encontrado.');
        }
    
        // Retorna una vista de usuarios con los resultados encontrados
        return view('usuarios', ['usuarios' => $usuarios]);
    }
    
    // Actualiza la imagen de perfil del usuario
    public function update(Request $request, $id)
    {
        // Valida que la imagen sea opcional, de tipo jpeg o png y limite el tamaño a 3MB
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png', // Validación de la imagen
        ]);

        // Busca al usuario en la base de datos o lanza una excepción si no existe
        $user = User::findOrFail($id);

        // Si se ha subido una imagen en la solicitud
        if ($request->hasFile('image')) {
            $file = $request->file('image'); // Obtiene el archivo de imagen

            // Verifica que el archivo es válido
            if (!$file->isValid()) {
                // Redirige con un mensaje si el archivo no es válido
                return redirect()->route('profile.showDetail', ['id' => $user->id])
                                 ->with('error', 'La imagen no es válida.');
            }

            // Genera un nombre único para la imagen y la guarda en 'public/uploads'
            $imageName = uniqid() . '.' . $file->extension();
            $path = $file->storeAs('public/uploads', $imageName);

            if ($path === false) {
                // Redirige si hubo un error al guardar la imagen
                return redirect()->route('profile.showDetail', ['id' => $user->id])
                                 ->with('error', 'Error al guardar la imagen.');
            }

            try {
                // Carga la imagen con la biblioteca Imagick para manipulación
                $imagick = new Imagick(storage_path('app/' . $path));
                $width = $imagick->getImageWidth(); // Obtiene el ancho de la imagen

                // Redimensiona solo si el ancho es mayor a 1200 píxeles
                if ($width > 1200) {
                    $imagick->thumbnailImage(1200, 0);
                }

                $imagick->writeImage(storage_path('app/' . $path)); // Guarda la imagen redimensionada
                $imagick->clear();
                $imagick->destroy();
            } catch (\Exception $e) {
                // Loguea el error de procesamiento y redirige con mensaje de error
                return redirect()->route('profile.showDetail', ['id' => $user->id])
                                 ->with('error', 'Error al procesar la imagen: ' . $e->getMessage());
            }

            // Asigna la ruta de la imagen al usuario y llama a la creación de miniaturas
            $user->url_imagen = 'uploads/' . $imageName;
            $this->createThumbnails($imageName);

            // Guarda el usuario en la base de datos con la ruta de la imagen
            if (!$user->save()) {
                return redirect()->route('profile.showDetail', ['id' => $user->id])
                                 ->with('error', 'Error al guardar la ruta de la imagen en la base de datos.');
            }
        }

        // Redirige con un mensaje de éxito si se actualizó correctamente
        return redirect()->route('profile.showDetail', ['id' => $user->id])
                         ->with('success', 'Imagen actualizada correctamente.');
    }

    // Crea miniaturas en tamaños específicos para la imagen subida
    private function createThumbnails($imageName)
    {
        // Define los tamaños para las miniaturas
        $sizes = [
            ['width' => 100, 'height' => 100],
            ['width' => 300, 'height' => 200],
            ['width' => 400, 'height' => 400],
        ];

        // Recorre cada tamaño y llama al método de recorte de imagen
        foreach ($sizes as $size) {
            $this->cropImage($imageName, $size['width'], $size['height']);
        }
    }

    // Recorta la imagen a un tamaño específico para cada miniatura
    private function cropImage($imageName, $width, $height)
    {
        try {
            // Carga la imagen original con Imagick
            $imagick = new Imagick(storage_path('app/public/uploads/' . $imageName));
            $imagick->cropThumbnailImage($width, $height); // Recorta la imagen al tamaño especificado
            $thumbnailName = str_replace('.', "_{$width}x{$height}.", $imageName); // Genera el nombre de la miniatura
            $imagick->writeImage(storage_path('app/public/uploads/' . $thumbnailName)); // Guarda la miniatura
            $imagick->clear();
            $imagick->destroy();
        } catch (\Exception $e) {
            // No muestra el error al usuario pero puede loguearlo para depuración
            \Log::error('Error al crear la miniatura: ' . $e->getMessage());
        }
    }
}
