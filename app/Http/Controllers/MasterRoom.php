<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class MasterRoom extends Controller
{
    public function create(Request $req)
    {
        $request = Validator::make($req->all(), [
            'type_id' => 'required|exists:types,id',
            'code_ruangan' => 'required|unique:rooms,code_ruangan'
        ]);

        if($request->fails()) {
            return response()->json([
                'message' => 'error',
                'errors' => $request->errors()
            ], 400);
        }

        try {
            $res = new Room;
            $res->type_id = $req->type_id;
            $res->code_ruangan = $req->code_ruangan;
            $res->status = "empty";
            $res->save();
        } catch(\Exception $e) {
            return response()->json([
                'message' => 'failed',
                'error' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'message' => 'success'
        ], 200);
    }

    public function update(Request $req)
    {
        $request = Validator::make($req->all(), [
            'id' => 'required|exists:rooms,id',
            'type_id' => 'required|exists:types,id',
            'code_ruangan' => 'required'
        ]);

        if($request->fails()) {
            return response()->json([
                'message' => 'error',
                'errors' => $request->errors()
            ], 400);
        }

        try {
            $res = Room::find($req->id);
            $res->type_id = $req->type_id;
            $res->code_ruangan = $req->code_ruangan;
            $res->save();
        } catch(\Exception $e) {
            return response()->json([
                'message' => 'failed',
                'error' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'message' => 'success'
        ], 200);
    }

    public function get()
    {
        $res = Room::orderBy('code_ruangan')->orderBy('type_id')->paginate(10);

        foreach($res as $result) {
            $result->type;
        }

        return response()->json(
            $res
        , 200);
    }

    public function getByStatus($status)
    {
        try {
            if(!($status == "empty" || $status == "booked" || $status == "filled"))  {
                throw new \Exception("status is not valid");
            }
            $data = Room::where('status', $status)->paginate(10);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'failed',
                'error' => $e->getMessage()
            ], 500);
        }

        return response()->json($data);
    }

    public function find(Request $req)
    {
        $request = Validator::make($req->all(), [
            'id' => 'exists:rooms,id'
        ]);

        if($request->fails()) {
            return response()->json([
                'message' => 'error',
                'errors' => $request->errors()
            ], 400);
        }

        try {
            $res = Room::findOrFail($req->id);
            $res->type;
        } catch(\Exception $e) {
            return response()->json([
                'message' => 'failed',
                'error' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            $res
        ], 200);
    }

    public function delete(Request $req)
    {
        $request = Validator::make($req->all(), [
            'id' => 'exists:rooms,id'
        ]);

        if($request->fails()) {
            return response()->json([
                'message' => 'error',
                'errors' => $request->errors()
            ], 400);
        }

        try {
            $res = Room::findOrFail($req->id);
            $res->delete();
        } catch(\Exception $e) {
            return response()->json([
                'message' => 'failed',
                'error' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'message' => 'success'
        ], 200);
    }
}
