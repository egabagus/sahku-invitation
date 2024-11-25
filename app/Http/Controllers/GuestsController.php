<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestsController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $data = Guest::where('user_id', $id)->first();

        return view('admin.guests.index', compact('data'));
    }

    public function add()
    {
        $id = Auth::user()->id;
        $events = Events::where('user_id', $id)->get();

        return view('admin.guests.create', compact('events'));
    }
}
