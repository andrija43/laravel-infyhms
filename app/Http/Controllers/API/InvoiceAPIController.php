<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\Invoice;

class InvoiceAPIController extends AppBaseController
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        if (getLoggedinPatient()) {
            $invoices = Invoice::where('patient_id', getLoggedInUser()->patient->id)->orderBy('id', 'desc')->get();
            $data = [];
            foreach ($invoices as $invoice) {
                $data[] = $invoice->prepareInvoice();
            }

            return $this->sendResponse($data, 'Invoices Retrieved Successfully');
        }
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        $invoice = Invoice::with(['patient.patientUser', 'invoiceItems'])->where('id', $id)->where('patient_id', getLoggedInUser()->owner_id)->first();

        if (! $invoice) {
            return $this->sendError(__('messages.invoice.invoice').' '.__('messages.common.not_found'));
        }

        return $this->sendResponse($invoice->prepareInvoiceDetails(), 'Invoice Retrieved Successfully');
    }
}
