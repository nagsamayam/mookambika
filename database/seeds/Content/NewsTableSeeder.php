<?php

use App\Models\News;
use App\Models\Tag;
use Database\DisableForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        DB::table('taggables')->where('taggable_type', 'news')->delete();
        $this->truncate('news');
        $news = factory(News::class, 100)->create();
        foreach ($news as $piece) {
            $tagIds = Tag::pluck('id')->random();
            $piece->tags()->sync([$tagIds]);
        }
        $this->command->info('News seeded!');
        $this->enableForeignKeys();
    }
}
