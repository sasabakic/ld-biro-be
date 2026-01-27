<?php

namespace App\GraphQL\Resolver;

use App\Repository\UserRepository;
use Overblog\GraphQLBundle\Definition\Resolver\QueryInterface;

class UserResolver implements QueryInterface
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        return $this->userRepository->findAll();
    }

    public function getSingleUser(int $id)
    {
        return $this->userRepository->find($id);
    }
}
