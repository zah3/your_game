<?php

namespace App\Http\Controllers;

use App\UserCards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCardController extends Controller
{
    public function index()
    {
        $cards = UserCards::where('user_id','=',Auth::user()->id)->paginate(25);
    }
}
