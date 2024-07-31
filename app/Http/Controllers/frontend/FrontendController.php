<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){


        return view('frontend.modules.index');
    }
    public function single(){

        return view('frontend.modules.single-post');
    }
}
