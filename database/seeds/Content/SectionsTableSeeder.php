<?php

use Database\TruncateTable;
use Illuminate\Database\Seeder;
use Database\DisableForeignKeys;

class SectionsTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = 'sections';
        $this->disableForeignKeys();
        $this->truncateMultiple(['page_section', $table]);

        $sections = [
            [
                'title' => 'Banner'
            ],
            [
                'title' => 'Text'
            ],
            [
                'title' => 'Widget_Services'
            ],
            [
                'title' => 'Reviews'
            ],
            [
                'title' => 'FAQs'
            ],
            [
                'title' => 'News'
            ],
            [
                'title' => 'Features'
            ],/*
            [
                'title' => 'Events',
            ],*/
            [
                'title' => 'Photos'
            ],
            [
                'title' => 'Maps'
            ],
            [
                'title' => 'HTML'
            ],
            [
                'title' => 'Widget_3Steps'
            ],
            [
                'title' => 'Widget_CTA'
            ],
            [
                'title' => 'Widget_CTA_Form'
            ]
        ];
        DB::table($table)->insert($sections);
        $this->enableForeignKeys();
        $this->command->info('Sections seeded!');
    }
}
