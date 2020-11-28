<?php


namespace CodelyTv\Mooc\Courses\Infrastructure;


use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Mooc\Courses\Domain\CourseId;
use CodelyTv\Mooc\Courses\Domain\CourseRepository;

class FileCourseRepository implements CourseRepository
{

    private const FILE_PATH = __DIR__ . '/courses';

    public function save(Course $course)
    {
        file_put_contents($this->fileName($course->id()->value()), serialize($course));
    }

    public function search(CourseId $id): ?Course
    {
        return  file_exists($this->fileName($id->value()))
            ? unserialize(file_get_contents($this->fileName($id->value())))
            : null;
    }

    private function fileName(string $id): string {
        return sprintf("%s.%s.repo", self::FILE_PATH, $id);
    }
}
