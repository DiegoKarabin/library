<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Author;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    protected $guarded = [];

    public function path()
    {
        return "/books/$this->id-" . \Str::slug($this->title);
    }

    public function setAuthorAttribute($author)
    {
        $this->attributes['author_id'] = Author::firstOrCreate([
            'name' => $author
        ])->id;
    }

    public function author()
    {
        return $this->belongsTo('App\Author');
    }
}
