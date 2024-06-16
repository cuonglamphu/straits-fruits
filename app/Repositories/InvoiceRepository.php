<?php

namespace App\Repositories;

use App\Interfaces\InvoiceRepositoryInterface;
use App\Models\FruitInvoice;
use App\Models\Invoice;
class InvoiceRepository implements InvoiceRepositoryInterface
{

    public function index()
    {
        return Invoice::all();
    }

    public function show(int $id)
    {
        return Invoice::findOrFail($id);
    }

    public function store(array $invoiceDetail)
    {
        $invoice = Invoice::create([
            'Customer_Name' => $invoiceDetail['Customer_Name'],
            'Total' => $invoiceDetail['Total'],
        ]);

        foreach ($invoiceDetail['fruits'] as $fruit) {
            FruitInvoice::create([
                'Invoice_ID' => $invoice->id,
                'Fruit_ID' => $fruit['Fruit_ID'],
                'Quantity' => $fruit['Quantity'],
                'Amount' => $fruit['Amount'],
            ]);
        }
        return $invoice;
    }

    public function update( array $invoiceDetail, int $invoiceId) : void
    {
        $invoice = Invoice::findOrFail($invoiceId);
        $invoice->update([
            'Customer_Name' => $invoiceDetail['Customer_Name'],
            'Total' => $invoiceDetail['Total'],
        ]);

        FruitInvoice::where('Invoice_ID', $invoiceId)->delete();
        foreach ($invoiceDetail['fruits'] as $fruit) {
            FruitInvoice::create([
                'Invoice_ID' => $invoice->id,
                'Fruit_ID' => $fruit['Fruit_ID'],
                'Quantity' => $fruit['Quantity'],
                'Amount' => $fruit['Amount'],
            ]);
        }
    }

    public function getInvoiceItems(int $id) : ?array
    {
        $invoiceDetails = FruitInvoice::where('invoice_id', $id)
            ->join('fruits', 'fruit_invoice.fruit_id', '=', 'fruits.id')
            ->select('fruits.Fruit_Name', 'fruits.Price', 'fruit_invoice.Quantity', 'fruit_invoice.Amount')
            ->get();

        if ($invoiceDetails->isEmpty()) {
            return null;
        }

        $total = $invoiceDetails->sum(function ($item) {
            return $item->Quantity * $item->Price;
        });

        return [
            'invoice_details' => $invoiceDetails,
            'total' => $total
        ];
    }

    public function deleteItems(int $id): void
    {
        //delete all fruits associated with the invoice
        FruitInvoice::where('Invoice_ID', $id)->delete();
    }

    public function destroy(int $id) : void
    {
        //delete the invoice
        Invoice::destroy($id);
    }
}
