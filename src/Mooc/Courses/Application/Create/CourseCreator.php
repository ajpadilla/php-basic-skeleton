<?php


namespace CodelyTv\Mooc\Courses\Application\Create;


use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Mooc\Courses\Domain\CourseDuration;
use CodelyTv\Mooc\Courses\Domain\CourseName;
use CodelyTv\Mooc\Courses\Domain\CourseRepository;
use CodelyTv\Mooc\Shared\Domain\Course\CourseId;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventPublisher;

class CourseCreator
{
    /** @var CourseRepository */
    private $repository;

    /** @var DomainEventPublisher */
    private $publisher;

    /**
     * CourseCreator constructor.
     * @param CourseRepository $repository
     * @param DomainEventPublisher $publisher
     */
    public function __construct(CourseRepository $repository, DomainEventPublisher $publisher)
    {
        $this->repository = $repository;
        $this->publisher = $publisher;
    }

    public function __invoke(CreateCourseRequest $request)
    {
        $id = new CourseId($request->id());
        $name = new CourseName($request->name());
        $duration = new CourseDuration($request->duration());

        $course = Course::crate($id, $name, $duration);

        $this->repository->save($course);
        $this->publisher->publish(...$course->pullDomainEvents());
    }

}
