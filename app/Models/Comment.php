<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Comment extends Model
{
    use HasFactory;
     protected $guarded=[];
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
    protected static function booted()
    {
        
        static::creating(function ($comment) {
            $comment->user_id = auth()->user()?->id;
            $comment->uuid=Str::uuid()->toString();
           
        });
    }
}
