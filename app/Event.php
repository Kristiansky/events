<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Event extends Model
{
    public function category(){
        return $this->belongsTo('App\Category');
    }
    
    public static function filter($category_id = null, $from = null, $to = null, $past = false, $language = 'en'){
    
        
        $events = DB::table('events');
        
        $events->where('status', '=', 'active');
        $events->where('language', '=', $language);
    
    
        if($category_id)
            $events->where('category_id', '=', $category_id);
    
        if($from)
            $events->whereDate('start_on', '>=',  $from);
    
        if($to)
            $events->whereDate('start_on', '<=',  $to);
        
        
        $events->orderBy('start_on', 'asc');
        $events->orderBy('id', 'desc');

        if($past == true){
            $events->orderBy('start_on', 'desc');
            $events->orderBy('id', 'asc');
        }
        
        return $events->paginate(10);
    }
    
}
