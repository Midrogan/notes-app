<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagsType extends Model
{
    use HasFactory;
    protected $table = 'tags_types';

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
}

