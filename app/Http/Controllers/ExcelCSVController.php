<?php

namespace App\Http\Controllers;

use App\Models\Fans;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Exports\FansExport;
use App\Imports\FansImport;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Maatwebsite\Excel\Exceptions\NoTypeDetectedException;

class ExcelCSVController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('excel-csv-import');
    }

    /**
     * @return ResponseFactory|Response|Application
     */
    public function importExcelCSV(Request $request): Application|ResponseFactory|Response
    {
        $validatedData = $request->validate([
            'excel' => 'required',
        ]);
        DB::statement('SET GLOBAL FOREIGN_KEY_CHECKS = 0');
        Excel::import(new FansImport, $request->file('excel'));
//        try {
//            Excel::import(new FansImport, $validatedData);
//        }catch (NoTypeDetectedException $e){
//            return response(['message' => 'Sorry you are using a wrong format to upload files.'])->error();
//        }
        return response(['message' => 'The file excel/csv has been imported to database']);
    }

    /**
     * @return BinaryFileResponse
     */
    public function exportExcelCSV($slug): BinaryFileResponse
    {
        return Excel::download(new FansExport, 'fans.' . $slug);
    }

    public function exportPDF(Request $request,$id)
    {
//        $id = $request->get('fan_id');
        $data = Fans::where('id', $id)->first();
        $pdf = PDF::loadView('product.description', ['data' => $data]);
//        return $pdf->output();
        return $pdf->download('description-about.pdf');
    }
}
