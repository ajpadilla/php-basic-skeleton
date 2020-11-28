<?php
declare(strict_types = 1);

namespace CodelyTv\Mooc\Courses\Application\Create;

final class CreateCourseRequest
{
    /** @var string */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $duration;

    /**
     * CreateCourseRequest constructor.
     * @param string $id
     * @param string $name
     * @param string $duration
     */
    public function __construct(string $id, string $name, string $duration)
    {
        $this->id = $id;
        $this->name = $name;
        $this->duration = $duration;
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function duration(): string
    {
        return $this->duration;
    }
}
