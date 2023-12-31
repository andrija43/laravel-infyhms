<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\AppBaseController;
use App\Models\Invoice;
use App\Models\Setting;
use App\Repositories\InvoiceRepository;
use \PDF;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InvoiceController extends AppBaseController
{
    /** @var InvoiceRepository */
    private $invoiceRepository;

    public function __construct(InvoiceRepository $invoiceRepo)
    {
        $this->invoiceRepository = $invoiceRepo;
    }

    public function index(Request $request)
    {
        $statusArr = Invoice::STATUS_ARR;

        return view('employees.invoices.index')
            ->with('statusArr', $statusArr);
    }

    public function show(Invoice $invoice)
    {
        if (checkRecordAccess($invoice->patient_id)) {
            return view('errors.404');
        } else {
            $data['hospitalAddress'] = Setting::where('key', '=', 'hospital_address')->first()->value;
            $data['invoice'] = Invoice::with(['invoiceItems.account', 'patient.address'])->find($invoice->id);

            return view('employees.invoices.show')->with($data);
        }
    }

    public function convertToPdf(Invoice $invoice)
    {
        if (checkRecordAccess($invoice->patient_id)) {
            return view('errors.404');
        } else {
            $invoice->invoiceItems;
            $data = $this->invoiceRepository->getSyncListForCreate($invoice->id);
            $data['invoice'] = $invoice;
            $data['currencySymbol'] = getCurrencySymbol();
            $pdf = PDF::loadView('invoices.invoice_pdf', $data);

            return $pdf->stream('invoice.pdf');
        }
    }
}
