<?php

namespace App\Interfaces;

interface InvoiceRepositoryInterface
{
    //get all invoices
    public function index();

    //get invoice by id
    public function show(int $id);

    //get invoice items
    public function getInvoiceItems(int $id);

    //store a new invoice
    public function store(array $invoiceDetail);

    //update an invoice
    public function update(array $invoiceDetail, int $invoiceId);

    //delete items in an invoice
    public function deleteItems(int $id);

    //delete an invoice
    public function destroy(int $id);


}
