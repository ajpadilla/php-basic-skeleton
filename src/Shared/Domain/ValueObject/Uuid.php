<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Domain\ValueObject;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid
{
    /**
     * @var string
     */
    private $value;

    /**
     * Uuid constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->ensureIsValidUuid($value);
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * @param $id
     */
    private function ensureIsValidUuid($id): void
    {
        if (!RamseyUuid::isValid($id)){
            throw new InvalidArgumentException('<%s> does not allow the value <%s>.', static::class, $id);
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value();
    }
}
