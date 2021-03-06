<?php

declare (strict_types = 1);

namespace Dumplie\Metadata\Schema;

use Dumplie\Metadata\Exception\InvalidTypeException;

final class Type
{
    const TYPE_ASSOCIATION = 'association';
    const TYPE_TEXT = 'text';
    const TYPE_BOOL = 'bool';
    const TYPE_INTEGER = 'integer';
    const TYPE_FLOAT = 'float';
    const TYPE_DECIMAL = 'decimal';
    const TYPE_DATETIME = 'datetime';
    const TYPE_MAP = 'map';

    private $allowed = [
        self::TYPE_ASSOCIATION,
        self::TYPE_TEXT,
        self::TYPE_BOOL,
        self::TYPE_INTEGER,
        self::TYPE_FLOAT,
        self::TYPE_DECIMAL,
        self::TYPE_DATETIME,
        self::TYPE_MAP,
    ];

    private $type;

    /**
     * Type constructor.
     *
     * @param string $type
     *
     * @throws InvalidTypeException
     */
    public function __construct(string $type)
    {
        if (!in_array($type, $this->allowed, true)) {
            throw InvalidTypeException::invalidType($type, $this->allowed);
        }

        $this->type = $type;
    }

    /**
     * @return Type
     */
    public static function association(): Type
    {
        return new static(static::TYPE_ASSOCIATION);
    }

    /**
     * @return Type
     */
    public static function text(): Type
    {
        return new static(static::TYPE_TEXT);
    }

    /**
     * @return Type
     */
    public static function bool(): Type
    {
        return new static(static::TYPE_BOOL);
    }

    /**
     * @return Type
     */
    public static function integer(): Type
    {
        return new static(static::TYPE_INTEGER);
    }

    /**
     * @return Type
     */
    public static function float(): Type
    {
        return new static(static::TYPE_FLOAT);
    }

    /**
     * @return Type
     */
    public static function decimal(): Type
    {
        return new static(static::TYPE_DECIMAL);
    }

    /**
     * @return Type
     */
    public static function dateTime(): Type
    {
        return new static(static::TYPE_DATETIME);
    }

    /**
     * @return Type
     */
    public static function map(): Type
    {
        return new static(static::TYPE_MAP);
    }

    /**
     * @param Type $type
     *
     * @return bool
     */
    public function isEqual(Type $type): bool
    {
        return $this->type == $type->type;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->type;
    }
}
