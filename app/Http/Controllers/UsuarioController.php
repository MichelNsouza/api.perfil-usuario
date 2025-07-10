<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UsuarioService;
use Cloudinary\Cloudinary;

class UsuarioController extends Controller
{
    public function __construct(protected UsuarioService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json($this->service->listarTodos());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome_completo' => 'required|string|max:255',
            'idade' => 'required|integer|min:0',
            'rua' => 'required|string|max:255',
            'bairro' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'biografia' => 'nullable|string',
        ]);

        return response()->json($this->service->criar($dados), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return response()->json([$this->service->buscarPorId($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nome_completo' => 'sometimes|required|string|max:255',
            'idade' => 'sometimes|required|integer|min:0',
            'rua' => 'sometimes|required|string|max:255',
            'bairro' => 'sometimes|required|string|max:255',
            'estado' => 'sometimes|required|string|max:255',
            'biografia' => 'nullable|string',
        ]);

        return response()->json($this->service->atualizar($id, $validatedData));
    }

    //versão com cloudinary
    // public function atualizarFoto(Request $request, $id)
    // {
    //     $request->validate([
    //         'foto_perfil' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);

    //     $cloudinary = new Cloudinary();
    //     $uploadedFileUrl = $cloudinary->uploadApi()->upload(
    //         $request->file('foto_perfil')->getRealPath()
    //     );

    //     return response()->json(
    //         $this->service->atualizar($id, ['foto_perfil' => $uploadedFileUrl['secure_url']])
    //     );
    // }

    //versão local
    public function atualizarFoto(Request $request, $id)
    {
        $request->validate([
            'foto_perfil' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = $request->file('foto_perfil')->store('fotos_perfil', 'public');

        $url = asset('storage/' . $path);

        return response()->json(
            $this->service->atualizar($id, ['foto_perfil' => $url])
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return response()->json($this->service->deletar($id), 204);
    }
}
