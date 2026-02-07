<?php

namespace App\GraphQL\Loader;

use App\Repository\EquipmentRepository;
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

    public function all(array $userIDs)
    {
        //        $qb = $this->equipmentRepository->createQueryBuilder('e');
        //        $qb->add('where', $qb->expr()->in('e.id', ':ids'));
        //        $qb->setParameter('ids', $userIDs);
        //        $equipment = $qb->getQuery()->getResult();
        //
        //        return $this->promiseAdapter->all($equipment);
        $equipment = $this->equipmentRepository->findBy(['employee' => $userIDs]);

        $userMap = array_fill_keys($userIDs, []);

        foreach ($equipment as $item) {
            $userMap[$item->getEmployee()->getId()][] = $item;
        }

        return $this->promiseAdapter->createFulfilled(array_values($userMap));

    }
}
