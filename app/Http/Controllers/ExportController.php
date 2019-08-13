<?php

namespace App\Http\Controllers;


use App\Imports\QuestionsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export(Request $request)
    {
        Excel::import(new QuestionsImport, 'test.xlsx');

        return redirect('/')->with('success', 'All good!');
    }
}
