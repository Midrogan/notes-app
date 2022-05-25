<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'notes';
    protected $fillable = [
        'title',
        'subtitle',
        'content',
    ];
    // protected $dates = ['deleted_at'];
    // protected $appends = array('short_title','short_subtitle','short_content');

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    static function shortNote($array)
    {
        foreach ($array as $key) {  
            $key['title'] = Str::words((string)$key['title'], 5); 
            $key['subtitle'] = Str::words((string)$key['subtitle'], 5);        
            $key['content'] = Str::words((string)$key['content'], 15);
        }
        return $array;
    }

    // protected function getShortTitleAttribute()
    // {
    //     return Str::words((string)$this['title'], 5);
    // }
}
