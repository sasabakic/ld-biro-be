<?php

namespace App\GraphQL\Resolver;

use App\Repository\ClientRepository;
use Overblog\GraphQLBundle\Definition\Resolver\QueryInterface;

class ClientsResolver implements QueryInterface
{
    private ClientRepository $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function getAllClients(): array
    {
        return  $this->clientRepository->findAll();
    }
}
