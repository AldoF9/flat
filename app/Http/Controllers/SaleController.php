<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use App\Models\Sale;
use App\Models\State;
use Illuminate\Http\Request;
use DB;

class SaleController extends Controller
{
    public function indexContent(Request $request)
    {

        $query = Sale::query()->with(['client', 'product'])->orderBy('id', 'DESC');

        $data = $query
            ->get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function upsert(Request $request, $idSale)
    {
        try {
            DB::beginTransaction();
            $sale = Sale::findOrNew($idSale);
            $sale->fill($request->all());
            $sale->saveOrFail();
            DB::commit();
            return response()->json([
                'success' => true,
            ]);
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Error',
                'error' => $ex->getMessage(),
                'trace' => $ex->getTrace(),
                'file' => $ex->getFile(),
                'line' => $ex->getLine(),
            ]);
        }
    }

    public function getProduct()
    {
        $query = Product::query();

        $data = $query
            ->get();
        return response()->json([
            'data' => $data
        ]);
    }

    public function getClient()
    {
        $query = Client::query();

        $data = $query
            ->get();
        return response()->json([
            'data' => $data
        ]);
    }

    public function getState()
    {
        $query = State::query();

        $data = $query
            ->get();
        return response()->json([
            'data' => $data
        ]);
    }
}
