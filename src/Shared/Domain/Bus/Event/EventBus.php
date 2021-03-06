<?php


namespace CodelyTv\Shared\Domain\Bus\Event;


interface EventBus
{
    public function publish(DomainEvent ...$events): void;
}
