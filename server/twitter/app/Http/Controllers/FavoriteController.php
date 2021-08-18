<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Twitter;
use App\User;
use App\Email;

use Mail;
use Auth;

class FavoriteController extends Controller
{
    public function store(Request $request, $id)
    {
            \Auth::user()->favorite($id);
            return back();
    }

    public function destroy($id)
    {
            \Auth::user()->unfavorite($id);
            return back();
    }
}
