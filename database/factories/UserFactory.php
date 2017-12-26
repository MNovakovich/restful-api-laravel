<?php

use App\User;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Transaction;

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'verified'=>$verified = $faker->randomElement([User::VERIFIED_USER, User::UNVERIFIED_USER ]),
        'verification_token'=>$verified == User::VERIFIED_USER ? null : User::generateVerificationCode(),
        'admin'=>$ferified =$faker->randomElement([User::ADMIN_USER, User::REGULAR_USER])
    ];
});

$factory->define(App\Models\Category::class, function (Faker $faker) {
    
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1)
        
    ];
});

$factory->define(App\Models\Product::class, function (Faker $faker) {
    
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1),
        'quantity' => $faker->numberBetween(1,10),
        'status' => $faker->randomElement([Product::AVAILABLE_PRODUCT, Product::UNAVAILABLE_PRODUCT ]),
        'image' => $faker->randomElement(['1.png','2.png','3.png','4.png']),
        'seller_id' => User::all()->random()->id,
        //User::inRandomOrder()->first()->id
        
    ];
});

$factory->define(Transaction::class, function (Faker $faker) {
    $seller = Seller::has('products')->get()->random();
    $buyer = User::all()->except($seller->id)->random();
    return [
        'quantity' => $faker->numberBetween(1,3),
        'buyer_id' => $buyer->id,
        'product_id' => $seller->products->random()->id
        
    ];
});