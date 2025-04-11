<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%");
    }
    public function scopeFilterByProductCount($query, $minCount, $maxCount)
    {
        return $query->whereHas('products', function ($q) use ($minCount, $maxCount) {
            $q->havingRaw('COUNT(*) BETWEEN ? AND ?', [$minCount, $maxCount]);
        });
    }
    public function scopeFilterByProductPriceRange($query, $minPrice, $maxPrice)
    {
        return $query->whereHas('products', function ($q) use ($minPrice, $maxPrice) {
            $q->whereBetween('price', [$minPrice, $maxPrice]);
        });
    }
    public function scopeFilterByProductStock($query, $minStock, $maxStock)
    {
        return $query->whereHas('products', function ($q) use ($minStock, $maxStock) {
            $q->whereBetween('stock', [$minStock, $maxStock]);
        });
    }
    public function scopeFilterByProductName($query, $name)
    {
        return $query->whereHas('products', function ($q) use ($name) {
            $q->where('name', 'like', "%{$name}%");
        });
    }
    public function scopeFilterByProductDescription($query, $description)
    {
        return $query->whereHas('products', function ($q) use ($description) {
            $q->where('description', 'like', "%{$description}%");
        });
    }
    public function scopeFilterByProductCategory($query, $categoryId)
    {
        return $query->whereHas('products', function ($q) use ($categoryId) {
            $q->where('category_id', $categoryId);
        });
    }
}
