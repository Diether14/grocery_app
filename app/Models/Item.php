<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //table for item model
    protected $table = 'items';

    //fillable fields for item model
    protected $fillable = ['name', 'description', 'price', 'status'];

    //relationship configurations
    public function categories() {
        return $this->belongsToMany('App\Models\Category', 'category_items', 'item_id', 'category_id');
    }
}
