<?php

namespace App\Services;

use App\Models\Usuario;

class UsuarioService
{
    public function listarTodos()
    {
        return Usuario::all();
    }

    public function buscarPorId($id): ?Usuario
    {
        return Usuario::findOrFail($id);
    }

    public function criar($dados): Usuario
    {
        return Usuario::create($dados);
    }

    public function atualizar($id, $dados): Usuario
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->update($dados);
        return $usuario->fresh();
    }

    public function deletar($id): bool
    {
        $usuario = Usuario::findOrFail($id);
        return $usuario->delete();
    }
}
