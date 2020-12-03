<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Infrastructure\Logger;

use CodelyTv\Shared\Domain\Logger;
use Psr\Log\LoggerInterface;


final class MonologLogger
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function info(string $message, array $context = []): void
    {
        $this->logger->info($message, $context);
    }

}
