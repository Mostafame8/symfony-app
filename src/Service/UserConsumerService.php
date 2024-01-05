<?php


namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use PhpAmqpLib\Message\AMQPMessage;

class UserConsumerService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function execute(AMQPMessage $message)
    {
        $body = $message->getBody();
        $userData = json_decode($body, true);

        echo "User received from RabbitMQ: " . print_r($userData, true) . PHP_EOL;

        $user = new User();
        $user->setName($userData['name']); 
        $user->setEmail($userData['email']);

        if(isset($userData['phone'])){
            $user->setPhone($userData['phone']);
        } 

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        echo 'User added to database: ' . printf($user->getId()) . PHP_EOL;
    }
}
