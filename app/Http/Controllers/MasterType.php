<?php

namespace App\Http\Controllers;

use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MasterType extends Controller
{
    public function post_images(Request $req)
    {
        $request = Validator::make($req->all(), [
            'image' => 'required|mimes:png,jpg,gif,jpeg',
            'type_id' => 'required|exists:types,id'
        ]);

        if($request->fails()) {
            return response()->json([
                'message' => 'error',
                'errors' => $request->errors()
            ], 400);
        }
    }

    public function create(Request $req)
    {
        $request = Validator::make($req->all(), [
            'type' => 'unique:types,type|required',
            'price' => 'numeric|required'
        ]);

        if($request->fails()) {
            return response()->json([
                'message' => 'error',
                'errors' => $request->errors()
            ], 400);
        }

        try {
            $res = new Type;
            $res->type = $req->type;
            $res->price = $req->price;
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
            'id' => 'exists:types,id',
            'type' => 'required',
            'price' => 'numeric|required'
        ]);

        if($request->fails()) {
            return response()->json([
                'message' => 'error',
                'errors' => $request->errors()
            ], 400);
        }

        try {
            $res = Type::findOrFail($req->id);
            $res->type = $req->type;
            $res->price = $req->price;
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
        return response()->json(
            Type::get()
        , 200);
    }

    public function find(Request $req)
    {
        $request = Validator::make($req->all(), [
            'id' => 'exists:types,id'
        ]);

        if($request->fails()) {
            return response()->json([
                'message' => 'error',
                'errors' => $request->errors()
            ], 400);
        }

        try {
            $res = Type::findOrFail($req->id);
            $res->images;
            $res->rooms;
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
            'id' => 'exists:types,id'
        ]);

        if($request->fails()) {
            return response()->json([
                'message' => 'error',
                'errors' => $request->errors()
            ], 400);
        }

        try {
            $res = Type::findOrFail($req->id);
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
