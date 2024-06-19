<?php

namespace App\Http\Controllers;

use PDF;
use App\Interfaces\InvoiceRepositoryInterface;
use Illuminate\Http\Request;

class pdfController extends Controller
{
    private InvoiceRepositoryInterface $invoiceRepository;

    public function __construct(InvoiceRepositoryInterface $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
    }
    //index
    public function index(Request $Request)
    {
        $id = $Request->id;
        $invoiceId = (int) $id;
        $invoiceInfo = $this->invoiceRepository->show($invoiceId);
        $invoiceItems = $this->invoiceRepository->getInvoiceItems($invoiceId);
        return view('invoicePDF', compact('invoiceInfo', 'invoiceItems'));
    }
}
