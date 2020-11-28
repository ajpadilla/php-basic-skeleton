<?php

declare(strict_types = 1);

namespace CodelyTv\Tests\Shared\Domain;

use Faker\Factory;
use Faker\Generator;

class MotherCreator
{
   private static $faker;

   public static function random(): Generator
   {
       return  self::$faker = self::$faker ?: Factory::create();
   }
}
