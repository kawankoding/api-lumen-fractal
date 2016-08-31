<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $fillable     = [
        'user_id', 'tweet'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeTerbaru($query)
    {
        return $query->orderBy('created_at', 'DESC');
    }
}
