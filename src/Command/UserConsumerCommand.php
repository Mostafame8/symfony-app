<?php

// src/Command/UserConsumerCommand.php

namespace App\Command;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UserConsumerCommand extends Command
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct();

        $this->container = $container;
    }

    protected function configure()
    {
        $this->setName('rabbitmq:user-consume')
            ->setDescription('Consume user messages from RabbitMQ');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $connection = $this->container->get('old_sound_rabbit_mq.default_connection');
        $channel = $connection->channel();

        $channel->basic_consume('userQueue', '', false, true, false, false, [$this, 'consume']);

        while ($channel->is_consuming()) {
            $channel->wait();
        }
    }

    public function consume($message)
    {
        $consumerService = $this->container->get('user_consumer_service');
        $consumerService->consume($message);
    }
}
