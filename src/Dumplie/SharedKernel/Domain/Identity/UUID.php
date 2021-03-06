<?php

declare (strict_types = 1);

namespace Dumplie\SharedKernel\Domain\Identity;

use Dumplie\SharedKernel\Domain\Exception\InvalidUUIDFormatException;
use Ramsey\Uuid\Uuid as BaseUUID;

class UUID
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @param string $value
     *
     * @throws InvalidUUIDFormatException
     */
    public function __construct(string $value)
    {
        $pattern = '/'.BaseUUID::VALID_PATTERN.'/';

        if (!preg_match($pattern, (string) $value)) {
            throw new InvalidUUIDFormatException();
        }

        $this->id = (string) $value;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return (string) $this->id;
    }

    /**
     * @param UUID $id
     *
     * @return bool
     */
    public function isEqual(UUID $id) : bool
    {
        return $this->id === $id->id;
    }
}
