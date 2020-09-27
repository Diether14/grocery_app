<?php

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Item::class, 10)->create()->each(function ($item) {
            $item->categories()->save(factory(App\Models\Category::class)->make());
        });
    }
}
