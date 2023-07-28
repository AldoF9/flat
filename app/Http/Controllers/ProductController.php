<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    public function indexContent(Request $request)
    {

        $query = Product::query()->with(['category'])->orderBy('id', 'DESC');

        $data = $query
            ->get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function upsert(Request $request, $idProduct)
    {
        try {
            DB::beginTransaction();
            $product = Product::findOrNew($idProduct);
            $product->fill($request->all());
            $product->saveOrFail();
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

    public function getCategories()
    {
        $query = Category::query();

        $data = $query
            ->get();
        return response()->json([
            'data' => $data
        ]);
    }
}
