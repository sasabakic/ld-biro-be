<?php

namespace App\GraphQL\Loader;

use App\Repository\UserRepository;
use GraphQL\Executor\Promise\Promise;
use GraphQL\Executor\Promise\PromiseAdapter;

class UsersLoader
{
    private UserRepository $userRepository;
    private PromiseAdapter $promiseAdapter;

    public function __construct(UserRepository $userRepository, PromiseAdapter $promiseAdapter)
    {
        $this->userRepository = $userRepository;
        $this->promiseAdapter = $promiseAdapter;
    }

    public function resolveById(array $userIDs): Promise
    {
        $users = $this->userRepository->findBy(['id' => $userIDs]);

        $map = [];

        foreach ($users as $user) {
            $map[$user->getId()] = $user;
        }

        $result = array_map(fn ($id) => $map[$id] ?? null, $userIDs);

        return $this->promiseAdapter->createFulfilled($result);
    }
}
