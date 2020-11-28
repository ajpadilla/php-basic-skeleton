<?php


namespace CodelyTv\Mooc\Courses\Domain;


final class Course
{
    /**
     * @var CourseId
     */
    private $id;

    /**
     * @var CourseName
     */
    private $name;

    /**
     * @var CourseDuration
     */
    private $duration;

    /**
     * Course constructor.
     * @param CourseId $id
     * @param CourseName $name
     * @param CourseDuration $duration
     */
    public function __construct(CourseId $id, CourseName $name, CourseDuration $duration)
    {
        $this->id = $id;
        $this->name = $name;
        $this->duration = $duration;
    }

    /**
     * @return CourseId
     */
    public function id(): CourseId
    {
        return $this->id;
    }

    /**
     * @return CourseName
     */
    public function name(): CourseName
    {
        return $this->name;
    }

    /**
     * @return CourseDuration
     */
    public function duration(): CourseDuration
    {
        return $this->duration;
    }
}
