<?php

namespace App\GraphQL\Loader;

use App\Entity\Invoice;
use App\Repository\InvoiceRepository;
use GraphQL\Executor\Promise\Promise;
use GraphQL\Executor\Promise\PromiseAdapter;

class InvoicesLoader
{
    private PromiseAdapter $promiseAdapter;
    private InvoiceRepository $invoiceRepository;

    public function __construct(PromiseAdapter $promiseAdapter, InvoiceRepository $invoiceRepository)
    {
        $this->promiseAdapter = $promiseAdapter;
        $this->invoiceRepository = $invoiceRepository;
    }

    public function resolveByUser(array $userIDs): Promise
    {

        return $this->loadInvoicesBy('issuer', $userIDs, fn (Invoice $inv) => $inv->getIssuer()->getId());

    }

    public function loadInvoicesBy(string $key, array $IDs, callable $idExtractor): Promise
    {
        $invoices = $this->invoiceRepository->findBy([$key => $IDs]);

        $map = array_fill_keys($IDs, []);

        foreach ($invoices as $invoice) {
            $map[$idExtractor($invoice)][] = $invoice;
        }

        return $this->promiseAdapter->createFulfilled(array_values($map));
    }

    public function resolveByClient(array $clientIDs): Promise
    {
        return $this->loadInvoicesBy('client', $clientIDs, fn (Invoice $inv) => $inv->getClient()->getId());
    }


}
