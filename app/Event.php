<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Event extends Model
{
    protected $fillable = [
        'status',
        'language',
        'start_on',
        'end_on',
        'category_id',
        'title',
        'body',
    ];
    
    /*public function newCollection(array $models = [])
    {
        return new Event($models);
    }*/
    
    public function category(){
        return $this->belongsTo('App\Category');
    }
    
    public static function filter($title = null, $status = null, $language = null, $category_id = null, $from = null, $to = null, $past = false){
        
        $events = Event::with('category');
    
        if($title)
            $events->where('title', 'like', '%'.$title.'%');
    
        if($status)
            $events->where('status', '=', $status);
    
        if($language)
            $events->where('language', '=', $language);
        
        if($category_id)
            $events->where('category_id', '=', $category_id);
    
        if($from){
            $events->whereDate('start_on', '>=',  $from);
        }
    
        if($to)
            $events->whereDate('start_on', '<=',  $to);
        

        if($past == true){
            $events->whereDate('start_on', '<',  date('Y-m-d'));
            $events->orderBy('start_on', 'desc');
            $events->orderBy('id', 'asc');
        }else{
            $events->whereDate('start_on', '>=',  date('Y-m-d'));
            $events->orderBy('start_on', 'asc');
            $events->orderBy('id', 'desc');
        }
        
        return $events->paginate(10);
    }
    
}
