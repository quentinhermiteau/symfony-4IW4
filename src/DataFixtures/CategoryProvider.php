<?php

namespace App\DataFixtures;

use Faker\Provider\Base as BaseProvider;

final class CategoryProvider extends BaseProvider {
    const CATEGORY_NAME = [
        'Santé',
        'Économie',
        'Écologie',
        'Sport'
    ];

    public static function categoryName() {
        return self::randomElement(self::CATEGORY_NAME);
    }
}