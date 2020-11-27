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
    
    public function futureEvents(Request $request)
    {
        $get_params = $request->all();
        if(!empty($get_params)){
            $events = Event::filter(
                $request->get('category_id'),
                $request->get('from'),
                $request->get('to'),
                false
            );
        }else{
            $events = DB::table('events');
            $events->where('status', '=', 'active');
            $events->where('language', '=', 'en');
            $events->orderBy('start_on', 'asc');
            $events->orderBy('id', 'desc');
            $events = $events->paginate(10);
        }
    
        $categories = Category::pluck('name', 'id')->all();
        return view('list', compact('events', 'categories', 'get_params'));
    }
    
    public function pastEvents(Request $request)
    {
        $get_params = $request->all();
        if(!empty($get_params)){
            $events = Event::filter(
                $request->get('category_id'),
                $request->get('from'),
                $request->get('to'),
                true
            );
        }else{
            $events = DB::table('events');
            $events->where('status', '=', 'active');
            $events->where('language', '=', 'en');
            $events->orderBy('start_on', 'desc');
            $events->orderBy('id', 'asc');
            $events = $events->paginate(10);
        }
    
        $categories = Category::pluck('name', 'id')->all();
        
        return view('list', compact('events', 'categories', 'get_params'));
    }
}
