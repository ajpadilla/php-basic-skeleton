<?php
declare(strict_types = 1);

namespace CodelyTv\Mooc\CoursesCounter\Application\Find;


final class coursesCounterResponse
{
    private $total;

    public function __construct(int $total)
    {
        $this->total = $total;
    }

    public function total()
    {
        return $this->total;
    }
}
