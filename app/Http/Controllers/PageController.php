<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function howItWorks()
    {
        return view('pages.how-it-works');
    }

    public function testimonials()
    {
        return view('pages.testimonials');
    }
}
