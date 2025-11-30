<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'slug',
        'title',
        'recipient_name',
        'message',
        'theme_style',
        'music_url',
        'is_premium',
        'expires_at',
    ];

    protected $casts = [
        'is_premium' => 'boolean',
        'expires_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function media()
    {
        return $this->hasMany(PageMedia::class)->orderBy('sort_order');
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}
