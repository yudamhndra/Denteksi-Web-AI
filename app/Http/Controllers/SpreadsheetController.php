<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Orangtua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;

class SpreadsheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

    public function downloadTemplate() {
        $filePath = storage_path('app/public/spreadsheet/');
        $fileName = 'input_spreadsheet.xlsx';

        return response()->download($filePath.$fileName, $fileName);
    }

    public function saveSpreadsheetToDatabase(Request $request) {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls',
        ]);
        $uploadedFile = $request->file('excel_file');
        $spreadsheet = IOFactory::load($uploadedFile->getRealPath());
        $data = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        
        $header = $data[1];

        for ($row = 2; $row <= count($data); $row++) {
            $rowData = $data[$row];

            if (empty(array_filter($rowData))) {
                continue;
            }
    
            $DataAnak = array_combine($header, $rowData);
            $orangtua = Orangtua::Where('id_users', Auth::user()->id)->value('id');

            $Anak = new Anak([
                'id_orangtua' => $orangtua,
                'nama' => $DataAnak['Nama'],
                'tanggal_lahir' => $DataAnak['Tanggal Lahir'],
                'tempat_lahir' => $DataAnak['Tempat Lahir'],
                'jenis_kelamin' => $DataAnak['Jenis Kelamin'],
            ]);

            $Anak->save();
        }

        return response()->json(['message' => 'Data imported to the database']);
    }
}

