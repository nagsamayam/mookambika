<?php

use App\Models\Faq;
use App\Models\Tag;
use Database\TruncateTable;
use Illuminate\Database\Seeder;
use Database\DisableForeignKeys;

class FaqsTableSeeder extends Seeder
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
        DB::table('taggables')->where('taggable_type', 'faqs')->delete();
        $this->truncate('faqs');

        $faqs = factory(Faq::class, 20)->create();
        foreach ($faqs as $faq) {
            $tagIds = Tag::pluck('id')->random();
            $faq->tags()->sync([$tagIds]);
        }
        $this->command->info('FAQs seeded!');
        $this->enableForeignKeys();
    }
}
