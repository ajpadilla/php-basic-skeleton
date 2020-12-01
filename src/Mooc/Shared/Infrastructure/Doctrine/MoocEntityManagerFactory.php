<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Shared\Infrastructure\Doctrine;

use CodelyTv\Shared\Infrastructure\Doctrine\DoctrineEntityManagerFactory;
use Doctrine\ORM\EntityManagerInterface;

final class MoocEntityManagerFactory
{
    private const SCHEMA_PATH = __DIR__ . '/../../../../../databases/mooc.sql';

    public static function create(array $parameters, string $environment): EntityManagerInterface
    {
        $isDevMode = 'prod' !== $environment;

        $prefixes               = DoctrinePrefixesSearcher::inPath(__DIR__ . '/../../../../Mooc', 'CodelyTv\Mooc');
        $dbalCustomTypesClasses = DbalTypesSearcher::inPath(__DIR__ . '/../../../../Mooc', 'Mooc');

        //print_r($parameters);

        return DoctrineEntityManagerFactory::create(
            $parameters,
            $prefixes,
            $isDevMode,
            self::SCHEMA_PATH,
            $dbalCustomTypesClasses
        );
    }
}
