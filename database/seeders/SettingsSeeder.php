<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{

    protected $settings = [
        [
            'key'         => 'search_bar_placeholder',
            'name'        => 'Search Bar Placeholder',
            'value'       => 'Search',
            'field'       => '{"name":"value","label":"Value","type":"text"}',
            'active'      => 1,
        ],
        [
            'key'         => 'homepage_intro_title',
            'name'        => 'Homepage Introduction Title',
            'value'       => 'Title',
            'field'       => '{"name":"value","label":"Value","type":"text"}',
            'active'      => 1,
        ],
        [
            'key'         => 'homepage_intro_content',
            'name'        => 'Homepage Introduction Content',
            'value'       => 'Hello',
            'field'       => '{"name":"value","label":"Value","type":"wysiwyg"}',
            'active'      => 1,
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('settings')->exists()) {
            DB::table('settings')->truncate();
        }

        foreach ($this->settings as $index => $setting) {
            $result = DB::table('settings')->insert($setting);

            if (!$result) {
                $this->command->info("Insert failed at record $index.");

                return;
            }
        }

        $this->command->info('Inserted '.count($this->settings).' records.');
    }
}
