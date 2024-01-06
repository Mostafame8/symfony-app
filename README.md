# Symfony RabbitMQ Consumer

This Symfony application serves as a consumer for processing user information from a RabbitMQ queue.

## Prerequisites

Before you begin, make sure you have the following installed on your machine:

- [PHP version 7.4.33](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- [RabbitMQ Server](https://www.rabbitmq.com/)
- [Symfony CLI](https://symfony.com/download)

## Getting Started

1. **Clone this repository:**

   ```bash
   git clone https://github.com/Mostafame8/symfony-app.git

   ```

2. **Install dependencies:**

   ```bash
   composer install

   ```

3. **Configure RabbitMQ:**

- Make sure your RabbitMQ server is running.
- Update the RABBITMQ_URL variable in the .env file if your RabbitMQ server is not running on amqp://guest:guest@localhost:5672/.

4. **Run Symfony application:**

   ```bash
   symfony serve

   ```

5. **Run Comsumer:**

   ```bash
   php bin/console rabbitmq:consumer user_consumer

   ```

6. **Monitoring:**

- You can monitor the RabbitMQ queue status, including messages in progress and processed messages, through the RabbitMQ Management Plugin.
- Access the RabbitMQ Management UI at http://localhost:15672/ (default credentials: guest/guest).
