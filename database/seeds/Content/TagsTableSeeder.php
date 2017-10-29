<?php

use App\Models\Tag;
use Database\TruncateTable;
use Illuminate\Database\Seeder;
use Database\DisableForeignKeys;

class TagsTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    public function run()
    {
        $this->disableForeignKeys();
        $this->truncateMultiple(['taggables', 'tags']);
        factory(Tag::class, 200)->create();
        $this->command->info('Tags seeded!');
        $this->enableForeignKeys();
    }
}
