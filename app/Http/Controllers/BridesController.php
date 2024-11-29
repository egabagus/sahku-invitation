<?php

namespace App\Http\Controllers;

use App\Http\Requests\BridesRequest;
use App\Models\Bride;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class BridesController extends Controller
{
    public static function index()
    {
        $id = Auth::user()->id;
        $data = Bride::where('user_id', $id)->first();

        return view('admin.brides.index', compact('data'));
    }

    public function store(BridesRequest $request)
    {
        DB::beginTransaction();
        try {
            $users = Auth::user()->id;

            $brides = Bride::where('user_id', $users)->first();
            // dd($brides);
            if ($brides) {
                $brides->men_name        = $request->men_name;
                $brides->men_nickname    = $request->men_nickname;
                $brides->men_desc        = $request->men_desc;
                $brides->women_name      = $request->women_name;
                $brides->women_nickname  = $request->women_nickname;
                $brides->women_desc      = $request->women_desc;

                if ($brides->men_photo && Storage::exists($brides->men_photo)) {
                    Storage::delete($brides->men_photo);
                }
                if ($brides->women_photo && Storage::exists($brides->women_photo)) {
                    Storage::delete($brides->women_photo);
                }
                // dd($brides->men_photo);

                $men_path                = $request->file('men_photo')->store('men_photo', 'public');
                $brides->men_photo       = $men_path;
                $women_path              = $request->file('women_photo')->store('women_photo', 'public');
                $brides->women_photo     = $women_path;
                $brides->save();
            } else {
                $bride = new Bride();
                $bride->user_id         = $users;
                $bride->men_name        = $request->men_name;
                $bride->men_nickname    = $request->men_nickname;
                $bride->men_desc        = $request->men_desc;
                $bride->women_name      = $request->women_name;
                $bride->women_nickname  = $request->women_nickname;
                $bride->women_desc      = $request->women_desc;
                $men_path                = $request->file('men_photo')->store('men_photo', 'public');
                $brides->men_photo       = $men_path;
                $women_path              = $request->file('women_photo')->store('women_photo', 'public');
                $brides->women_photo     = $women_path;
                $bride->save();
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
