<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $with = ['author'];

    public static function findByAuthorId($authorId)
    {
        return static::where('author_id', $authorId)->all();
    }

    public static function findByName($name)
    {
        return static::where('name', $name)->first();
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
