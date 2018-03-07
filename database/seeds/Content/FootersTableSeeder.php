<?php

use App\Models\Footer;
use Database\DisableForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeder;

class FootersTableSeeder extends Seeder
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
        $this->truncate('footers');
        factory(Footer::class, 10)->create();
        $this->command->info('Footers seeded!');
        $this->enableForeignKeys();
    }
}
