<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
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
    
    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
