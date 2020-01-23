<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Admin;
use App\Book;
use App\Transaction;

class TransactionMaster extends Controller
{
    private $admin;

    public function __construct()
    {
        $this->admin = Admin::find(1);
    }

    public function check_in(Request $req)
    {
        $request = Validator::make($req->all(), [
            'book_id' => 'required|exists:books,id',
            'check_in' => 'required',
            'check_out' => 'required',
        ]);

        if($request->fails()) {
            return response()->json([
                'message' => 'error',
                'errors' => $request->errors()
            ], 400);
        }

        try {
            $book = Book::find($req->book_id);

            if($book->status != 'pending') {
                throw new \Exception("book is not available");
            }

            if($book->room->status == 'filled') {
                throw new \Exception("room is not available");
            }

            $book->status = 'success';
            $book->save();

            $book->room->update([
                'status' => 'filled'
            ]);

            $this->admin->transaction()->create([
                'book_id' => $req->book_id,
                'check_in' => $req->check_in,
                'check_out' => $req->check_out,
                'status' => 'in'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'failed',
                'error' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'message' => 'success'
        ],200);
    }

    public function check_out(Request $req)
    {
        $request = Validator::make($req->all(), [
            'book_id' => 'required|exists:books,id',
            'check_out' => 'required'
        ]);

        if($request->fails()) {
            return response()->json([
                'message' => 'error',
                'errors' => $request->errors()
            ], 400);
        }

        try {
            $book = Book::find($req->book_id);
            $book->room()->update([
                'status' => 'empty'
            ]);
            $book->transaction()->update([
                'status' => 'out'
            ]);
        } catch (\Exception $e) {
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
