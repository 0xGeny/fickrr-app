<?php

namespace Fickrr\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Comment extends Model
{
    
	
	
	protected $table = 'item_comments';
	
	
	public function ReplyComment()
    {
        return $this->hasMany(ReplyComment::class, 'comm_id', 'comm_id')->leftjoin('users', 'users.id', '=', 'item_comment_reply.comm_user_id');
    }
	
  
    
  
}
