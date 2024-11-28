<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class GuestsController extends Controller
{
    private $user_id;

    // Constructor untuk menginisialisasi properti
    public function __construct()
    {
        $this->user_id = Auth::user()->id;
    }

    public function index()
    {
        $id = $this->user_id;
        $data = Guest::where('user_id', $id)->get();

        return view('admin.guests.index', compact('data'));
    }

    public function add()
    {
        $id = $this->user_id;
        return view('admin.guests.create');
    }

    public function data()
    {
        $data = Guest::where('user_id', $this->user_id)->get();
        return DataTables::of($data)
            ->make(true);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = Auth::user()->id;
            $items = [];
            foreach ($request->preposition as $index => $preposition) {
                $items[] = [
                    'user_id' => $id,
                    'preposition' => $preposition,
                    'name' => $request->name[$index],
                    'event' => $request->event[$index],
                    'phone' => $request->phone[$index],
                ];
            }

            Guest::insert($items);
            DB::commit();
            return response()->json([
                'message' => 'Berhasil'
            ]);
        } catch (Throwable $th) {
            DB::rollBack();
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
