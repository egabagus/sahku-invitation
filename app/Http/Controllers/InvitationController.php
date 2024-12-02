<?php

namespace App\Http\Controllers;

use App\Models\Bride;
use App\Models\Guest;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function index($bride, $guest)
    {
        $bride = Bride::where('slug', $bride)->first();
        $guest = Guest::find($guest);

        return view('themes.01.index', compact('bride', 'guest'));
    }
}
