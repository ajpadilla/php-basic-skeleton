<?php
declare(strict_types = 1);

namespace CodelyTv\Apps\Mooc\Backend\Controller\CoursesCounter;


use CodelyTv\Mooc\CoursesCounter\Application\Find\coursesCounterResponse;
use CodelyTv\Mooc\CoursesCounter\Application\Find\FindCoursesCounterQuery;
use CodelyTv\Shared\Domain\Bus\Query\QueryBus;
use Symfony\Component\HttpFoundation\JsonResponse;

class CoursesCounterGetController
{
    private $queryBus;

    public function __construct(QueryBus $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function __invoke()
    {
        /** @var coursesCounterResponse $response */
        $response = $this->queryBus->ask(new FindCoursesCounterQuery());

        return new JsonResponse([
            'total' => $response->total()
        ]);
    }
}
