<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\ItemVenda;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendaController extends Controller
{
    public function index()
    {
        return Venda::with(['cliente', 'itens.produto'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'itens' => 'required|array|min:1',
            'itens.*.produto_id' => 'required|exists:produtos,id',
            'itens.*.quantidade' => 'required|integer|min:1',
        ]);

        return DB::transaction(function () use ($request) {
            $total = 0;

            $venda = Venda::create([
                'cliente_id' => $request->cliente_id,
                'total' => 0
            ]);

            foreach ($request->itens as $item) {
                $produto = Produto::findOrFail($item['produto_id']);
                $subtotal = $produto->valor * $item['quantidade'];
                $total += $subtotal;

                ItemVenda::create([
                    'venda_id' => $venda->id,
                    'produto_id' => $produto->id,
                    'quantidade' => $item['quantidade'],
                    'valor_unitario' => $produto->valor
                ]);
            }

            $venda->update(['total' => $total]);

            return response()->json([
                'mensagem' => 'Venda registrada com sucesso!',
                'venda' => $venda->load('cliente', 'itens.produto')
            ], 201);
        });
    }

    public function show($id)
    {
        return Venda::with(['cliente', 'itens.produto'])->findOrFail($id);
    }
}
