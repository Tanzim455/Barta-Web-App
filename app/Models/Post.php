<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class)->select(['id', 'name','username']);
    }
    public function scopeWithUserDetails( $query)
    {
        return $query->with(['user' => function ($query) {
            $query->select('id', 'name', 'username');
        }]);
    }
    public function scopeWithUserComments($query)
    {
        return $query->with([
            
            'comments:id,post_id,user_id,description', // Specify the columns for the comments relation
            'comments.user:id,name,username'
        ]);
    }

  
    // ...

    public function scopeWithUserCommentsCount($query, $username)
    {
        return $query->join('users', 'users.id', '=', 'posts.user_id')
            ->leftJoin('comments', 'comments.post_id', '=', 'posts.id')
            ->where('users.username', $username)
            ->select('posts.id',
                'posts.uuid',
                'posts.description',
                'posts.user_id',
                'users.id',
                'users.username', 'users.name',
                DB::raw('count(comments.id) as comments_count'))
            ->groupBy('posts.id',
                'posts.description',
                'posts.user_id',
                'posts.uuid',
                'users.id', 'users.username', 'users.name');
    }


    
    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
