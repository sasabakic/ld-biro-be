<?php

namespace App\GraphQL\Loader;

use App\Repository\SalaryRepository;
use GraphQL\Executor\Promise\Promise;
use GraphQL\Executor\Promise\PromiseAdapter;

class SalariesLoader
{
    private PromiseAdapter $promiseAdapter;

    private SalaryRepository $salaryRepository;

    public function __construct(PromiseAdapter $promiseAdapter, SalaryRepository $salaryRepository)
    {
        $this->promiseAdapter = $promiseAdapter;
        $this->salaryRepository = $salaryRepository;
    }

    public function resolveByUser(array $userIDs):Promise
    {
        $salaries = $this->salaryRepository->findBy(["user" => $userIDs]);

        $map = array_fill_keys($userIDs, []);

        foreach ($salaries as $salary) {
            $map[$salary->getUser()->getId()][] = $salary;
        }

        return $this->promiseAdapter->createFulfilled(array_values($map));
    }
}
