<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UsuarioService;

class UsuarioController extends Controller
{
    public function __construct(protected UsuarioService $service) {}

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
            'foto_perfil' => 'nullable|string', 
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
         $usuarioRequest = $request->validate([
                'nome_completo' => 'sometimes|required|string|max:255',
                'idade' => 'sometimes|required|integer|min:0',
                'rua' => 'sometimes|required|string|max:255',
                'bairro' => 'sometimes|required|string|max:255',
                'estado' => 'sometimes|required|string|max:255',
                'biografia' => 'nullable|string',
                'foto_perfil' => 'nullable|string',
            ]);

            return response()->json([$this->service->atualizar($id, $usuarioRequest)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return response()->json($this->service->deletar($id), 204);
    }
}
