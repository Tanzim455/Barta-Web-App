<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFromUserPosts($query, $userId)
    {
        return $query->select('comments.post_id')
            ->whereIn('comments.post_id', function ($query) use ($userId) {
                $query->select('id')
                    ->from('posts')
                    ->where('posts.user_id', $userId);
            });
    }
}
