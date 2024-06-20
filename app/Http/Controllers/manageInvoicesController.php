<?php

namespace App\Http\Controllers;

use App\Interfaces\InvoiceRepositoryInterface;
use App\Models\Invoice;
use Illuminate\Http\Request;

class manageInvoicesController extends Controller
{
    private InvoiceRepositoryInterface $invoiceRepository;
    public function __construct(InvoiceRepositoryInterface $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
    }

    public function index()
    {
        $invoices = $this->invoiceRepository->index();
        return view('manageInvoices', compact('invoices'));
    }

    public function getTableData()
    {
        $invoices = $this->invoiceRepository->index();
        return response()->json($invoices);
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $invoiceId = (int) $id;
        $invoiceInfo = $this->invoiceRepository->show($invoiceId);
        $invoiceItems = $this->invoiceRepository->getInvoiceItems($invoiceId);
        return view('invoice', compact('invoiceInfo', 'invoiceItems'));
    }
}
