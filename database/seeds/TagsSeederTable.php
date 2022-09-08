<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Tag;
class TagsSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'Piatto Veloce',
            'Vegetariano',
            'Vegano',
            'Gluten Free',
            'Piatto Freddo'
        ];

        foreach($tags as $tags_name) {
            $new_tags = new Tag(); 
            $new_tags->name = $tags_name;
            $new_tags->slug = Str::slug($new_tags->name, '-');
            $new_tags->save();
        }
    }

   
}
