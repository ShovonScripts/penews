<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class PageView extends Model
{
    public $timestamps = false;

    protected $fillable = ['viewable_type', 'viewable_id', 'ip', 'user_agent', 'referer', 'user_id', 'created_at'];

    protected function casts(): array
    {
        return ['created_at' => 'datetime'];
    }

    public function viewable(): MorphTo
    {
        return $this->morphTo();
    }
}
