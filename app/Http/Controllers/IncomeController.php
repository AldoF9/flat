<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Product;
use App\Models\Provider;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

class IncomeController extends Controller
{
    public function indexContent(Request $request)
    {

        $query = Income::query()->with(['provider', 'product','user'])->orderBy('id', 'DESC');

        $data = $query
            ->get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function upsert(Request $request, $idIncome)
    {
        try {
            DB::beginTransaction();
            $income = Income::findOrNew($idIncome);
            $income->fill($request->all());
            $income->saveOrFail();
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

    public function getProvider()
    {
        $query = Provider::query();

        $data = $query
            ->get();
        return response()->json([
            'data' => $data
        ]);
    }

    public function getUser()
    {
        $query = User::query();

        $data = $query
            ->get();
        return response()->json([
            'data' => $data
        ]);
    }
}
