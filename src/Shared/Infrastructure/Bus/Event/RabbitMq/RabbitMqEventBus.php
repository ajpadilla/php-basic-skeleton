<?php


namespace CodelyTv\Shared\Infrastructure\Bus\Event\RabbitMq;


use AMQPException;
use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;
use CodelyTv\Shared\Domain\Bus\Event\EventBus;
use CodelyTv\Shared\Infrastructure\Bus\Event\DomainEventJsonSerializer;
use function Lambdish\Phunctional\each;

class RabbitMqEventBus implements EventBus
{
    private $connection;
    private $exchangeName;
    private $failoverPublisher;

    public function __construct(RabbitMqConnection $connection, string $exchangeName)
    {
        $this->connection = $connection;
        $this->exchangeName = $exchangeName;
    }

    public function publish(DomainEvent ...$events): void
    {
        each($this->publisher(), $events);
    }

    private function publisher():callable
    {
        return function (DomainEvent $event){
            try {
                $this->publishEvent($event);
            }  catch (AMQPException $error){

            }
        };
    }

    private function publishEvent(DomainEvent $event): void
    {
        $body           = DomainEventJsonSerializer::serialize($event);
        $routingKey     = $event::eventName();
        $messageId      = $event->eventId();

        $this->connection->exchange($this->exchangeName)->publish(
            $body,
            $routingKey,
            AMQP_NOPARAM,
            [
                'message_id'        => $messageId,
                'content-type'      => 'application/json',
                'content_encoding'  => 'utf-8'
            ]
        );
    }
}
