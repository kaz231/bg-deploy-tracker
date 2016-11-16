<?php
namespace Action\Model;

use TrackerBundle\Message\Bus\Event\RecordsDomainEvents;
use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Action
 * @package Action\Model
 * @ORM\Entity(repositoryClass="Action\Infrastructure\Persistence\ORMActionRepository")
 * @ORM\Table(
 *     name="actions",
 *     indexes={
 *         @ORM\Index(columns={"created_at"})
 *     }
 * )
 */
class Action
{
    use RecordsDomainEvents;

    /**
     * @ORM\Id()
     * @ORM\Column(type="guid")
     * @var string
     */
    private $actionId;

    /**
     * @ORM\Column(type="string", length=128)
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=128)
     * @var string
     */
    private $value;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     * @var string
     */
    private $tag;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $createdAt;

    /**
     * Action constructor.
     * @param ActionId $actionId
     * @param ActionName $name
     * @param ActionValue $value
     * @param string $tag
     */
    private function __construct(ActionId $actionId, ActionName $name, ActionValue $value, $tag = null)
    {
        $this->actionId = $actionId->raw();
        $this->name = (string) $name;
        $this->value = (string) $value;
        $this->createdAt = Carbon::now();
        $this->tag = $tag;
    }

    /**
     * @param ActionName $name
     * @param ActionValue $value
     * @return Action
     */
    public static function register(ActionName $name, ActionValue $value)
    {
        $self = new self(
            ActionId::generate(),
            $name,
            $value
        );

        $self->record(new ActionWasRecorded($self->id(), $self->name(), $self->value(), $self->createdAt()));

        return $self;
    }

    /**
     * @return ActionId
     */
    public function id()
    {
        return ActionId::fromString($this->actionId);
    }

    /**
     * @return ActionName
     */
    public function name()
    {
        return ActionName::of($this->name);
    }

    /**
     * @return ActionValue
     */
    public function value()
    {
        return ActionValue::of($this->value);
    }

    /**
     * @return Carbon
     */
    public function createdAt()
    {
        return Carbon::createFromTimestamp($this->createdAt->getTimestamp());
    }
}
