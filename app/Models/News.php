<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table = "news";
    public $timestamps = false;
    protected $primaryKey = 'newsId';
    protected $fillable = [
        'newsId',
        'cateNews',
        'TieuDe',
        'TomTat',
        'imageNews',
        'ContentNews',
        'TacGia',
        'date_created',
        'date_update',
        'date_deleted',
        'Show_Hide_News',
        'TieuDe_slug',
        'Views_News',
        'Tag_News',
        'Slug_Tags_News'
    ];

    public function comment()
    {
        return $this->hasMany(Comment::class,"idNews","newsId");
    }
    
    public function category()
    {
        return $this->belongsTo(CateModel::class,"cateNews","categoryId");
    }

}
