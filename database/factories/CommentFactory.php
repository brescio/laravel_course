<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

$factory->define(App\Comment::class,function(Faker $faker){
return[
  'content' => $faker->text 
];
});
