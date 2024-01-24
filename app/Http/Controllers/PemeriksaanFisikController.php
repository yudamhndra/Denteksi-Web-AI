<?php

namespace App\Http\Controllers;

use App\Models\ResikoKaries;
use Illuminate\Http\Request;
use App\Models\PemeriksaanFisik;
use App\Models\PemeriksaanMata;
use App\Models\PemeriksaanTelinga;
use App\Models\PemeriksaanGigi;
use App\Models\User;
use App\Models\Orangtua;
use App\Models\Anak;
use App\Models\Dokter;
use App\Models\Kelurahan;
use App\Models\Sekolah;
use App\Models\Kelas;
use App\Models\Pasien;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use File;
use RealRashid\SweetAlert\Facades\Alert;

//----------------- HALAMAN ORANGTUA-----------------//

class PemeriksaanFisikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // menambah data pemeriksaan fisik diHALAMAN ORANGTUA
    public function create()
    {
        $kelurahan=Kelurahan::all()->pluck('nama','id');
        $user = Auth::user();
        $orangtua = Orangtua::Where('id_users', Auth::user()->id)->value('id');
        $anak = Anak::Where('id_orangtua',$orangtua)->get();  //mendapatkan list anak berdasarkan id orangtua yang login

        return view('orangtua.pemeriksaan.create',compact('anak','kelurahan'));
    }

    // menambah data pemeriksaan anak dengan auto-complete (dari QR)
    public function createAuto($id)
    {
        // misahin link sama UQ nya
        $id = explode('_', $id);

        $kelurahan=Kelurahan::all()->pluck('nama','id');
        $user = Auth::user();
        $orangtua = Orangtua::Where('id_users', Auth::user()->id)->value('id');
        $anak = Anak::Where('id_orangtua',$orangtua)->get();  //mendapatkan list anak berdasarkan id orangtua yang login
        $autoAnak = $anak[(int)$id - 1];

        return view('orangtua.pemeriksaan.create',compact('anak','kelurahan','autoAnak'));
    }

    public function listAnak($anak){
        $user = Auth::user();
        $orangtua = Orangtua::Where('id_users', Auth::user()->id)->value('id');
        $anak = Anak::Where('id_orangtua',$orangtua)->get();
          //mendapatkan list anak berdasarkan id orangtua yang login
        $kelas = Kelas::Where('id_sekolah',$anak)->get();
        return response()->json($kelas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $messages = [

        //     'email.required' => 'Email wajib diisi.',
        //     'email.unique' => 'Email sudah terdaftar.',

        // ];
        // $validator = $request->validate([
        //     'kelas' => 'required',


        // ], $messages);

        DB::beginTransaction();
        try{

        $user = Auth::user();
        $orangtua = Orangtua::Where('id_users', Auth::user()->id)->value('id');
        $anak = Anak::Where('id_orangtua',$orangtua)->get();

        $waktu_pemeriksaan = Carbon::now(); //mendapatkan waktu sekarang

        $pFisik = new PemeriksaanFisik();
        $pFisik->id_anak =  $request->anak;
        $pFisik->id_sekolah= $request->id_sekolah  ?: $request->id_posyandu;
        $pFisik->id_kelas = $request->kelas;
        $pFisik->tinggi_badan = $request->tinggi_badan;
        $pFisik->berat_badan = $request->berat_badan;
        if($request->tinggi_badan > 0 && $request->berat_badan > 0){
            $pFisik->imt = $request->berat_badan/((($request->tinggi_badan)/100)*(($request->tinggi_badan)/100)); // perhitungan IMT
        }
        $pFisik->sistole = $request->sistole;
        $pFisik->diastole = $request->diastole;
        $pFisik->waktu_pemeriksaan = $waktu_pemeriksaan;
        $pFisik->save(); // MENYIMPAN PEMERIKSAAN FISIK

        $pMata = new PemeriksaanMata();
        $pMata->id_anak =  $request->anak;
        $pMata->id_sekolah= $request->id_sekolah  ?: $request->id_posyandu;
        $pMata->id_kelas = $request->kelas;
        $pMata->msoal1=$request->msoal1; // menyimpan jawaban soal mata
        $pMata->msoal2=$request->msoal2; // menyimpan jawaban soal mata
        $pMata->msoal3=$request->msoal3; // menyimpan jawaban soal mata
        $pMata->msoal4=$request->msoal4; // menyimpan jawaban soal mata
        $pMata->msoal5=$request->msoal5; // menyimpan jawaban soal mata
        $pMata->msoal6=$request->msoal6; // menyimpan jawaban soal mata (menentukan keterangan mata minus plus atau butawarna)
        $pMata->msoal7=$request->msoal7; // menyimpan jawaban soal mata
        $pMata->waktu_pemeriksaan=$waktu_pemeriksaan;
        $pMata->save(); // MENYIMPAN PEMERIKSAAN MATA
        $pTelinga = new PemeriksaanTelinga();
        $pTelinga->id_anak =  $request->anak;
        $pTelinga->id_sekolah= $request->id_sekolah;
        $pTelinga->id_kelas = $request->kelas;
        $pTelinga->tsoal1=$request->tsoal1;
        $pTelinga->tsoal2=$request->tsoal2;
        $pTelinga->tsoal3=$request->tsoal3;
        $pTelinga->tsoal4=$request->tsoal4;
        $pTelinga->tsoal5=$request->tsoal5;
        $pTelinga->tsoal6=$request->tsoal6;
        $pTelinga->tsoal7=$request->tsoal7;
        $pTelinga->tsoal8=$request->tsoal8;
        $pTelinga->tsoal9=$request->tsoal9;
        $pTelinga->waktu_pemeriksaan=$waktu_pemeriksaan;
        $pTelinga->save();
        // MENYIMPAN PEMERIKSAAN TELINGA

        // Membuat data pemeriksaan gigi. Ini punya ID yang dipake oleh data pemeriksaan dokter
        // TODO : Cari tahu cara mengambil ID dari Pemeriksaan yang dibuat, kemudian ditaruh di ...
            $imageArray = array();
            $pgigi = new PemeriksaanGigi();
            $pgigi->id_anak = $request->anak;
            $pgigi->id_sekolah= $request->id_sekolah ?: $request->id_posyandu;
            $pgigi->id_kelas = $request->kelas;
            $pgigi->waktu_pemeriksaan = $waktu_pemeriksaan;

            if(!empty($request->gambar1)){
                $file = $request->file('gambar1');
                $extension = strtolower($file->getClientOriginalExtension());
                $filename1 = uniqid() . '.' . $extension;
                $imageArray[0] = ['gambar' => $file, 'filename' => $filename1];

                Storage::put('public/gigi/' . $filename1, File::get($file));
                $pgigi->gambar1=$filename1;
            }
            if(!empty($request->gambar2)){
                $file = $request->file('gambar2');
                $extension = strtolower($file->getClientOriginalExtension());
                $filename2 = uniqid() . '.' . $extension;
                $imageArray[1] = ['gambar' => $file, 'filename' => $filename2];

                Storage::put('public/gigi/' . $filename2, File::get($file));
                $pgigi->gambar2=$filename2;
            }
            if(!empty($request->gambar3)){
                $file = $request->file('gambar3');
                $extension = strtolower($file->getClientOriginalExtension());
                $filename3 = uniqid() . '.' . $extension;
                $imageArray[2] = ['gambar' => $file, 'filename' => $filename3];

                Storage::put('public/gigi/' . $filename3, File::get($file));
                $pgigi->gambar3=$filename3;
            }
            if(!empty($request->gambar4)){
                $file = $request->file('gambar4');
                $extension = strtolower($file->getClientOriginalExtension());
                $filename4 = uniqid() . '.' . $extension;
                $imageArray[3] = ['gambar' => $file, 'filename' => $filename4];

                Storage::put('public/gigi/' . $filename4, File::get($file));
                $pgigi->gambar4=$filename4;
            }
            if(!empty($request->gambar5)){
                $file = $request->file('gambar5');
                $extension = strtolower($file->getClientOriginalExtension());
                $filename5 = uniqid() . '.' . $extension;
                $imageArray[4] = ['gambar' => $file, 'filename' => $filename5];

                Storage::put('public/gigi/' . $filename5, File::get($file));
                $pgigi->gambar5=$filename5;
            }

            $pgigi->gsoal1= $request->gsoal1;
            $pgigi->gsoal2= $request->gsoal2;

            $pgigi->save();

            // rk = resiko karies
            if($pgigi->id_kelas==NULL){
                $rk= new ResikoKaries();
                $rk->id_pemeriksaan_gigi=$pgigi->id;
                $rk->rksoal1=$request->rksoal1;
                $rk->rksoal2=$request->rksoal2;
                $rk->rksoal3=$request->rksoal3;
                $rk->rksoal4=$request->rksoal4;
                $rk->rksoal5=$request->rksoal5;
                $rk->rksoal6=$request->rksoal6;
                $rk->rksoal7=$request->rksoal7;
                $rk->rksoal8=$request->rksoal8;
                $rk->rksoal9=$request->rksoal9;
                $rk->rksoal10=$request->rksoal10;
                $rk->rksoal11=$request->rksoal11;
                $rk->rksoal12=$request->rksoal12;
                $rk->rksoal13=$request->rksoal13;
                $rk->save();
            }

            if($request->kelas){
                $kecamatan = $pgigi->kelas->sekolah->kelurahan->kecamatan->id;
            }else{
                $kecamatan = $pgigi->sekolah->kelurahan->kecamatan->id;
            }

            DB::commit();
            $response = Http::withBasicAuth('user@senyumin.com', 'sdgasdfklsdwqorn');

            foreach ($imageArray as $key => $value) {
                $key=$key+1;
                $response->attach(
                    'gambar['.$key.']',
                    file_get_contents($value['gambar']),
                    $value['filename']
                );
            }

            $response = $response->post(config('app.ai_url').'/api/detect',[
                'pemeriksaan_id' => $pgigi->id,
                'nama_anak' => $pgigi->anak->nama,
                'nama_ortu' => $pgigi->anak->orangtua->nama,
                'nama_instansi'=> ($pgigi->id_kelas != null) ? 'Puskesmas '.$pgigi->kelas->sekolah->kelurahan->kecamatan->nama : 'Puskesmas '.$pgigi->sekolah->kelurahan->kecamatan->nama,
                'sekolah_id' => $pgigi->id_sekolah??$pgigi->kelas->sekolah->id,
                'nama_sekolah' => ($pgigi->id_kelas != null) ? $pgigi->kelas->sekolah->nama : $pgigi->sekolah->nama,
            ])->throw()->json();


            Alert::success('Sukses', 'berhasil melakukan pemeriksaan.');



        return redirect()->route('view-riwayat')->with('success','Sukses mengisi data pemeriksaan');
    }catch(\Illuminate\Http\Client\RequestException $e){
        DB::rollback();




            return redirect()->route('pemeriksaanfisik.create');
    }

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
        //
    }

    // ----------- HALAMAN ORANGTUA - > RIWAYAT --------------//
    public function riwayat(){
        $user = Auth::user();
        $dokter = Dokter::Where('id_users', Auth::user()->id)->value('id');
        $pasien = Pasien::Where('id_dokter',$dokter)->get();
        return view('orangtua.pemeriksaan.riwayat',compact('pasien'));
    }

    // ----------- HALAMAN ORANGTUA - > RIWAYAT -> RIWAYAT FISIK --------------//
    public function riwayatfisik(Request $request){
        // MENAMPILKAN DATA PEMERIKSAAN FISIK
        $user = Auth::user();
        $orangtua = Orangtua::Where('id_users', Auth::user()->id)->value('id');  // MENDAPATKAN ID ORANGTUA
        $anak = Anak::Where('id_orangtua',$orangtua)->get(); // MENDAPATKAN LIST ANAK BERDASARKAN ID ORANGTUA

        $pemeriksaanFisik = PemeriksaanFisik::Where('id_anak',$request->anak)->orderBy('id','asc')->get(); // MENDAPATKAN LIST PEMERIKSAAN FISIK BERDASARKAN ID ANAK

        return datatables()->of($pemeriksaanFisik)
        ->addColumn('imt', function($pemeriksaanFisik){
            if($pemeriksaanFisik->imt < 18.5){
                $data= 'Kurus';
            }else if($pemeriksaanFisik->imt >= 18.5 && $pemeriksaanFisik->imt <= 25.0){
                $data = 'Ideal';
            }else if($pemeriksaanFisik->imt >= 25.1 && $pemeriksaanFisik->imt <= 29.9){
                $data = 'Gemuk';
            }else{
                $data = 'Obesitas';
            }
            return $data;
        })
        ->addColumn('nama_anak', function($anak){
            $nama_anak = $anak->nama;
            return $nama_anak;
        })
        ->addColumn('tanggal', function($pemeriksaanFisik){
            return $tanggal = date('d-m-Y', strtotime($pemeriksaanFisik->waktu_pemeriksaan));
        })
        ->addColumn('jam', function($pemeriksaanFisik){
            return $jam = date('H:i', strtotime($pemeriksaanFisik->waktu_pemeriksaan));
        })
       ->addIndexColumn()
       ->make(true);

    }

    public function riwayatmata(Request $request){
        $user = Auth::user();
        $orangtua = Orangtua::Where('id_users', Auth::user()->id)->value('id');
        $anak = Anak::Where('id_orangtua',$orangtua)->get();
        if(!empty($request->anak)){
            $pemeriksaanMata = PemeriksaanMata::Where('id_anak',$request->anak)->OrderBy('waktu_pemeriksaan','ASC')->get(); // mendatkan data pemeriksaan mata berdarkan request anak
           }
            return datatables()->of($pemeriksaanMata)
            ->addColumn('tanggal', function($pemeriksaanMata){
               return $tanggal = date('d-m-Y', strtotime($pemeriksaanMata->created_at));

            })
            ->addColumn('jam',function($pemeriksaanMata){
                return $jam = date('H:i', strtotime($pemeriksaanMata->created_at));
            })
            ->addColumn('hasil',function($pemeriksaanMata){
                if($pemeriksaanMata->msoal6=='normal'){
                    $data = 'Mata Normal';
                }else if($pemeriksaanMata->msoal6=='minus'){
                    $data = 'Mata Minus';
                }else{
                    $data = 'Mata Buta Warna';
                }
                return $data;
            })
            ->addIndexColumn()
            ->make(true);
    }
    public function riwayattelinga(Request $request){
        $user = Auth::user();
        $orangtua = Orangtua::Where('id_users', Auth::user()->id)->value('id');
        $anak = Anak::Where('id_orangtua',$orangtua)->get();
        if(!empty($request->anak)){
            $pemeriksaanTelinga = PemeriksaanTelinga::Where('id_anak',$request->anak)->OrderBy('waktu_pemeriksaan','ASC')->get();
           }else{
            $pemeriksaanTelinga = PemeriksaanTelinga::all();
            }
            return datatables()->of($pemeriksaanTelinga)
            ->addColumn('tanggal', function($pemeriksaanTelinga){
               return $tanggal = date('d-m-Y', strtotime($pemeriksaanTelinga->created_at));

            })
            ->addColumn('jam',function($pemeriksaanTelinga){
                return $jam = date('H:i', strtotime($pemeriksaanTelinga->created_at));
            })
            ->addColumn('hasil',function($pemeriksaanTelinga){
                if($pemeriksaanTelinga->tsoal7=='ya'&& $pemeriksaanTelinga->tsoal8=='ya'){
                    $data = 'Serumen 2';
                }else if($pemeriksaanTelinga->tsoal7=='ya'&& $pemeriksaanTelinga->tsoal8=='tidak'){
                    $data = 'Serumen Kanan';
                }else if($pemeriksaanTelinga->tsoal7=='tidak'&& $pemeriksaanTelinga->tsoal8=='ya'){
                    $data = 'Serumen Kiri';
                }else{
                    $data = 'Serumen Tidak Ada';
                }
                return $data;
            })
            ->addIndexColumn()
            ->make(true);
    }
    public function riwayatgigi(Request $request){
        $user = Auth::user();
        $dokter = Dokter::Where('id_users', Auth::user()->id)->value('id');
        $pasien = Pasien::Where('id_dokter',$dokter)->get();
        if(!empty($request->anak)){
            $pemeriksaanGigi = PemeriksaanGigi::Where('id_pasien',$request->anak)->orderBy('waktu_pemeriksaan', 'desc')->get();

        }else{
            $pemeriksaanGigi = PemeriksaanGigi::all();
        }

            return datatables()->of($pemeriksaanGigi)
            ->addColumn('tanggal', function($pemeriksaanGigi){
               return $tanggal = date('d-m-Y', strtotime($pemeriksaanGigi->waktu_pemeriksaan??"null"));

            })
            ->addColumn('jam',function($pemeriksaanGigi){
                return $jam = date('H:i', strtotime($pemeriksaanGigi->waktu_pemeriksaan??"null"));
            })

            ->addColumn('gambar',function($pemeriksaanGigi){
                $url1= url('storage/gigi/'.$pemeriksaanGigi->gambar1?? "null");
                $url2= url('storage/gigi/'.$pemeriksaanGigi->gambar2?? "null");
                $url3= url('storage/gigi/'.$pemeriksaanGigi->gambar3?? "null");
                $url4= url('storage/gigi/'.$pemeriksaanGigi->gambar4?? "null");
                $url5= url('storage/gigi/'.$pemeriksaanGigi->gambar5?? "null");

                if(($pemeriksaanGigi->gambar4==NULL)  &&(!empty($pemeriksaanGigi->gambar5)) ){
                $gambar= '<img src="'.$url1.'"  width="50" class="img-fluid" align="center" />
                <img src="'.$url2.'"  width="50" class="img-fluid" align="center" />
                <img src="'.$url3.'"  width="50" class="img-fluid" align="center" />
                <img src="'.$url5.'"  width="50" class="img-fluid" align="center" />

                ';
                }else if(($pemeriksaanGigi->gambar5==NULL)&&(!empty($pemeriksaanGigi->gambar4))){
                    $gambar= '<img src="'.$url1.'"  width="50" class="img-fluid" align="center" />
                    <img src="'.$url2.'"  width="50" class="img-fluid" align="center" />
                    <img src="'.$url3.'"  width="50" class="img-fluid" align="center" />
                    <img src="'.$url4.'"  width="50" class="img-fluid" align="center" />
                    ';
                }else if(($pemeriksaanGigi->gambar4==NULL) && ($pemeriksaanGigi->gambar5==NULL)){
                    $gambar= '<img src="'.$url1.'"  width="50" class="img-fluid" align="center" />
                    <img src="'.$url2.'"  width="50" class="img-fluid" align="center" />
                    <img src="'.$url3.'"  width="50" class="img-fluid" align="center" />

                    ';
                }
                else{
                    $gambar= '<img src="'.$url1.'"  width="50" class="img-fluid" align="center" />
                    <img src="'.$url2.'"  width="50" class="img-fluid" align="center" />
                    <img src="'.$url3.'"  width="50" class="img-fluid" align="center" />
                    <img src="'.$url4.'"  width="50" class="img-fluid" align="center" />
                    <img src="'.$url5.'"  width="50" class="img-fluid" align="center" />

                    ';
                }
                return $gambar;
            })
            ->addColumn('diagnosa',function($pemeriksaanGigi){
                $diagnosa = '';

                if(!empty($pemeriksaanGigi->skriningIndeks)){
                    $diagnosa .= '<td>'.$pemeriksaanGigi->skriningIndeks->diagnosa.'</td>';
                }else{
                    $diagnosa .= '<span class="badge bg-danger">Menunggu hasil dari dokter</span>';
                }
                return $diagnosa;
            })
            ->addColumn('rekomendasi',function($pemeriksaanGigi){
                $rekomendasi = '';

                // $response = Http::withBasicAuth('user@senyumin.com', 'sdgasdfklsdwqorn');
                // $response = $response->get(config('app.ai_url') . '/api/status/?pemeriksaan_id='.$pemeriksaanGigi->id)->throw()->json();
    
                //TODO : Sesuain sama response dari API 
                if(!empty($pemeriksaanGigi->skriningIndeks->rekomendasi)){
                    if($pemeriksaanGigi->skriningIndeks->reservasi=="ya"){

                    $rekomendasi = '<td>'.$pemeriksaanGigi->skriningIndeks->rekomendasi.'</td>'.'<br>';
                    $rekomendasi .= '<a href="'.route("reservasi",$pemeriksaanGigi->skriningIndeks->id).'" class="btn btn-primary">reservasi</a>';
                    }else{
                        $rekomendasi = '<td>'.$pemeriksaanGigi->skriningIndeks->rekomendasi.'</td>';
                    }
                }else{
                    $rekomendasi .= '<span class="badge bg-danger">Menunggu hasil dari dokter</span>';
                }
                return $rekomendasi;

            })
            // ->addColumn('validasi',function($pemeriksaanGigi){

            //     if(($pemeriksaanGigi->skriningOdontogram->isEmpty()) Or ($pemeriksaanGigi->skriningIndeks->reservasi==NULL)){
            //         $validasi = '<button class="btn btn-danger m-0 me-1">Belum divalidasi </button>';
            //         $validasi .= '<button class= "btn btn-custom m-0 text-white" id="show-foto" ><i class="fa fa-eye" ></i> Lihat Foto</button>';
            //     }else{
            //         $validasi = '<button class="btn btn-custom m-0 me-1 text-white">Sudah divalidasi</button>';
            //         $validasi .= '<button class= "btn btn-custom m-0 text-white" id="show-foto" ><i class="fa fa-eye" ></i> Lihat Foto</button>';

            //     }
            //     return $validasi;
            // })
            // ->addColumn('action', function($row){
            //     $btn = '<a href="'.route('orangtua-anak.edit',$row->id).'" class="btn btn-info "><i class="fa fa-pencil-square-o" aria-hidden="true"></i>lihat hasil</a>';
            //     return $btn;
            // })

            ->addColumn('action', function($row) {
                $url = route('orangtua-anak.periksa' , $row->id_pasien);
                $btn = '<a href="' . $url . '" class="btn btn-info">Lihat Hasil</a>';
                return $btn;
            })


            ->rawColumns(['gambar','diagnosa','rekomendasi','validasi','action'])
            ->addIndexColumn()
            ->make(true);

    }

}
