<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use DB;

class ClientController extends Controller
{
    public function indexContent(Request $request)
    {

        $query = Client::query()->orderBy('id', 'DESC');

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
            $user = Client::findOrNew($idUser);
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
