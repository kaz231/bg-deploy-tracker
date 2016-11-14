<?php
namespace Action\Model;

use Assert\Assertion;

/**
 * Class ActionName
 * @package Action\Model
 */
class ActionName
{
    const MAX_LENGTH = 128;

    /** @var string */
    private $value;

    /**
     * ActionName constructor.
     * @param string $value
     */
    public function __construct($value)
    {
        Assertion::string($value);
        Assertion::notEmpty($value);
        Assertion::maxLength($value, self::MAX_LENGTH);

        $this->value = $value;
    }

    /**
     * @param string $value
     * @return ActionName
     */
    public static function of($value)
    {
        return new self($value);
    }

    /**
     * @inheritdoc
     */
    function __toString()
    {
        return $this->value;
    }
}
