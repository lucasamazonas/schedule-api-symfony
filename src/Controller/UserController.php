<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    public function __construct(
        private UserRepository $userRepository
    )
    {
    }

    #[Route(path: 'users', name: 'app_list_user', methods: ['GET'])]
    public function listUsers(): Response
    {
        return $this->json($this->userRepository->findAll());
    }

    #[Route(path: 'users', name: 'app_add_user', methods: ['POST'])]
    public function addUser(Request $request): Response
    {
        $newUser = new User($request->get('name'));
        $this->userRepository->save($newUser, true);


        return $this->json($newUser);
    }
}
