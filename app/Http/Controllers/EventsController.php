<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventsController extends Controller
{
    public static function index()
    {
        $id = Auth::user()->id;
        $data = Events::where('user_id', $id)->first();

        return view('admin.events.index', compact('data'));
    }
}
