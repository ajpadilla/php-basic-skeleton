<?php

declare(strict_types = 1);

namespace CodelyTv\Apps\Mooc\Backend\Controller\Courses;

use CodelyTv\Mooc\Courses\Application\Create\CourseCreator;
use CodelyTv\Mooc\Courses\Application\Create\CreateCourseCommand;
use CodelyTv\Shared\Domain\Bus\Command\CommandBus;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Psr\Log\LoggerInterface;


final class CoursesPutController
{
    private $bus;

    public function __construct(CommandBus $bus, LoggerInterface $logger)
    {
        $this->bus = $bus;
        $logger->info('I just got the logger');
    }

    public function __invoke(string $id, Request $request)
    {
        $this->bus->dispatch(
            new CreateCourseCommand(
                $id,
                $request->request->get('name'),
                $request->request->get('duration')
            )
        );

        return new Response('', Response::HTTP_CREATED);
    }
}

