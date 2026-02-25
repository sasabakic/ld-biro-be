<?php

namespace App\GraphQL\Loader;

use App\Repository\ClientRepository;
use GraphQL\Executor\Promise\Promise;
use GraphQL\Executor\Promise\PromiseAdapter;

class ClientsLoader
{
    private PromiseAdapter $promiseAdapter;
    private ClientRepository $clientRepository;

    public function __construct(PromiseAdapter $promiseAdapter, ClientRepository $clientRepository)
    {
        $this->promiseAdapter = $promiseAdapter;
        $this->clientRepository = $clientRepository;
    }

    public function resolveByUser(array $userIDs): Promise
    {
        $clients = $this->clientRepository->findBy(['dedicated_employee' => $userIDs]);

        $map = array_fill_keys($userIDs, []);
        foreach ($clients as $client) {
            $map[$client->getDedicatedEmployee()->getId()][] = $client;
        }

        return $this->promiseAdapter->createFulfilled(array_values($map));

    }

    public function resolveById(array $clientIds): Promise
    {
        $clients = $this->clientRepository->findBy(['id' => $clientIds]);

        $map = [];

        foreach ($clients as $client) {
            $map[$client->getId()] = $client;
        }

        $result = array_map(fn ($id) => $map[$id] ?? null, $clientIds);

        return $this->promiseAdapter->createFulfilled($result);
    }
}
