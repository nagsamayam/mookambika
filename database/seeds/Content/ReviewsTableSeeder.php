<?php

use App\Models\Review;
use App\Models\Tag;
use Database\DisableForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeder;

class ReviewsTableSeeder extends Seeder
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

        DB::table('taggables')->where('taggable_type', 'reviews')->delete();
        $this->truncate('reviews');

        $reviews = factory(Review::class, 10)->create();
        foreach ($reviews as $review) {
            $tagIds = Tag::pluck('id')->random();
            $review->tags()->sync([$tagIds]);
        }
        $this->command->info('Reviews seeded!');
        $this->enableForeignKeys();
    }
}
