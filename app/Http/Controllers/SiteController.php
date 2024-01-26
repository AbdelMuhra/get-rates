<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;
use Illuminate\Support\Facades\Http;

class SiteController extends Controller
{
    public function viewHome()
    {
        $rates = Currency::getRates();
        return view('home', ['rates' => $rates]);
    }

    public function getRates()
    {
        $response = Http::get('https://www.completeapi.com/free_currencies.min.json');

        return $response->json();
    }
}
