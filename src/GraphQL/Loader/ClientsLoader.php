<?php

namespace App\GraphQL\Loader;

use App\Repository\ClientRepository;
use GraphQL\Executor\Promise\PromiseAdapter;
use Psr\Log\LoggerInterface;

class ClientsLoader
{
    private PromiseAdapter $promiseAdapter;
    private ClientRepository $clientRepository;
    private LoggerInterface $logger;

    public function __construct(PromiseAdapter $promiseAdapter, ClientRepository $clientRepository, LoggerInterface $logger)
    {
        $this->promiseAdapter = $promiseAdapter;
        $this->clientRepository = $clientRepository;
        $this->logger = $logger;
    }

    public function all(array $userIDs)
    {
        $clients = $this->clientRepository->findBy(['dedicated_employee' => $userIDs]);

        $userMap = array_fill_keys($userIDs, []);
        foreach ($clients as $client) {
            $userMap[$client->getDedicatedEmployee()->getId()][] = $client;
        }

        return $this->promiseAdapter->createFulfilled(array_values($userMap));

    }
}
