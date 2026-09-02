<?php

namespace App\Enums;

enum ArticleStatus: string
{
    case DRAFT = 'draft';
    case SUBMITTED = 'submitted';
    case PUBLISHED = 'published';
    case SCHEDULED = 'scheduled';
    case ARCHIVED = 'archived';

    public function label(): string
    {
        return match($this) {
            self::DRAFT => 'খসড়া',
            self::SUBMITTED => 'পর্যালোচনায়',
            self::PUBLISHED => 'প্রকাশিত',
            self::SCHEDULED => 'নির্ধারিত',
            self::ARCHIVED => 'আর্কাইভ',
        };
    }
}
