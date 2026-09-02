<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['parent_id', 'name_bn', 'name_en', 'slug', 'description', 'order', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('order');
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function scopeParents($query)
    {
        return $query->whereNull('parent_id');
    }

    public function isParent(): bool
    {
        return $this->children()->exists();
    }
}
