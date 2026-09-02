<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArchiveDocument extends Model
{
    protected $fillable = ['title_bn', 'title_en', 'slug', 'description_bn', 'file_path', 'file_type', 'file_size', 'year', 'subcategory', 'is_published', 'uploaded_by'];
}
