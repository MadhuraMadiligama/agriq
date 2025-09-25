<?php
// database/seeders/CategorySeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'වගා ගැටලු',
            'පළිබෝධ හානි',
            'පස සහ පොහොර',
            'අස්වනු තාක්ෂණය',
            'වෙළඳපොළ තොරතුරු',
            'ජල කළමනාකරණය',
            'සාමාන්‍ය ගැටලු',
        ];

        foreach ($categories as $categoryName) {
            // අපි name එක විතරයි දෙන්නේ. slug එක Model එකෙන් auto generate වෙනවා.
            Category::create(['name' => $categoryName]);
        }
    }
}
