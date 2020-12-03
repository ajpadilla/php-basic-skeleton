<?php


namespace CodelyTv\Shared\Infrastructure\Bus\Command;
use CodelyTv\Shared\Domain\Bus\Command\Command;
use RuntimeException;
use Throwable;

class CommandNotRegisteredError extends RuntimeException
{
    public function __construct(Command $command)
    {
      $commandClass = get_class($command);
      parent::__construct("The command <$commandClass> hasn't a command handler associated");
    }
}
