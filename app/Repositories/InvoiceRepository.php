<?php

namespace App\Repositories;

use FFI\Exception;
use Illuminate\Support\Facades\DB;
use App\Interfaces\InvoiceRepositoryInterface;
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
        // return DB::transaction(function () use ($invoiceDetail) {
        //     $invoice = Invoice::create([
        //         'Customer_Name' => $invoiceDetail['Customer_Name'],
        //         'Total' => $invoiceDetail['Total']
        //     ]);

        //     if (!$invoice->id == null) {
        //         foreach ($invoiceDetail['items'] as $item) {
        //             FruitInvoice::create([
        //                 'Invoice_ID' => $invoice->id,
        //                 'Fruit_ID' => $item['Fruit_ID'],
        //                 'Quantity' => $item['Quantity'],
        //                 'Amount' => $item['Amount']
        //             ]);
        //         }
        //     } else {
        //         return 'invoice id null';
        //     }
        // });
        try {
            // Bắt đầu transaction
            DB::beginTransaction();

            // Tạo hóa đơn mới
            $invoice = Invoice::create([
                'Customer_Name' => $invoiceDetail['Customer_Name'],
                'Total' => $invoiceDetail['Total']
            ]);

            // Kiểm tra xem hóa đơn đã được tạo thành công chưa
            if ($invoice->id != null) {
                // Tạo các mục hóa đơn tương ứng
                foreach ($invoiceDetail['items'] as $item) {
                    FruitInvoice::create([
                        'Invoice_ID' => $invoice->id,
                        'Fruit_ID' => $item['Fruit_ID'],
                        'Quantity' => $item['Quantity'],
                        'Amount' => $item['Amount']
                    ]);
                }

                // Hoàn thành transaction
                DB::commit();

                // Trả về đối tượng Invoice sau khi tạo thành công
                return $invoice;
            } else {
                // Nếu hóa đơn không được tạo thành công, rollback transaction
                DB::rollBack();
                throw new Exception('Invoice creation failed.');
            }
        } catch (\Exception $e) {
            // Nếu có lỗi xảy ra, rollback transaction và ném ra ngoại lệ
            DB::rollBack();
            throw $e;
        }
    }
    public function update(array $invoiceDetail, int $invoiceId): void
    {
        DB::beginTransaction();
        try {
            $invoice = Invoice::findOrFail($invoiceId);
            $invoice->update([
                'Customer_Name' => $invoiceDetail['Customer_Name'],
                'Total' => $invoiceDetail['Total'],
            ]);
            FruitInvoice::where('Invoice_ID', $invoiceId)->delete();
            foreach ($invoiceDetail['fruits'] as $fruit) {
                FruitInvoice::create([
                    'invoice_id' => $invoice->id,
                    'fruit_id' => $fruit['Fruit_ID'],
                    'Quantity' => $fruit['Quantity'],
                    'Amount' => $fruit['Amount'],
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
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
            ->select('fruits.Fruit_Name', 'categories.Category_Name', 'fruits.Price',  'units.Unit_Name', 'fruit_invoice.Quantity', 'fruit_invoice.Amount')
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
