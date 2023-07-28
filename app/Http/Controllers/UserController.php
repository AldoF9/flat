<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    public function indexContent(Request $request)
    {

        $query = User::query()->orderBy('id', 'DESC');

        $data = $query
            ->get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function upsert(Request $request, $idUser)
    {
        try {
            DB::beginTransaction();
            $user = User::findOrNew($idUser);
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
