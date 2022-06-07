<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    // protected $table= 'categories';
    protected $primaryKey = 'cateid';
    protected $fillable = [
        'name'
    ];

    const PAGINATE=5;
    public function products()
    {
        return $this->hasMany('App\Models\Product', 'categoryid', 'cateid');
    }
}
