<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use \Database\DisableForeignKeys;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        $this->call(TagsTableSeeder::class);
        $this->call(SectionsTableSeeder::class);
        $this->call(NewsTableSeeder::class);
        $this->call(ReviewsTableSeeder::class);
        $this->call(FaqsTableSeeder::class);
        $this->call(FootersTableSeeder::class);
        $this->call(PagesTableSeeder::class);

        $this->enableForeignKeys();
    }
}
