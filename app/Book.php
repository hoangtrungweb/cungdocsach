<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //

   protected $fillable = ['status'];
   public function category()
	{
		return $this->belongsTo('App\Category','cate_id');
	}
	
	public function users() {
        return $this->belongsToMany('User', 'book_requests', 'book_id', 'user_id');
    }
}
