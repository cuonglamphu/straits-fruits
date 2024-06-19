<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Interfaces\InvoiceRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreInvoiceRequest;

class InvoiceController extends Controller
{
    private InvoiceRepositoryInterface $invoiceRepository;

    public function __construct(InvoiceRepositoryInterface $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
    }

    public function index()
    {
        $data = $this->invoiceRepository->index();
        return ApiResponseClass::sendResponse($data, 'Invoices retrieved successfully', 200);
    }

    public function show(int $id)
    {
        $invoiceId = (int) $id;
        $data = $this->invoiceRepository->show($id);
        return ApiResponseClass::sendResponse($data, '', 200);
    }

    public function getInvoiceItems(int $id)
    {
        $data = $this->invoiceRepository->getInvoiceItems($id);
        return ApiResponseClass::sendResponse($data, '', 200);
    }

    public function store(StoreInvoiceRequest $request)
    {

        $invoiceDetail = $request->validated();
        $invoice = $this->invoiceRepository->store($invoiceDetail);
        return ApiResponseClass::sendResponse($invoice, 'Invoice created successfully', 201);
    }


    public function update(int $id, StoreInvoiceRequest $request)
    {
        //
    }

    public function destroy(int $id)
    {
        DB::beginTransaction();
        try {
            $this->invoiceRepository->deleteItems($id);
            $this->invoiceRepository->destroy($id);
            DB::commit();
            return ApiResponseClass::sendResponse(null, 'Invoice deleted successfully', 200);
        } catch (\Exception $e) {
            ApiResponseClass::rollback($e, 'Failed to delete invoice due to a server error, please try again.');
        }
    }
}
