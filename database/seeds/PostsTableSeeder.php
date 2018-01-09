<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Post;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Collection;

class PostsTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        /** @var Faker $faker */
        $faker = app(Faker::class);
        /** @var array $people */
        $users = factory(User::class, 5)
            ->create()
            ->map(function (User $user) {
                return $user->getKey();
            })
            ->all();

        $user = function () use ($faker, $users) {
            return $faker->randomElement($users);
        };

        factory(Post::class, 50)->create([
            'user_id' => $user,
        ]);
    }
}
