<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function export()
    {
        return view('invoices.export');
    }

    public function import()
    {
        return view('invoices.import');
    }

}
