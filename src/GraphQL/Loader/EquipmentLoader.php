<?php

namespace App\GraphQL\Loader;

use App\Repository\EquipmentRepository;
use GraphQL\Executor\Promise\Promise;
use GraphQL\Executor\Promise\PromiseAdapter;

class EquipmentLoader
{
    private PromiseAdapter $promiseAdapter;
    private EquipmentRepository $equipmentRepository;

    public function __construct(PromiseAdapter $promiseAdapter, EquipmentRepository $equipmentRepository)
    {
        $this->promiseAdapter = $promiseAdapter;
        $this->equipmentRepository = $equipmentRepository;
    }

    public function resolveByUser(array $userIDs): Promise
    {
        $equipment = $this->equipmentRepository->findBy(['employee' => $userIDs]);

        $map = array_fill_keys($userIDs, []);

        foreach ($equipment as $item) {
            $map[$item->getEmployee()->getId()][] = $item;
        }

        return $this->promiseAdapter->createFulfilled(array_values($map));

    }
}
