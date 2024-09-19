<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Sponsor;
use Illuminate\Http\Request;

class SponsorController extends Controller
{
    public function sponsorshipsIndex(){

        $sponsors = Sponsor::all();

    return view('user.sponsorships.index', compact('sponsors'));
    }
}
