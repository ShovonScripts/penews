<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    protected $fillable = ['name', 'file_name', 'path', 'mime_type', 'size', 'folder', 'alt_text', 'credit', 'uploaded_by'];

    public function getUrlAttribute(): string
    {
        return Storage::disk('public')->url($this->path);
    }

    public function getThumbnailAttribute(): string
    {
        return $this->url;
    }
}
