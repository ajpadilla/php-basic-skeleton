<?php


namespace CodelyTv\Mooc\Courses\Domain;


use CodelyTv\Mooc\Shared\Domain\Course\CourseId;

interface CourseRepository
{
    public function save(Course $course);

    public function search(CourseId $id): ?Course;
}
