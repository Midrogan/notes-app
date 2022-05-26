<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsTypesSeeder extends Seeder
{
    static $types = [
        'tag-red',
        'tag-pink',
        'tag-purple',
        'tag-violet',
        'tag-blue',
        'tag-light-blue',
        'tag-turquoise',
        'tag-green',
        'tag-light-green',
        'tag-yellow',
        'tag-orange'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::$types as $type) {
            DB::table('tags_types')->insert([
                'type' => $type
            ]);
        }
    }
}
