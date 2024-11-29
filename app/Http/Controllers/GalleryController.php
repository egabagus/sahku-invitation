<?php

namespace App\Http\Controllers;

use App\Http\Requests\CoverStoreRequest;
use App\Http\Requests\GalleryStoreRequest;
use App\Models\Gallery;
use Illuminate\Cache\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class GalleryController extends Controller
{
    private $user_id;

    // Constructor untuk menginisialisasi properti
    public function __construct()
    {
        $this->user_id = Auth::user()->id;
    }

    public function index()
    {
        $data = Gallery::where('user_id', $this->user_id)->where('photo_type', 'photos')->get();
        $cover = Gallery::where('user_id', $this->user_id)->where('photo_type', 'cover')->first();
        return view('admin.gallery.index', compact('data', 'cover'));
    }

    public function coverStore(CoverStoreRequest $request)
    {
        try {
            DB::beginTransaction();

            $cover = Gallery::where('user_id', $this->user_id)->where('photo_type', 'cover')->first();
            if ($cover) {
                if (Storage::exists($cover->photo)) {
                    Storage::delete($cover->photo);
                }

                $path               = $request->file('cover')->store('cover', 'public');
                $cover->photo       = $path; // Update dengan path baru
                $cover->save();
            } else {
                $new = new Gallery();
                $new->user_id       = $this->user_id;
                if ($request->hasFile('cover')) {
                    $path = $request->file('cover')->store('cover', 'public'); // Simpan di storage/app/public/cover
                    $new->photo = $path; // Simpan path ke kolom photo
                }
                $new->photo_type    = 'cover';
                $new->save();
            }

            DB::commit();
            return response()->json([
                'message' => 'Cover berhasil diupload'
            ]);
        } catch (Throwable $th) {
            DB::rollBack();
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function photoStore(GalleryStoreRequest $request)
    {
        try {
            DB::beginTransaction();

            // dd($request->photos);
            $new                = new Gallery();
            $new->user_id       = $this->user_id;
            if ($request->hasFile('photos')) {
                $path           = $request->file('photos')->store('photos', 'public');
                $new->photo     = $path;
            }
            $new->photo_type    = 'photos';
            $new->save();

            DB::commit();
            return response()->json([
                'message' => 'Cover berhasil diupload'
            ]);
        } catch (Throwable $th) {
            DB::rollBack();
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function photoDelete($id)
    {
        try {
            DB::beginTransaction();

            $photos = Gallery::find($id)->delete();

            DB::commit();
            return response()->json([
                'message' => 'Berhasil dihapus'
            ]);
        } catch (Throwable $th) {
            DB::rollBack();
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
