<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Freshman;
use App\Models\Circle;
use Illuminate\Support\Facades\Mail;
use App\Mail\AnnounceNotification;

class AnnounceController extends Controller
{
    // アナウンス
    public function index()
    {
        foreach (Freshman::all() as $freshman) {
            Mail::to($freshman['email'])->send(new AnnounceNotification($freshman['name_sei'] . $freshman['name_mei']));
        }
        
        // foreach (Circle::all() as $circle) {
        //     Mail::to($circle['email'])->send(new AnnounceNotification($circle['name']));
        // }

        return redirect()->route('top');
    }
}
