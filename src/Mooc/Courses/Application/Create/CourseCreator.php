<?php


namespace CodelyTv\Mooc\Courses\Application\Create;


use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Mooc\Courses\Domain\CourseDuration;
use CodelyTv\Mooc\Courses\Domain\CourseName;
use CodelyTv\Mooc\Courses\Domain\CourseRepository;
use CodelyTv\Mooc\Shared\Domain\Course\CourseId;
use CodelyTv\Shared\Domain\Bus\Event\EventBus;
use  CodelyTv\Shared\Domain\Logger;
use CodelyTv\Shared\Infrastructure\Logger\MonologLogger;


class CourseCreator
{
    /** @var CourseRepository */
    private $repository;

    /** @var EventBus */
    private $bus;

    private $logger;

    /**
     * CourseCreator constructor.
     * @param CourseRepository $repository
     * @param EventBus $bus
     */
    public function __construct(CourseRepository $repository, EventBus $bus)
    {
        $this->repository = $repository;
        $this->bus = $bus;
    }

    public function __invoke(CourseId $id, CourseName $name, CourseDuration $duration)
    {
       $course = Course::create($id, $name, $duration);

       $this->repository->save($course);
        $this->bus->publish(...$course->pullDomainEvents());
    }

}
