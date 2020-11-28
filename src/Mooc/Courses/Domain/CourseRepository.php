<?php


namespace CodelyTv\Mooc\Courses\Domain;


interface CourseRepository
{
    public function save(Course $course);

    public function search(CourseId $id): ?Course;
}
