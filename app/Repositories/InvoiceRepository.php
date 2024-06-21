<?php

namespace App\Repositories;

use FFI\Exception;
use Illuminate\Support\Facades\DB;
use App\Interfaces\InvoiceRepositoryInterface;
use App\Models\Category;
use App\Models\FruitInvoice;
use App\Models\Invoice;
use Carbon\Carbon;

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
        try {
            DB::beginTransaction();

            $invoice = Invoice::create([
                'Customer_Name' => $invoiceDetail['Customer_Name'],
                'Total' => $invoiceDetail['Total']
            ]);

            if ($invoice->id != null) {
                foreach ($invoiceDetail['items'] as $item) {
                    FruitInvoice::create([
                        'Invoice_ID' => $invoice->id,
                        'Fruit_ID' => $item['Fruit_ID'],
                        'Quantity' => $item['Quantity'],
                        'Amount' => $item['Amount']
                    ]);
                }

                DB::commit();

                return $invoice;
            } else {
                DB::rollBack();
                throw new Exception('Invoice creation failed.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    public function update(array $invoiceDetail, int $invoiceId)
    {
        try {
            DB::beginTransaction();

            $invoice = Invoice::find($invoiceId);
            $invoice->Customer_Name = $invoiceDetail['Customer_Name'];
            $invoice->Total = $invoiceDetail['Total'];
            $invoice->save();

            if ($invoice->id != null) {
                $this->deleteItems($invoiceId);
                foreach ($invoiceDetail['items'] as $item) {
                    FruitInvoice::create([
                        'Invoice_ID' => $invoice->id,
                        'Fruit_ID' => $item['Fruit_ID'],
                        'Quantity' => $item['Quantity'],
                        'Amount' => $item['Amount']
                    ]);
                }

                DB::commit();

                return $invoice;
            } else {
                DB::rollBack();
                throw new Exception('Invoice update failed.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getInvoiceItems(int $id)
    {
        //get all fruit names, its category, unit name ( get by it unit id), its price  associated with the invoice
        $invoiceItems = DB::table('fruit_invoice')
            ->join('fruits', 'fruit_invoice.fruit_id', '=', 'fruits.id')
            ->join('units', 'fruits.unit_id', '=', 'units.id')
            //joint category table to get category name
            ->join('categories', 'fruits.category_id', '=', 'categories.id')
            ->where('invoice_id', $id)
            ->select('fruits.id', 'fruits.Fruit_Name', 'categories.id', 'categories.Category_Name', 'fruits.Price',  'units.Unit_Name', 'fruit_invoice.Quantity', 'fruit_invoice.Amount')
            ->get();
        return $invoiceItems;
    }

    public function deleteItems(int $id): void
    {
        //delete all fruits associated with the invoice
        FruitInvoice::where('Invoice_ID', $id)->delete();
    }

    public function destroy(int $id): void
    {
        //delete the invoice
        Invoice::destroy($id);
    }
}
