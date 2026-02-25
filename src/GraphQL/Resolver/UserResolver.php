<?php

namespace App\GraphQL\Resolver;

use App\Entity\User;
use App\Repository\UserRepository;
use Overblog\GraphQLBundle\Definition\Resolver\QueryInterface;
use Overblog\GraphQLBundle\Error\UserError;

class UserResolver implements QueryInterface
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers(): array
    {
        return $this->userRepository->findAll();
    }

    public function getSingleUser(int $id): User
    {
        $user = $this->userRepository->find($id);

        if (!$user) {
            throw  new UserError('User with id: '.$id.' not found.');
        }
        return $user;
    }
}
