<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller
{
    public function indexContent(Request $request)
    {

        $query = Category::query()->orderBy('id', 'DESC');

        $data = $query
            ->get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function upsert(Request $request, $idCategory)
    {
        try {
            DB::beginTransaction();
            $user = Category::findOrNew($idCategory);
            $user->fill($request->all());
            $user->saveOrFail();
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
}
