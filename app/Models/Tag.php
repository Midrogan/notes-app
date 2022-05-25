<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;
    protected $table = 'tags';

    // protected $fillable = [
    //     'name',
    //     'tags_type_id',
    // ];

    public function tagsType()
    {
        return $this->belongsTo(TagsType::class);
        // return $this->belongsTo(TagsType::class);
        // return $this->hasOne(TagsType::class, 'tags_type_id', 'id');
    }

    public function notes()
    {
        return $this->belongsToMany(Note::class);
    }
}
