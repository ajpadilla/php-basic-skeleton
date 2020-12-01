<?php


namespace CodelyTv\Mooc\CoursesCounter\Application\Find;


use CodelyTv\Mooc\CoursesCounter\Domain\CoursesCounterNotExist;
use CodelyTv\Mooc\CoursesCounter\Domain\CoursesCounterRepository;

final class CoursesCounterFinder
{
    private $repository;

    public function __construct(CoursesCounterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): coursesCounterResponse
    {
        $counter = $this->repository->search();

        if (null == $counter){
            throw new CoursesCounterNotExist();
        }

        return new coursesCounterResponse($counter->total()->value());
    }
}
