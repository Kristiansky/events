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
    
    public function view($id)
    {
        $event = Event::findOrFail($id);
        return view('event', compact('event'));
    }
    
    public function listEvents($past, Request $request)
    {
        $events = Event::filter(
            $request->get('title'),
            $request->get('status'),
            $request->get('language'),
            $request->get('category_id'),
            $request->get('from'),
            $request->get('to'),
            $past
        );
    
        $categories = Category::pluck('name', 'id')->all();
        $get_params = $request->all();
        
        return view('list', compact('events', 'categories', 'get_params', 'past'));
    }
}
