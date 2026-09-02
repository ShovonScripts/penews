<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'subject', 'message', 'reply', 'replied_at', 'read_at'];

    protected function casts(): array
    {
        return [
            'replied_at' => 'datetime',
            'read_at' => 'datetime',
        ];
    }

    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }

    public function scopeReplied($query)
    {
        return $query->whereNotNull('replied_at');
    }

    public function scopeUnreplied($query)
    {
        return $query->whereNull('replied_at');
    }
}
