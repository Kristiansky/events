<?php

namespace App\Http\Controllers;

use App\Category;
use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    
    public function listEvents($past, Request $request)
    {
        $get_params = $request->all();
        $events = Event::filter(
            $request->get('category_id'),
            $request->get('from'),
            $request->get('to'),
            $past
        );
    
        $categories = Category::pluck('name', 'id')->all();
        
        return view('list', compact('events', 'categories', 'get_params'));
    }
}
