<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Hari;
use App\Models\PemeriksaanGigi;
use App\Models\Poli;
use App\Models\PoliHari;
use App\Models\Reservasi;
use App\Models\Sesi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ReservasiController extends Controller
{
    /**
     * Cek apakah user adalah orangtua anak
     *
     * @param $idAnak = id anak
     * @return \Illuminate\Http\Response
     */
    private function cekOrtuAnak($idAnak)
    {
        $orangtua = Auth::user()->orangtua[0];
        foreach ($orangtua->anak as $key => $anak) {
            if($anak->id == $idAnak) {
                return true;
            }
        }
        return false;
    }

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
     * @param \Illuminate\Http\Request  $request => riwayatPeriksa = id riwayat pemeriksaan
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $klinik = Poli::get();
        $riwayatPeriksa = PemeriksaanGigi::Where('id',$request->riwayatPeriksa)->first();
        $cekReservasi = Reservasi::where('id_pemeriksaan',$request->riwayatPeriksa)->get()->last();

        if($this->cekOrtuAnak($riwayatPeriksa->id_anak)) {
            if (!$cekReservasi || $cekReservasi->status === 'Batal Reservasi') {
                return view('orangtua.reservasi.create', compact('riwayatPeriksa', 'klinik'));
            } elseif ($cekReservasi) {
                return redirect()->route('reservasi.show',$cekReservasi->kode);
            }
        } else {
            return abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(),
        [
            'anak' => 'required',
            'poli' => 'required',
            'tanggal' => 'required',
            'keluhan' => 'required'
        ]);

        DB::beginTransaction();
        $poli = Poli::find($request->poli);
//        $orangtua = Auth::user()->orangtua->first()->id;
//        $anak = Anak::where('id_orangtua', $orangtua)
//                    ->where('nama', $request->nama)->first();
//        $cekReservasi = Reservasi::where('id_anak', $anak->id)
//                                ->where('poli_id',$request->poli)
//                                ->where('tanggal',$request->tanggal)
//                                ->whereNotIn('status',['Batal Reservasi'])->first();

//        if ($cekReservasi) {
//            return Redirect::back()->withErrors([
//                'tanggal' => 'Anda sudah memiliki jadwal reservasi di '.$poli->poli.' tanggal '.Carbon::createFromDate($request->tanggal)->translatedFormat('j F Y').'.'
//            ])->withInput();
//        }

        $antrian = Reservasi::where('tanggal',$request->tanggal)
                            ->where('poli_id',$request->poli)->count() + 1;

        // Create data reservasi
        $reservasi = new Reservasi;
        $reservasi->poli_id = $request->poli;
        $reservasi->kode = $poli->kode.'RSV'.strtoupper(substr(md5(rand()),rand(0,26),5));
        $reservasi->antrian = $poli->kode.$antrian;
        $reservasi->tanggal = $request->tanggal;
        $reservasi->id_anak = $request->anak;
        $reservasi->id_pemeriksaan = 2;
        $reservasi->keluhan = $request->keluhan;
        $reservasi->status = 'Reservasi';
        $reservasi->save();

        DB::commit();

        return redirect()->route('reservasi.show',$reservasi->kode);
    }

    /**
     * Display all data reservasi in orang tua dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function reservasiOrtu()
    {
        return view('orangtua.reservasi.index');
    }

    /**
     * Display all data reservasi in orang tua dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dataReservasiOrtu()
    {
        $orangtua = Auth::user()->orangtua->first()->id;
        $anak = Anak::where('id_orangtua', $orangtua)->get();

        // Get all reservasi dari anak orang tua (have Auth)
        $reservasi = collect();
        foreach ($anak as $key => $value) {
            Reservasi::when($value, function ($query, $value) use (&$reservasi) {
                $query->where('id_anak', $value->id)->each(function ($item) use (&$reservasi) {
                    $reservasi[] = $item;
                });
            });
        }

        // Set (open) sesi per reservasi
        $reservasi->each(function ($item) {
            $sesi = [];
            PoliHari::where('poli_id',$item->poli_id)->each(function ($poliHari) use (&$item, &$sesi) {
                $sesiHari = Sesi::where('poli_hari_id', $poliHari->id)->get();
                foreach( $sesiHari as $sesiPerDay){
                    $maxSesi = $sesiPerDay->selesai;
                    $dataBefore[$poliHari->hari_id] = '13:00';
                    if(now()->format("Y-m-d") == $item->tanggal and now() < Carbon::parse($item->tanggal.$maxSesi)) {
                        $sesi[$poliHari->hari_id]['sesi'] = $sesiPerDay->sesi;
                        $sesi[$poliHari->hari_id]['mulai'] = $sesiPerDay->mulai;
                        $sesi[$poliHari->hari_id]['selesai'] = $maxSesi;
                        $sesi[$poliHari->hari_id]['color'] = 'success';
                        $dataBefore[$poliHari->hari_id] = $sesi[$poliHari->hari_id]['selesai'];
                    } else {
                        if ($dataBefore[$poliHari->hari_id] > $maxSesi) {
                            $sesi[$poliHari->hari_id]['sesi'] = $sesiPerDay->sesi;
                            $sesi[$poliHari->hari_id]['mulai'] = $sesiPerDay->mulai;
                            $sesi[$poliHari->hari_id]['selesai'] = $maxSesi;
                            $sesi[$poliHari->hari_id]['color'] = 'secondary';
                            $dataBefore[$poliHari->hari_id] = $sesi[$poliHari->hari_id]['selesai'];
                        } elseif(empty($sesi[$poliHari->hari_id])) {
                            $sesi[$poliHari->hari_id]['sesi'] = $sesiPerDay->sesi;
                            $sesi[$poliHari->hari_id]['mulai'] = $sesiPerDay->mulai;
                            $sesi[$poliHari->hari_id]['selesai'] = $maxSesi;
                            $sesi[$poliHari->hari_id]['color'] = 'secondary';
                        }
                    }
                }
            });

            // Cek sesi klinik berakhir
            $sesiTerakhir = Carbon::parse($item->tanggal.$sesi[Carbon::parse($item->tanggal)->format("N")]['selesai']);
            if($item->status == 'Reservasi' && now() > $sesiTerakhir){
                DB::beginTransaction();
                $item->update([
                    'status' => 'Batal Reservasi'
                ]);
                DB::commit();
            }

            $item->sesiHari = $sesi;
            return  $item;
        });

        return datatables()->of($reservasi->sortByDesc('tanggal'))
        ->addIndexColumn()
        ->addColumn('poli',function($row){
            $poli = $row->poli->poli;
            return $poli;
        })
        ->addColumn('sesi',function($row){
            $tanggal = Carbon::parse($row->tanggal)->format('j F Y');
            $idDay = Carbon::parse($row->tanggal)->format('N');
            $data = $tanggal.' | '.$row->sesiHari[$idDay]["sesi"].' ('.$row->sesiHari[$idDay]["mulai"].'-'.$row->sesiHari[$idDay]["selesai"].')';
            return '<span class="badge bg-'.$row->sesiHari[$idDay]["color"].' p-2">'.$data.'</span>';
        })
        ->addColumn('status',function($row){
            if($row->status == 'Reservasi'){
                return '<span class="badge bg-primary p-2">Sudah '.$row->status.'</span>';
            } elseif($row->status == 'Batal Reservasi') {
                return '<span class="badge bg-secondary p-2">Reservasi Telah Dibatalkan</span>';
            } else {
                return '<span class="badge bg-warning p-2">'.$row->status.'</span>';
            }
            return $row->status;
        })
        ->addColumn('action', function($row){
            return '<a href="'.route('reservasi.show',$row->kode).'" class="btn btn-xs btn-info mx-1"><i class="fa fa-book me-2"></i>Detail</a>';
        })
        ->rawColumns(['poli','sesi','status','action'])
        ->make(true);
    }

    /**
     * Display the specified reservasi in orang tua dashboard.
     *
     * @param  kode => kode reservasi
     * @return \Illuminate\Http\Response
     */
    public function showReservasi($kode)
    {
        $reservasi = Reservasi::where('kode', $kode)->first();
        $hariReservasi = date('l', strtotime($reservasi->tanggal));

        if($this->cekOrtuAnak($reservasi->id_anak)) {
            $poliHari = $reservasi->poli->poliHari;
            $maxSesi = null;
            foreach ($poliHari as $key => $value) {
                if($value->hari->day === $hariReservasi){
                    $sesi = Sesi::where('poli_hari_id', $value->id)->get();
                    $sesi->each(function ($item) use (&$maxSesi) {
                        if($maxSesi < $item->selesai) $maxSesi = $item->selesai;
                    });
                }
            }
            // Cek sesi klinik berakhir
            if($reservasi->status == 'Reservasi' && now() > Carbon::parse($reservasi->tanggal.$maxSesi)){
                DB::beginTransaction();
                $reservasi->update([
                    'status' => 'Batal Reservasi'
                ]);
                DB::commit();
            }
            return view('orangtua.reservasi.tiket', compact('reservasi', 'sesi'));
        } else {
            return abort(404);
        }
    }

    /**
     * Display all data reservasi in dokter dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function reservasiDokter()
    {
        return view('dokter.reservasiData.index');
    }

    /**
     * Display all data reservasi in dokter dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dataReservasiDokter()
    {
        $poliCollection = collect([]);
        $dokter = Auth::user()->dokter->first();

        $dokter->dokterSesi->each(function ($item) use (&$poliCollection) {
            $poliCollection[] = $item->sesi->poliHari->poli_id;
        });
        $reservasi = Reservasi::whereIn('poli_id',  $poliCollection->unique())->get();

        return datatables()->of($reservasi->sortByDesc('tanggal'))
            ->addIndexColumn()
            ->addColumn('poli', function ($row) {
                $poli = $row->poli->poli;
                return $poli;
            })
            ->addColumn('nama', function ($row) {
                $nama = Anak::find($row->id_anak)->nama;
                return $nama;
            })
            ->addColumn('status', function ($row) {
                if ($row->status == 'Reservasi') {
                    return '<span class="badge bg-primary p-2">Sudah ' . $row->status . '</span>';
                } elseif ($row->status == 'Batal Reservasi') {
                    return '<span class="badge bg-secondary p-2">Reservasi Telah Dibatalkan</span>';
                } else {
                    return '<span class="badge bg-warning p-2">' . $row->status . '</span>';
                }
                return $row->status;
            })
            ->rawColumns(['poli', 'nama', 'status'])
            ->make(true);
    }

    /**
     * Cancel reservasi pemeriksaan
     *
     * @return \Illuminate\Http\Response
     */
    public function batalReservasi($reservasiId)
    {
        $reservasi = Reservasi::find($reservasiId);

        DB::beginTransaction();
        $reservasi->update([
            'status' => 'Batal Reservasi'
        ]);
        DB::commit();
    }

    /**
     * Display list tanggal & sesi in create reservasi page.
     *
     * @param  poli => id poli
     * @return \Illuminate\Http\Response
     */
    public function poli($poli)
    {
        Carbon::setLocale('id');
        $data = [];
        $counter = 0;
        $day = array(0,1,2,3,4,5,6);

        $klinik = Poli::find($poli);
        $waktu = Poli::find($poli)->poliHari;
        $maxSesi = null;
        foreach ($waktu as $key => $value) {
            if($value->hari->day === today()->format('l')){
                $sesi = Sesi::where('poli_hari_id', $value->id)->get();
                $sesi->each(function ($item) use (&$maxSesi) {
                    if($maxSesi < $item->selesai) $maxSesi = $item->selesai;
                });
            }
        }

        foreach ($day as $i) {
            // Get perkiraan hari
            if (now()->format('H:i') > $maxSesi) {
                ${'hari'.$i} = date('Y-m-d', strtotime(' +'.($i+1).' day'));
                $counter += 1;
            } else {
                ${'hari'.$i} = date('Y-m-d', strtotime(' +'.($i+$counter).' day'));
            }
            // Model Hari
            ${'cek_hari'.$i} = Hari::where('day',date('l',strtotime(${'hari'.$i})))->first();
            // ID PoliHari
            ${'cek_jadwal_hari'.$i} = PoliHari::where('poli_id',$poli)->where('hari_id',${'cek_hari'.$i}->id)->pluck('id');
            // Collect Model Sesi
            ${'cek_pelayanan_hari'.$i} = Sesi::whereIn('poli_hari_id',${'cek_jadwal_hari'.$i})->get();

            if (!${'cek_pelayanan_hari'.$i}->isEmpty()) {
                $color = 'bg-primary';
                $hari = Hari::where('day',date('l', strtotime(${'hari'.$i})))->first()->id;
                $poliHari = PoliHari::with('sesi')->where('poli_id',$poli)->where('hari_id',$hari)->get();
                $data[] = ['color'=>$color,'tanggal'=>${'hari'.$i},'keterangan'=>Carbon::createFromDate(${'hari'.$i})->translatedFormat('j F Y'),'hari'=>Carbon::createFromDate(${'hari'.$i})->translatedFormat('l'),'day'=>$poliHari];
            } else {
                $color = 'bg-secondary';
                $hari = Hari::where('day',date('l', strtotime(${'hari'.$i})))->first()->id;
                $poliHari = PoliHari::with('sesi')->where('poli_id',$poli)->where('hari_id',$hari)->get();
                $data[] = ['color'=>$color,'tanggal'=>${'hari'.$i},'keterangan'=>Carbon::createFromDate(${'hari'.$i})->translatedFormat('j F Y'),'hari'=>Carbon::createFromDate(${'hari'.$i})->translatedFormat('l'),'day'=>$poliHari];
            }
        }
        $data[] = ['klinik' => $klinik->poli, 'link' => $klinik->url_registrasi];

        return response()->json($data);
    }
}
