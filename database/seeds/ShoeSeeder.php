<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShoeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('shoes')->insert([
            [
                'name' => 'Adidas Alphaedge 4D Reflective',
                'price' => 4700000,
                'description' => 'LIGHTWEIGHT RUNNING SHOES DESIGNED TO GIVE ATHLETES AN EDGE.',
                'image' => 'alphaedge-reflective.jpg'
            ],

            [
                'name' => 'Adidas Crazy BYW Pharrell Williams Shoes',
                'price' => 3000000,
                'description' => "OFF-COURT BASKETBALL SHOES ROOTED IN THE '90S.",
                'image' => 'crazy-pharrell.jpg'
            ],

            [
                'name' => 'Adidas Ultraboost 20',
                'price' => 1500000,
                'description' => 'ADAPTIVE RUNNING SHOES WITH STITCHED-IN MIDFOOT SUPPORT.',
                'image' => 'ultraboost-20.jpg'
            ],

            [
                'name' => 'aaa',
                'price' => 1250000,
                'description' => 'Adidas Running shoe.',
                'image' => 'aaa.jpg'
            ],

            [
                'name' => 'NMD',
                'price' => 1500000,
                'description' => 'Modern running shoe.',
                'image' => 'nmd.jpg'
            ],

            [
                'name' => 'Vans',
                'price' => 1500000,
                'description' => 'Classic shoe',
                'image' => 'vans.jpg'
            ],

            [
                'name' => 'Edge',
                'price' => 1700000,
                'description' => 'Adidas shoe.',
                'image' => 'edge.jpg'
            ]
        ]);
    }
}
