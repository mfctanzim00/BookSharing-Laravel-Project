<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function parent_category($parent_id)
    {
    	$category = Category::find($parent_id);
    	return $category;
    }
}
