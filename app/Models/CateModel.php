<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CateModel extends Model
{
    use HasFactory;
    protected $table = "category";
    public $timestamps = false;
    protected $primaryKey = 'categoryId';
    protected $fillable = [
        'categoryId',
        'parent_ID',
        'parentS_ID',
        'nameCat',
        'aliasCat',
        'logoCate',
        'statusCate',
        'date_addCate',
        'date_upCate'
    ];

    public function news()
    {
        return $this->hasMany(News::class,"cateNews","categoryId");
    }


}
