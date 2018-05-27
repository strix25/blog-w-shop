<?php

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            ['user_id' => 1, 'post_id' => 1, 'content' => "Comm one content"],
            ['user_id' => 1, 'post_id' => 2, 'content' => "Comm two content"],
            ['user_id' => 1, 'post_id' => 3, 'content' => "Comm three content"]
        ]);
    }
}
