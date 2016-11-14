<?php
namespace Action\Model;

use Assert\Assertion;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class ActionId
 * @package Action\Model
 */
class ActionId
{
    /** @var UuidInterface */
    private $value;

    /**
     * ActionId constructor.
     * @param UuidInterface $value
     */
    public function __construct(UuidInterface $value)
    {
        $this->value = $value;
    }

    /**
     * @return static
     */
    public static function generate()
    {
        return new static(Uuid::uuid4());
    }

    /**
     * @param UuidInterface $uuid
     * @return static
     */
    public static function of(UuidInterface $uuid)
    {
        return new static($uuid);
    }

    /**
     * @param string $string
     * @return static
     */
    public static function fromString($string)
    {
        return new static(Uuid::fromString($string));
    }

    /**
     * @param ActionId $actionId
     * @return bool
     */
    public function equals(ActionId $actionId)
    {
        if (!$actionId instanceof static) {
            return false;
        }

        return $this->value->equals($actionId->value);
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->value->toString();
    }
    /**
     * @return UuidInterface
     */
    public function raw()
    {
        return $this->value;
    }
}
