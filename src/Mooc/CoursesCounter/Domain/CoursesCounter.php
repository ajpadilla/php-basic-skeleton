<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\CoursesCounter\Domain;


use CodelyTv\Mooc\Shared\Domain\Course\CourseId;
use CodelyTv\Shared\Domain\Aggregate\AggregateRoot;
use function Lambdish\Phunctional\reindex;

class CoursesCounter extends AggregateRoot
{
    private $total;
    private $existingCourses;
    private $id;

    public function __construct(CoursesCounterId $id, CoursesCounterTotal $total, CourseId ...$existingCourses)
    {
        $this->id = $id;
        $this->total = $total;
        $this->existingCourses = $existingCourses;
    }

    public static function initialize(CoursesCounterId $id): self
    {
        return new self($id, CoursesCounterTotal::initialize());
    }

    /**
     * @return CoursesCounterId
     */
    public function id(): CoursesCounterId
    {
        return $this->id;
    }

    /**
     * @return CoursesCounterTotal
     */
    public function total(): CoursesCounterTotal
    {
        return $this->total;
    }

    /**
     * @return CourseId[]
     */
    public function existingCourses(): array
    {
        return $this->existingCourses;
    }

    public function increment(CourseId $courseId): void
    {
        $this->total = $this->total->increment();
        $this->existingCourses[] = $courseId;

        $this->record(new CoursesCounterIncrementedDomainEvent($this->id()->value(), $this->total()->value()));
    }

    public function hasIncremented(CourseId $courseId): bool
    {
        $indexedCourses = reindex($this->valueExtractor(), $this->existingCourses());

        return isset($indexedCourses[$courseId->value()]);
    }

    private function valueExtractor(): callable
    {
        return static function (CourseId $id) {
            return $id->value();
        };
    }

}
