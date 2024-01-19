<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\PemeriksaanFisik;

class ChartDashboardOrtu extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $data = PemeriksaanFisik::select('tinggi_badan','berat_badan','waktu_pemeriksaan')->where('id_anak', $request->id_anak)->get();
        $arrayLabel = [];
        $arrayData = [];
        if ($request->type == 'tb') {
            foreach ($data as $key => $value) {
                $arrayLabel[] = \Carbon\Carbon::parse($value->waktu_pemeriksaan)->format('j M Y');
                $arrayData[] = $value->tinggi_badan;
            }        
        } elseif ($request->type == 'bb') {
            foreach ($data as $key => $value) {
                $arrayLabel[] = \Carbon\Carbon::parse($value->waktu_pemeriksaan)->format('j M Y');
                $arrayData[] = $value->berat_badan;
            }                
        }

        return Chartisan::build()
            ->labels($arrayLabel)
            ->dataset(strtoupper($request->type), $arrayData);
    }
}