<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \Exception;

use App\User;
use App\Book;
use App\Room;

class BookMaster extends Controller
{
    public $user_sementara;

    public function __construct()
    {
        $this->user_sementara = User::find(1);
    }

    private function rand_str($len)
    {
        $res = "";
        $huruf = "1234567890qwertyuiopasdfghjklzxcvbnm";
        for($a = 0; $a < $len; $a++) {
            $res.=$huruf[rand(0, strlen($huruf)-1)];
        }
        return $res;
    }

    public function book(Request $req)
    {
        $request = Validator::make($req->all(), [
            'date' => 'required',
            'room_id' => 'required|exists:rooms,id'
        ]);

        if($request->fails()) {
            return response()->json([
                'message' => 'error',
                'errors' => $request->errors()
            ], 400);
        }

        try {
            $room = Room::find($req->room_id);

            if($room->status != "empty") {
                throw new \Exception("Room is not empty");
            }

            $room->status = "booked";
            $room->save();

            $this->user_sementara->books()->create([
                'booking_date' => $req->date,
                'room_id' => $req->room_id,
                'book_code' => time().$this->rand_str(3),
                'status' => 'pending'
            ]);
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

    public function book_find(Request $req)
    {
        $request = Validator::make($req->all(), [
            'id' => 'required|exists:books,id'
        ]);

        if($request->fails()) {
            return response()->json([
                'message' => 'error',
                'errors' => $request->errors()
            ], 400);
        }

        $book = Book::find($req->id);
        $book->user;
        $book->room;
        return response()->json($book);
    }

    public function books()
    {
        $books = Book::orderBy('booking_date')->paginate(10);

        foreach($books as $book) {
            $book->user;
            $book->room;
        }

        return response()->json($books);
    }

    public function getByStatus($status)
    {
        try {
            if(!($status == "success" || $status == "failed" || $status == "pending"))  {
                throw new \Exception("status is not valid");
            }
            $books = Book::where('status', $status)->paginate(10);

            foreach($books as $book) {
                $book->user;
                $book->room;
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'failed',
                'error' => $e->getMessage()
            ], 500);
        }

        return response()->json($books);
    }

    public function del_book(Request $req)
    {
        $request = Validator::make($req->all(), [
            'id' => 'required|exists:books,id'
        ]);

        if($request->fails()) {
            return response()->json([
                'message' => 'error',
                'errors' => $request->errors()
            ], 400);
        }

        try {
            $book = Book::find($req->id);

            if($book->status == 'failed' || $book->status == 'success' ) {
                throw new \Exception("status tidak valid");
            }

            $book->status = "failed";
            $book->save();
            $book->room()->update([
                'status' => 'empty'
            ]);
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
