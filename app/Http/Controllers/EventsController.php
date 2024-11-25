<?php

namespace App\Http\Controllers;

use App\Models\Akad;
use App\Models\Events;
use App\Models\Resepsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class EventsController extends Controller
{
    public static function index()
    {
        $id = Auth::user()->id;
        $akad = Akad::where('user_id', $id)->first();
        $resepsi = Resepsi::where('user_id', $id)->first();

        return view('admin.events.index', compact('akad', 'resepsi'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $users = Auth::user()->id;

            $akad = Akad::where('user_id', $users)->first();
            $resepsi = Resepsi::where('user_id', $users)->first();

            if ($akad) {
                $akad->date        = $request->akad_date;
                $akad->start        = $request->akad_start;
                $akad->end        = $request->akad_end;
                $akad->location        = $request->akad_location;
                $akad->address        = $request->akad_address;
                $akad->link_maps        = $request->akad_link_maps;
                $akad->save();
            } else {
                $new_akad = new Akad();
                $new_akad->user_id      = $users;
                $new_akad->date        = $request->akad_date;
                $new_akad->start        = $request->akad_start;
                $new_akad->end        = $request->akad_end;
                $new_akad->location        = $request->akad_location;
                $new_akad->address        = $request->akad_address;
                $new_akad->link_maps        = $request->akad_link_maps;
                $new_akad->save();
            }

            if ($resepsi) {
                $resepsi->date        = $request->resepsi_date;
                $resepsi->start        = $request->resepsi_start;
                $resepsi->end        = $request->resepsi_end;
                $resepsi->location        = $request->resepsi_location;
                $resepsi->address        = $request->resepsi_address;
                $resepsi->link_maps        = $request->resepsi_link_maps;
                $resepsi->save();
            } else {
                $new_resepsi = new Resepsi();
                $new_resepsi->user_id      = $users;
                $new_resepsi->date        = $request->resepsi_date;
                $new_resepsi->start        = $request->resepsi_start;
                $new_resepsi->end        = $request->resepsi_end;
                $new_resepsi->location        = $request->resepsi_location;
                $new_resepsi->address        = $request->resepsi_address;
                $new_resepsi->link_maps        = $request->resepsi_link_maps;
                $new_resepsi->save();
            }

            DB::commit();
            return response()->json([
                'message' => 'Data berhasil ditambah'
            ]);
        } catch (Throwable $th) {
            DB::rollBack();
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
