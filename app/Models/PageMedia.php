<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'file_path',
        'type',
        'sort_order',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
