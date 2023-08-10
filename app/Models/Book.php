<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $with = ['author'];

    protected $fillable = ['title', 'author_id'];

    public function scopeByAuthorId($query, $authorId)
    {
        return $query->where('author_id', $authorId);
    }

    public function scopeByTitle($query, $title)
    {
        return $query->where('title', $title);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
