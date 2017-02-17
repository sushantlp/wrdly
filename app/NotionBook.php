<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotionBook extends Model
{
    protected $table = 'notion_books';
    protected $primaryKey='book_id';
    protected $fillable = ['thought_id','habitant_id','chapter','status'];
}
