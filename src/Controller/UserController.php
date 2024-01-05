<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/users", name="list_users", methods={"GET"})
     */
    public function listUsers(EntityManagerInterface $entityManager)
    {
        $userRepository = $entityManager->getRepository(User::class);
        $users = $userRepository->findAll();

        $formattedUsers = [];
        foreach ($users as $user) {
            $formattedUsers[] = [
                'id' => $user->getId(),
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'phone' => $user->getPhone(),
            ];
        }

        return $this->render('users.html.twig', [
            'users' => $formattedUsers,
        ]);
    }
}
