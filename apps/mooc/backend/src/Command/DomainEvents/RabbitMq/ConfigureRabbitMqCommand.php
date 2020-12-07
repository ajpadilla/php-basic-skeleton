<?php


namespace CodelyTv\Apps\Mooc\Backend\Command\DomainEvents\RabbitMq;


use CodelyTv\Shared\Infrastructure\Bus\Event\RabbitMq\RabbitMqConfigurer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Traversable;

class ConfigureRabbitMqCommand extends Command
{
    protected static $defaultName = 'codelytv:domain-events:rabbitmq:configure';
    private $configure;
    private $exchangeName;
    private $subscribers;

    public function __construct(RabbitMqConfigurer $configure, string $exchangeName, Traversable $subscribers)
    {
        parent::__construct();
        $this->configure = $configure;
        $this->exchangeName = $exchangeName;
        $this->subscribers = $subscribers;
    }

    protected function configure()
    {
        $this->setDescription('Configure the RabbitMQ to allows publish & consume domain events');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
       $this->configure->configure($this->exchangeName, ...iterator_to_array($this->subscribers));
    }
}
