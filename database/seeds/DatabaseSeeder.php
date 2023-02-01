<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Cicles::class, 20)->create();
        factory(\App\Articles::class, 50)->create();
        factory(\App\User::class)->create([ 'name' => 'admin', 'email'=> 'admin@admin.com', 'password'=> bcrypt('12345678'), 'actived'=> 1,'email_verified_at'=> now(), 'type'=> 'A']);
        factory(\App\User::class, 10)->create();
        factory(\App\Offers::class, 50)->create();
        factory(\App\Requirements::class, 20)->create();
        factory(\App\Applied::class, 50)->create();
    }
}
