<?php

namespace App\Http\Controllers;

use App\Models\Bride;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BridesController extends Controller
{
    public static function index()
    {
        $id = Auth::user()->id;
        $data = Bride::where('user_id', $id)->first();

        return view('admin.brides.index', compact('data'));
    }
}
