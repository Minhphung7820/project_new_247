<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Factories\Relationship;
class Comment extends Model
{
    use HasFactory;
    protected $table = "comment_news";
    public $timestamps = false;
    protected $primaryKey = 'commentId';
    protected $fillable = [
        'commentId',
        'idNews',
        'userId',
        'msg_cmt',
        'date_cmt',
        'status_cmt',
        'avatar_cmt',
        'email_cmt',
        'name_cmt',
        'role_cmt',
        'user_rep',
        'id_cmt_rep',
        'provider_user_cmt',
        'id_cmt_son_rep'
    ];
    public function news()
    {
        return $this->belongsTo(News::class,"idNews","newsId");
    }
    public function user()
    {
        return $this->belongsTo(User::class,"userId","id");
    }
}
