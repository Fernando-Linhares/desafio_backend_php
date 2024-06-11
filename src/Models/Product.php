<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'price', 'category_id'];

    protected $with = ['category'];

    protected $appends = ['fee', 'net_value'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected function fee(): Attribute
    {
        $value = $this->price * ($this->category->fee / 100);

        return Attribute::make(get: fn() => $value);
    }

    protected function netValue(): Attribute
    {
        return Attribute::make(get: fn() => $this->price + $this->fee);
    }
}