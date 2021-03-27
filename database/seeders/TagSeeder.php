<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');
        \DB::table('tags')->truncate();

        $tags = [
            'Ant Whitehead',
            'Lucy Pritchard',
            'Paul Whitehead',
            'Emma Southwell-Sander',
            'Rob Southwell-Sander',
            'Mart Pritchard',
            'Audrey Pritchard',
            'Elliot Pritchard',
            'Sophie Southwell-Sander',
            'Evie Southwell-Sander',
            'Maddy Southwell-Sander'
        ];

        foreach ($tags as $tag){
            $newTag = new Tag();
            $newTag->name = $tag;
            $newTag->save();
        }

        \DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
