<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
{
    return Produto::with('marca')->get();
}

    public function store(Request $request)
    {
        $request->validate([
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
            'marca_id' => 'required|exists:marcas,id',
        ]);

        return Produto::create($request->all());
    }

    public function show($id)
    {
        return Produto::with('marca')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);

        $request->validate([
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
            'marca_id' => 'required|exists:marcas,id',
        ]);

        $produto->update($request->all());

        return $produto;
    }

    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();

        return response()->json(['mensagem' => 'Produto deletado com sucesso']);
    }
}
