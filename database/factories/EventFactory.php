<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Event;
    use Carbon\Carbon;
    use Faker\Generator as Faker;

$factory->define(Event::class, function (Faker $faker) {
    
    
    $startOn = Carbon::createFromTimeStamp($faker->dateTimeBetween('-50 weeks', '+50 weeks')->getTimestamp())->format('Y-m-d');
    $endOn = Carbon::createFromFormat('Y-m-d', $startOn)->addDays(rand(1,25))->format('Y-m-d');

//    dd($startOn, $endOn);
    
    return [
        'status' => rand(1,2),
        'language' => $faker->randomElement(['bg', 'en']),
        'start_on' => $startOn,
        'end_on' => $endOn,
        'category_id' => \App\Category::all()->random()->id,
        'title' => $faker->sentence(5),
        'body' => $faker->realText(5000)
    ];
});
