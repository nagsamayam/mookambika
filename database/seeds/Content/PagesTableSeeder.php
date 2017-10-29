<?php

use App\Models\Faq;
use App\Models\Page;
use App\Models\News;
use App\Models\Event;
use App\Models\Review;
use App\Models\Section;
use Database\TruncateTable;
use Illuminate\Database\Seeder;
use Database\DisableForeignKeys;

class PagesTableSeeder extends Seeder
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
        $this->truncateMultiple(['page_section', 'pages']);

        try {
            $faker = Faker\Factory::create();
            $pages = factory(Page::class, 2)->create();
            $pages->each(function ($page) use ($faker) {
                $sections = Section::all();
                foreach ($sections as $section) {
                    $callMethod = 'save' . str_replace('_', '', $section->title);
                    $page->sections()
                        ->attach($section->id, [
                            'section_title' => $section->title,
                            'content' => json_encode($this->{$callMethod}($faker)),
                            'sequence' => 1, 'mobile_enabled' => 1
                        ]);
                }
            });
        } catch (\Exception $e) {
            $this->command->error($e->getLine() . $e->getMessage());
        }
        $this->command->info('Pages seeded!');
        $this->enableForeignKeys();
    }

    public function savePageSection($page, $section)
    {
        $faker = Faker\Factory::create();
        $page->sections()->save($section, [
            'section_title' => $section->title,
            'content' => json_encode($this->saveBannerSection($faker)),
            'sequence' => 1,
            'mobile_enabled' => 1
        ]);
    }

    public function saveBanner($faker)
    {
        $title = $faker->sentence(mt_rand(3, 5));
        $ctaLinks = array_merge(config('blog.uris.services'), [config('blog.uris.contact_us')]);
        return [
            'type' => array_random(['Full', 'Short']),
            'heading' => $title,
            'sub_heading' => strtolower($title),
            'cta_label' => $faker->word,
            'cta_link' => array_random($ctaLinks),
        ];
    }

    public function saveText($faker)
    {
        $title = $faker->sentence(mt_rand(3, 10));
        return [
            'heading' => $title,
            'sub_heading' => strtolower($title),
            'description' => $faker->paragraph
        ];
    }

    public function saveReviews($faker)
    {
        $title = $faker->sentence(mt_rand(3, 10));
        $randomReview = Review::inRandomOrder()->first();
        $tags = $randomReview->tags->pluck('id')->toArray();
        return [
            'heading' => $title,
            'sub_heading' => strtolower($title),
            'tags' => json_encode($tags),
            'items_show_before_read_more' => config('blog.reviews.items_show_before_read_more')
        ];
    }

    public function saveFAQs($faker)
    {
        $title = $faker->sentence(mt_rand(3, 10));
        $randomFaq = Faq::inRandomOrder()->first();
        $tags = $randomFaq->tags->pluck('id')->toArray();
        return [
            'heading' => $title,
            'sub_heading' => strtolower($title),
            'tags' => json_encode($tags),
            'items_show_before_read_more' => config('blog.faqs.items_show_before_read_more')
        ];
    }

    public function saveNews($faker)
    {
        $title = $faker->sentence(mt_rand(3, 10));
        $randomNews = News::inRandomOrder()->first();
        $tags = $randomNews->tags->pluck('id')->toArray();

        return [
            'type' => array_random(['Full', 'Short']),
            'heading' => $title,
            'sub_heading' => strtolower($title),
            'tags' => json_encode($tags),
            'items_show_before_read_more' => config('blog.news.items_show_before_read_more')
        ];
    }

    public function saveFeatures($faker)
    {
        $heading = $faker->sentence(mt_rand(3, 10));
        $titles = [];
        for ($i = 0; $i < rand(1, 10); $i++) {
            array_push($titles, $faker->sentence(mt_rand(3, 10)));
        }
        return [
            'heading' => $heading,
            'sub_heading' => strtolower($heading),
            'number' => config('blog.features.number'),
            'titles' => json_encode($titles)
        ];
    }

    public function savePhotos($faker)
    {
        $heading = $faker->sentence(mt_rand(3, 10));
        $gallery = [];
        for ($i = 0; $i < rand(1, 10); $i++) {
            $gallery[$i]['image'] = $faker->imageUrl;
            $gallery[$i]['alt_text'] = $faker->sentence(mt_rand(3, 10));
        }
        return [
            'heading' => $heading,
            'sub_heading' => strtolower($heading),
            'number' => config('blog.gallery.number'),
            'gallery' => json_encode($gallery)
        ];
    }

    public function saveMaps($faker)
    {
        $title = $faker->sentence(mt_rand(3, 6));
        return [
            'heading' => $title,
            'sub_heading' => strtolower($title),
            'from_location' => $faker->city,
            'to_location' => $faker->city
        ];
    }

    public function saveEvents($faker)
    {
        $title = $faker->sentence(mt_rand(3, 10));
        $events = [];
        for ($i = 0; $i < rand(1, 3); $i++) {
            $events[$i]['name'] = $faker->sentence(mt_rand(3, 5));
            $events[$i]['date'] = $faker->dateTime('now');
            $events[$i]['description'] = $faker->paragraph;
            $events[$i]['location'] = $faker->address;
        }
        return [
            'heading' => $title,
            'sub_heading' => strtolower($title),
            'events' => json_encode($events)
        ];
    }

    public function saveHTML($faker)
    {
        $title = $faker->sentence(mt_rand(3, 10));
        return [
            'type' => array_random(['Full', 'Short']),
            'heading' => $title,
            'sub_heading' => strtolower($title),
            'cta_label' => $faker->word,
            'cta_link' => array_random(
                array_merge(config('blog.uris.services'), [config('blog.uris.contact_us')])
            )
        ];
    }

    public function saveWidgetServices($faker)
    {
        $title = $faker->sentence(mt_rand(3, 10));
        $services = [];
        $icons = ['&#xE53A;', '&#xE80E;', '&#xE559;'];
        $ctaLinks = config('blog.uris.services');
        for ($i = 0; $i <= 2; $i++) {
            $services[$i]['icon'] = $icons[$i];
            $services[$i]['name'] = $faker->word;
            $services[$i]['description'] = $faker->sentence(mt_rand(3, 6));
            $services[$i]['cta_label'] = $faker->word;
            $services[$i]['cta_link'] = url(array_rand($ctaLinks));
        }
        return [
            'heading' => $title,
            'sub_heading' => strtolower($title),
            'services' => $services,
        ];
    }

    public function saveWidget3Steps($faker)
    {
        $title = $faker->sentence(mt_rand(3, 10));
        $steps = [];
        for ($i = 1; $i <= 3; $i++) {
            $steps[$i]['name'] = $faker->word;
            $steps[$i]['description'] = $faker->sentence;
        }
        return [
            'heading' => $title,
            'sub_heading' => strtolower($title),
            'cta_label' => 'Book now',
            'cta_link' => 'Know more',
            'steps' => json_encode($steps)
        ];
    }

    public function saveWidgetCTA($faker)
    {
        $title = $faker->sentence(mt_rand(3, 10));
        return [
            'type' => array_random(['Full', 'Short']),
            'heading' => $title,
            'sub_heading' => strtolower($title),
            'cta_label' => $faker->word,
            'cta_link' => array_rand(array_merge(config('blog.uris.services'), [config('blog.uris.contact_us')])),
        ];
    }

    public function saveWidgetCTAForm($faker)
    {
        $title = $faker->sentence(mt_rand(3, 10));
        return [
            'heading' => $title,
            'sub_heading' => strtolower($title),
        ];
    }
}
