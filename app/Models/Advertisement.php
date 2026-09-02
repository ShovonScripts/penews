<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $fillable = ['title', 'position', 'type', 'code', 'image_url', 'link_url', 'width', 'height', 'impressions', 'clicks', 'is_active', 'starts_at', 'ends_at', 'order'];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
            'impressions' => 'integer',
            'clicks' => 'integer',
        ];
    }
}
