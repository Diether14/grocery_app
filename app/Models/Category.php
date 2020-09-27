<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
        //table for category model
        protected $table = 'categories';

        //fillable fields for category model
        protected $fillable = ['name', 'description', 'price', 'status'];
    
        //relationship configurations
        public function items() {
            return $this->belongsToMany('App\Models\Item', 'category_items', 'category_id', 'item_id');
        }
}
