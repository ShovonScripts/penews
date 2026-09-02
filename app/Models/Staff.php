<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Staff extends Model
{
    protected $table = 'staff';

    protected $fillable = [
        'name_bn', 'name_en', 'designation_bn', 'designation_en',
        'staff_type', 'bio_bn', 'bio_en', 'photo', 'email', 'phone',
        'order', 'is_active',
    ];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'article_staff');
    }
}
