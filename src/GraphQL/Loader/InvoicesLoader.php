<?php

namespace App\GraphQL\Loader;

use App\Entity\Invoice;
use App\Repository\InvoiceRepository;
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

    public function userInvoicesLoader(array $userIDs)
    {

        return $this->loadInvoicesBy('issuer', $userIDs, fn (Invoice $inv) => $inv->getIssuer()->getId());

    }

    public function loadInvoicesBy(string $key, array $IDs, callable $idExtractor)
    {
        $invoices = $this->invoiceRepository->findBy([$key => $IDs]);

        $userMap = array_fill_keys($IDs, []);

        foreach ($invoices as $invoice) {
            $userMap[$idExtractor($invoice)][] = $invoice;
        }

        return $this->promiseAdapter->createFulfilled(array_values($userMap));
    }

    public function clientInvoicesLoader(array $clientIDs)
    {
        $this->loadInvoicesBy('client', $clientIDs, fn (Invoice $inv) => $inv->getClient()->getId());
    }


}
