<?php


namespace CodelyTv\Tests\Mooc\Courses\Application\Domain;


use CodelyTv\Mooc\Courses\Domain\CourseDuration;
use CodelyTv\Tests\Shared\Domain\IntegerMother;
use CodelyTv\Tests\Shared\Domain\RandomElementPicker;
use phpDocumentor\Reflection\Types\Integer;

final class CourseDurationMother
{
    public static function create(string $value): CourseDuration
    {
        return new CourseDuration($value);
    }

    public static function random(): CourseDuration
    {
        return self::create(
            sprintf(
                '%s %s',
                IntegerMother::random(),
                RandomElementPicker::from('months', 'years', 'days', 'hours', 'minutes', 'seconds')
            )
        );
    }
}
