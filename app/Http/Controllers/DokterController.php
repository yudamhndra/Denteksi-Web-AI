<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Dokter;
use App\Models\Kelurahan;
use App\Models\Kecamatan;
use App\Models\Kelas;
use App\Models\Sekolah;
use App\Models\Anak;
use App\Models\SkriningOdontogram;
use App\Models\SkriningIndeks;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Models\PemeriksaanFisik;
use App\Models\PemeriksaanMata;
use App\Models\PemeriksaanTelinga;
use App\Models\PemeriksaanGigi;
use App\Models\ResikoKaries;
use Carbon\Carbon;
use App\Models\Notification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // HALAMAN ADMIN UNTUK DOKTER

    // function untuk menampilkan data data akun dokter yang terdaftar DI HALAMAN ADMIN
    public function data(){
        $dokter = Dokter::all();
        return datatables()->of($dokter)
        ->addColumn('action', function($row){
            $btn = '<a href="'.route('dokter.edit',$row->id).'"  id="btn-edit" class=" btn btn-warning "><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a>';
            $btn = $btn.' <a title="Delete" id="btn-delete" class="delete-modal mr-3 btn btn-danger "><i class="fa fa-trash " ></i>Hapus</a>';

            return $btn;
        })
        ->rawColumns(['action'])->addIndexColumn()->make(true);
    }

    // function untuk menampilkan halaman index akun dokter DI HALAMAN ADMIN
    public function index()
    {

        return view('admin.dokter.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // function untuk menampilkan halaman create akun dokter DI HALAMAN ADMIN
    public function create()
    {
        return view('admin.dokter.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //  FUNCTION UNTUK MENDAFTARKAN AKUN DOKTER DI HALAMAN ADMIN
    public function store(Request $request)
    {
        $messages = [
            'nik.required' => 'NIK wajib diisi.',
            'nik.unique' => 'NIK tidak boleh sama.',
            'nik.min' => 'NIK harus 16 digit.',
            'nama.required' => 'Nama wajib diisi.',
            'nama.min' => 'Nama minimal 3 huruf.',
            'jenis_kelamin.required' => 'Jenis Kelamin harus diisi.',
            'Tempat_lahir.required' => 'Tempat lahir harus diisi',
            'Tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah terpakai.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 4 karaketer.',
            'no_telp.required' => 'No telepon wajib diisi.',

            'no_str.required' => 'No Str wajib diisi',

        ];
        $validator = $request->validate([
            'nik' => ['required', 'min:16',
                        Rule::unique('dokter', 'NIK')],
            'nama' => 'required',
            'email' => ['required', 'email',
                        Rule::unique('users', 'email')],
            'password' => 'required',
            'no_telp' => 'required',

            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'no_str' => 'required',

        ], $messages);
        DB::beginTransaction();


        try{
        $user = New User();
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role ="dokter";
        $user->save();

            $dokter = new Dokter();
            $dokter->id_users=$user->id;
            $dokter->id_kecamatan = $request->kecamatan;
            $dokter->nik = $request->nik;
            $dokter->nama = $request->nama;
            $dokter->jenis_kelamin = $request->jenis_kelamin;
            $dokter->tempat_lahir = $request->tempat_lahir;
            $dokter->tanggal_lahir = $request->tanggal_lahir;
            $dokter->no_telp = $request->no_telp;
            $dokter->no_str= $request->no_str;
            $dokter->save();


            DB::commit();
            return redirect()->route('dokter.index');

        }catch(\Exception $e){
        DB::rollback();
        return redirect()->route('dokter.create')->with('error',$messages);
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
        $dokter = Dokter::find($id);

        return view('admin.dokter.edit',compact('dokter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // function untuk mengupdate data akun dokter yang terdaftar di HALAMAN ADMIN
    public function update(Request $request, $id)
    {
        $messages = [
            'nik.required' => 'NIK wajib diisi.',
            'nik.unique' => 'NIK tidak boleh sama.',
            'nik.min' => 'NIK harus 16 digit.',
            'nama.required' => 'Nama wajib diisi.',
            'jenis_kelamin.required' => 'Jenis Kelamin harus diisi.',
            'Tempat_lahir.required' => 'Tempat lahir harus diisi',
            'Tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'email.required' => 'Email wajib diisi.',

            'no_telp.required' => 'No telepon wajib diisi.',
            'no_str.required' => 'No Str wajib diisi',

        ];
        $validator = $request->validate([
            'nik' => ['required', 'min:16'],
            'nama' => 'required',

            'no_telp' => 'required',

            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'no_str' => 'required',

        ], $messages);
        try{
        $dokter = Dokter::find($id);
        if(!empty($request->password)){
            $user = User::where('id', $dokter->id_users)->update([

                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => "dokter"
            ]);
        }else{
            $user = User::where('id', $dokter->id_users)->update([

                'email' => $request->email,
                'role' => "dokter"
            ]);
        }

            $dokter = $dokter->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'id_kecamatan'=> $request->wilayah,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_telp' => $request->no_telp,
            'no_str' => $request->no_str

            ]);
            return redirect()->route('dokter.index');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->route('dokter.edit')->with('error',$messages);
            }


    }

    // function untuk menghapus data dokter dihalaman dokter
    public function destroy($id)
    {

        $dokter = Dokter::find($id);
        $dokter ->delete();
        return response()->json(
            ['data'=>'success delete data']);
    }



    // -------- HALAMAN DOKTER --------------

    // function untuk menampilkan dashboard pada HALAMAN DOKTER
    public function viewDashboard()
    {
        $totalukgs = PemeriksaanGigi::whereNotNull('id_kelas')->count();
        $totalukgm = PemeriksaanGigi::whereNull('id_kelas')->count();
        $anak = Anak::all()->count();

        return view('dokter.dashboard',compact('totalukgs','totalukgm','anak'));
    }

    // function untuk menampilkan halaman profil pada HALAMAN DOKTER
    public function profil()
    {
        return view('dokter.profil');
    }
    // function untuk menampilkan halaman ubah profil pada HALAMAN DOKTER
    public function profil_edit($id)
    {
        $logdokter = Auth::user()->dokter;
        $dokter = $logdokter->find($id);
        return view('dokter.profil-edit',compact('dokter'));
    }

    // function untuk mengupdate data profil pada HALAMAN DOKTER
    public function profil_update(Request $request, $id)
    {

        $logdokter = Auth::user()->dokter;
        $dokter = $logdokter->find($id);
        $dokter->nik = $request->nik;
        $dokter->nama =$request->nama;
        $dokter->jenis_kelamin = $request->jenis_kelamin;
        $dokter->tempat_lahir=  $request->tempat_lahir;
        $dokter->tanggal_lahir= $request->tanggal_lahir;
        $dokter->no_telp = $request->no_telp;
        $dokter->no_str= $request->no_str;
        if($request->hasfile('avatar'))
        {
            $destination = 'dokter/avatar/'.$dokter->avatar;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('avatar');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('dokter/avatar/', $filename);
            $dokter->avatar = $filename;
        }
        if($request->hasfile('header'))
        {
            $destination = 'dokter/header/'.$dokter->header;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('header');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('dokter/header/', $filename);
            $dokter->header = $filename;
        }


        $dokter->save();
        return redirect()->route('dokter.profil');

    }

    // function untuk menampilkan halaman riwayat pemeriksaan pada HALAMAN DOKTER
    public function pemeriksaan_ukgs(){
        //$kelurahan = Kelurahan::all();
        $user = Auth::user();
        $dokter = Dokter::Where('id_users', Auth::user()->id)->value('id_kecamatan');
        $kelurahan = Kelurahan::where('id_kecamatan', $dokter)->pluck('nama','id');
        $sekolah = Sekolah::pluck('nama','id');
        //$sekolah   = Sekolah::all();
        return view('dokter.pemeriksaanData.ukgs',[
            'kelurahan' => $kelurahan, 'sekolah '=> $sekolah,
        ]);
    }


    public function pemeriksaan_data_ukgs(Request $request, $id){
        if ($request->open == 'notification') {
            // Auth::user()->unreadNotifications->when($request->input('id'), function ($query) use ($request) {
            //     return $query->where('id', $request->input('id'));
            // })->markAsRead();
            $kec = Dokter::find($request->kec)->id_kecamatan;
            $otherDokter = Dokter::where('id_kecamatan', $kec)->pluck('id_users')->toArray();
            Notification::whereIn('notifiable_id', $otherDokter)->whereNull('read_at')->update(['read_at' => now()]);
        }
        $data = PemeriksaanGigi::with('anak','resikoKaries','skriningOdontogram','skriningIndeks')->findOrFail($id);
//        dd($data->skriningOdontogram);
        $aksi = ['belum-erupsi','erupsi-sebagian','karies','non-vital','tambalan-logam','tambalan-non-logam','mahkota-logam','mahkota-non-logam','sisa-akar','gigi-hilang','jembatan','gigi-tiruan-lepas'];
        $odontograms = [
            'b1k1' => ['p18','p17','p16','p15','p14','p13','p12','p11'],
            'b2k1' => ['p55','p54','p53','p52','p51'],
            'b3k1' => ['p85','p84','p83','p82','p81'],
            'b4k1' => ['p48','p47','p46','45','p44','p43','p42','p41'],
            'b1k2' => ['p21','p22','p23','p24','p25','p26','p27','p28'],
            'b2k2' => ['p61','p62','p63','p64','p65'],
            'b3k2' => ['p71','p72','p73','p74','p75'],
            'b4k2' => ['p31','p32','p33','p34','p35','p36','p37','p38']
        ];

        $result = collect();
        foreach ($data->skriningOdontogram as $odontogram) {
            $found = false;
            foreach ($result as &$item) {
                if ($item->aksi === $odontogram->aksi) {
                    $item->posisi .= ',' . $odontogram->posisi;
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $skriningOdontogram = new SkriningOdontogram();
                $skriningOdontogram->id = 0;
                $skriningOdontogram->id_pemeriksaan = $odontogram->id_pemeriksaan;
                $skriningOdontogram->aksi = $odontogram->aksi;
                $skriningOdontogram->posisi = $odontogram->posisi;
                $result->push($skriningOdontogram);
            }
        }

        $response = json_encode($result);


//        $groupedOdontograms = collect($data->skriningOdontogram)->groupBy(['id_pemeriksaan', 'aksi'])->map(function ($group) {
//            // Menggabungkan posisi-posisi yang sama ke dalam satu string dengan pemisah koma (,)
//            $posisi = $group->pluck('posisi')->implode(',');
//
//            // Membuat data hasil penggabungan
//            return [
//                'id_pemeriksaan' => $group->first()['id_pemeriksaan'],
//                'aksi' => $group->first()['aksi'],
//                'posisi' => $posisi
//            ];
//        })->values();


        $images = $this->lihat_gambar($id);
        return view ('dokter.pemeriksaanData.pemeriksaanDataUKGS',compact('data','odontograms','aksi','images','response'));
    }

    public function pemeriksaan_data_ukgm(Request $request, $id){

        if ($request->open == 'notification') {
            // Auth::user()->unreadNotifications->when($request->input('id'), function ($query) use ($request) {
            //     return $query->where('id', $request->input('id'));
            // })->markAsRead();

            $kec = Dokter::find($request->kec)->id_kecamatan;
            $otherDokter = Dokter::where('id_kecamatan', $kec)->pluck('id_users')->toArray();
            Notification::whereIn('notifiable_id', $otherDokter)->whereNull('read_at')->update(['read_at' => now()]);
        }
        $data = PemeriksaanGigi::with('anak','resikoKaries','skriningOdontogram','skriningIndeks')->findOrFail($id);
        $aksi = ['belum-erupsi','erupsi-sebagian','karies','non-vital','tambalan-logam','tambalan-non-logam','mahkota-logam','mahkota-non-logam','sisa-akar','gigi-hilang','jembatan','gigi-tiruan-lepas'];
        $odontograms = [
            'b1k1' => ['p18','p17','p16','p15','p14','p13','p12','p11'],
            'b2k1' => ['p55','p54','p53','p52','p51'],
            'b3k1' => ['p85','p84','p83','p82','p81'],
            'b4k1' => ['p48','p47','p46','45','p44','p43','p42','p41'],
            'b1k2' => ['p21','p22','p23','p24','p25','p26','p27','p28'],
            'b2k2' => ['p61','p62','p63','p64','p65'],
            'b3k2' => ['p71','p72','p73','p74','p75'],
            'b4k2' => ['p31','p32','p33','p34','p35','p36','p37','p38']
        ];
        $images = $this->lihat_gambar($id);
        return view ('dokter.pemeriksaanData.pemeriksaanDataUKGM',compact('data','odontograms','aksi','images'));
    }

    public function storeSkriningGigiUkgm(Request $request){

        if($request->ajax()){
            SkriningOdontogram::where('id_pemeriksaan', $request->id_pemeriksaan)->delete();

            foreach ($request->aksi as $key => $value) {
                $array = explode(',', $value);

                $skriningOdontogramData = [];
                foreach ($array as $item) {
                    // Check if the $item is empty and assign NULL if true
                    $posisi = ($item !== '') ? $item : null;

                    $skriningOdontogramData[] = [
                        'id_pemeriksaan' => $request->id_pemeriksaan,
                        'aksi' => $key,
                        'posisi' => $posisi,
                    ];
                }

                SkriningOdontogram::insert($skriningOdontogramData);
            }
            SkriningIndeks::updateOrCreate(
                [
                    'id_pemeriksaan' => $request->id_pemeriksaan
                ],
                [
                    'def_d' => $request->def_d,
                    'def_e' => $request->def_e,
                    'def_f' => $request->def_f,
                    'dmf_d' => $request->dmf_d,
                    'dmf_e' => $request->dmf_e,
                    'dmf_f' => $request->dmf_f,
                    'diagnosa' => $request->diagnosa,
                    'rekomendasi' => $request->rekomendasi,
                    'reservasi' => $request->reservasi
                ]
            );
            ResikoKaries::updateOrCreate(
                [
                    'id_pemeriksaan_gigi' => $request->id_pemeriksaan
                ],
                [
                    'rksoal1' => $request->rksoal1,
                    'rksoal2' => $request->rksoal2,
                    'rksoal3' => $request->rksoal3,
                    'rksoal4' => $request->rksoal4,
                    'rksoal5' => $request->rksoal5,
                    'rksoal6' => $request->rksoal6,
                    'rksoal7' => $request->rksoal7,
                    'rksoal8' => $request->rksoal8,
                    'rksoal9' => $request->rksoal9,
                    'rksoal10' => $request->rksoal10,
                    'rksoal11' => $request->rksoal11,
                    'rksoal12' => $request->rksoal12,
                    'rksoal13' => $request->rksoal13,
                    'penilaian' => $request->penilaian_risiko_karies
                ]
            );
            return response()->json(['success'=>'Data added successfully']);
        }
    }

    public function storeSkriningGigiUkgs(Request $request){
        if($request->ajax()){
            SkriningOdontogram::where('id_pemeriksaan', $request->id_pemeriksaan)->delete();

            foreach ($request->aksi as $key => $value) {
                $array = explode(',', $value);

                $skriningOdontogramData = [];
                foreach ($array as $item) {
                    // Check if the $item is empty and assign NULL if true
                    $posisi = ($item !== '') ? $item : null;

                    $skriningOdontogramData[] = [
                        'id_pemeriksaan' => $request->id_pemeriksaan,
                        'aksi' => $key,
                        'posisi' => $posisi,
                    ];
                }

                SkriningOdontogram::insert($skriningOdontogramData);
            }


            SkriningIndeks::updateOrCreate(
                [
                    'id_pemeriksaan' => $request->id_pemeriksaan
                ],
                [
                    'def_d' => $request->def_d,
                    'def_e' => $request->def_e,
                    'def_f' => $request->def_f,
                    'dmf_d' => $request->dmf_d,
                    'dmf_e' => $request->dmf_e,
                    'dmf_f' => $request->dmf_f,
                    'diagnosa' => $request->diagnosa,
                    'rekomendasi' => $request->rekomendasi,
                    'reservasi' => $request->reservasi
                ]
            );



            return response()->json(['success'=>'Data added successfully']);
        }
    }

    public function rekap_ukgs(Request $request){
        $user = Auth::user();
        $dokter = Dokter::Where('id_users', Auth::user()->id)->value('id_kecamatan');
        $kelurahan = Kelurahan::where('id_kecamatan', $dokter)->pluck('nama','id');
        $sekolah = Sekolah::pluck('nama','id');
        //$sekolah   = Sekolah::all();
        return view('dokter.rekapData.ukgs',[
            'kelurahan' => $kelurahan, 'sekolah '=> $sekolah,
        ]);
    }

    public function rekap_ukgm(){
        $user = Auth::user();
        $dokter = Dokter::Where('id_users', Auth::user()->id)->value('id_kecamatan');
        $kelurahan = Kelurahan::where('id_kecamatan', $dokter)->pluck('nama','id');
        $sekolah = Sekolah::pluck('nama','id');
        //$sekolah   = Sekolah::all();
        return view('dokter.rekapData.ukgm',[
            'kelurahan' => $kelurahan, 'sekolah '=> $sekolah,
        ]);

    }
    public function rekap_detail_ukgs(){
        return view ('dokter.rekapData.rekapDataUKGS');
    }

    public function rekap_detail_ukgs_id($id){
        $pemeriksaanFisik = PemeriksaanFisik::where('id_anak', $id)->orderBy('waktu_pemeriksaan', 'desc')->first();
        $pemeriksaanMata = PemeriksaanMata::where('id_anak', $id)->orderBy('waktu_pemeriksaan', 'desc')->first();
        $pemeriksaanTelinga = PemeriksaanTelinga::where('id_anak', $id)->orderBy('waktu_pemeriksaan', 'desc')->first();
        $pemeriksaanGigi = PemeriksaanGigi::where('id_anak', $id)->orderBy('waktu_pemeriksaan', 'desc')->first();

            return view ('dokter.rekapData.rekapDataUKGSID', compact( 'pemeriksaanFisik', 'pemeriksaanMata', 'pemeriksaanTelinga', 'pemeriksaanGigi'));
    }



    public function rekap_detail_ukgm(){
        return view ('dokter.rekapData.rekapDataUKGM');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // function untuk menampilkan list list kelurahan
    public function listKelurahan(){
        $user = Auth::user();
        $dokter = Dokter::Where('id_users', Auth::user()->id)->value('id_kecamatan');
        $kelurahan = Kelurahan::where('id_kecamatan', $dokter)->get();
        return view('dokter.pemeriksaanData.ukgs',compact('kelurahan'));

    }

    // function untuk menampilkan list anak yang telah melakukan pemeriksaanfisik berdasarkan id kelas
    public function listAnak(Request $request)
    {
       $id_kelurahan = $request->kelurahan;
       $sekolah = Sekolah::where('id_kelurahan', $id_kelurahan);
       $sekolah_ids = $sekolah->pluck('id');


       $pemeriksaanfisik = PemeriksaanGigi::query();
       if($request->has("kelurahan")){
           $pemeriksaanfisik->with('anak','skriningOdontogram','kelas')->whereHas('kelas.sekolah', function ($q) use ($request){
               $q->where('id_kelurahan',$request->kelurahan);
           });
       }
       if($request->has('id_sekolah')){
           $pemeriksaanfisik->with('anak','skriningOdontogram','kelas')->whereHas('kelas',function ($q) use ($request){
               $q->where('id_sekolah',$request->id_sekolah);
           });
           if($request->has("id_kelas")){
               $pemeriksaanfisik->with('anak','skriningOdontogram')->where('id_kelas',$request->id_kelas)->get();
           };
       }
       $pemeriksaanfisik->orderBy('created_at', 'desc')->get();
        $pemeriksaanfisik->whereHas('anak', function ($q) {
            $q->whereNotNull('nama');
        });
        $pemeriksaanfisik->whereHas('kelas', function ($q) {
            $q->whereNotNull('kelas');
        });
        return datatables()->of($pemeriksaanfisik)
        ->addColumn('action', function($row){
            $btn = '';
            $btn .= '<a type="button" class="btn btn-primary btn-xs text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Rekap Data " href="'.route('dokter.rekapDetailUKGSID',$row->id_anak).'"><i class="mdi mdi-book-open-page-variant"></i> Detail</a> ';

            if($row->skriningOdontogram->isEmpty()){
                $btn .= '<a type="button" class="btn btn-danger btn-xs text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Periksa" href="'.route('dokter.pemeriksaanDataUKGS',$row->id).'">Periksa  <i class="mdi mdi-tooth"></i></a> ';
            }else{
                $btn .= '<a type="button" class="btn btn-info btn-xs text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Periksa" href="'.route('dokter.pemeriksaanDataUKGS',$row->id).'">Periksa  <i class="mdi mdi-tooth"></i></a> ';
            }
            $btn .= '<a type="button" class="btn btn-warning btn-xs text-white  recheck-button" data-bs-toggle="tooltip" data-bs-placement="top" title="Recheck" data-pemeriksaan-id="'.$row->id.'">Recheck<i class="mdi mdi-reload"></i></a>';

            return $btn;
        })

        ->addColumn('tanggal', function($pemeriksaanfisik){
            return $tanggal = date('d-m-Y', strtotime($pemeriksaanfisik->waktu_pemeriksaan));
        })
        ->addColumn('waktu', function($pemeriksaanfisik){
            return $waktu = date('H:i', strtotime($pemeriksaanfisik->waktu_pemeriksaan));
        })
        ->addColumn('nama', function($pemeriksaanfisik){
            return $pemeriksaanfisik->anak->nama ?? " ";
        })
        ->addColumn('kelas', function($pemeriksaanfisik){
            return $pemeriksaanfisik->kelas->kelas?? " ";
        })
        ->addColumn('sekolah', function($pemeriksaanfisik){
            return $pemeriksaanfisik->kelas->sekolah->nama ?? " ";
        })
        ->addColumn('jenis_kelamin', function($pemeriksaanfisik){
            return $pemeriksaanfisik->anak->jenis_kelamin ?? " ";
        })
        ->addIndexColumn()
       ->make(true);

    }

    // function untuk menampilkan list anak berdasarkan id kelas
    public function listAnakRekap(Request $request){
        $anak = DB::table('anak')
        ->leftJoin('sekolah', 'sekolah.id', '=', 'anak.id_sekolah')
        ->leftJoin('kelas', 'kelas.id', '=', 'anak.id_kelas')
        ->leftJoin(DB::raw('(SELECT
            id_anak,
            max(waktu_pemeriksaan) as waktu_pemeriksaan
            FROM pemeriksaan_fisik GROUP BY id_anak) pf'),
            function($join)
            {
            $join->on('anak.id', '=', 'pf.id_anak');
            })
        ->select('anak.id', 'anak.nama', 'anak.jenis_kelamin', 'sekolah.nama as sekolah', 'kelas.kelas', 'pf.waktu_pemeriksaan')
        ->get();

        return datatables()->of($anak)
        ->addColumn('action', function($row){
            $btn = '';
            $btn .= '<a type="button" class="btn btn-primary btn-xs text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Rekap Data" href="'.route('dokter.rekapDetailUKGSID', $row->id).'">Lihat Rekap <i class="mdi mdi-book-open-page-variant"></i></a> ';
            $btn .= '<a type="button" class="btn btn-info btn-xs text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Periksa" href="'.route('dokter.pemeriksaanDataUKGS').'"><i class="mdi mdi-tooth"></i></a>';

            return $btn;
        })
        ->addColumn('skrining', function($anak){
            if($anak->waktu_pemeriksaan==null)
                return "Belum";
            else
                return "Sudah (".date('d/m/Y', strtotime($anak->waktu_pemeriksaan)).")";
        })
        ->addIndexColumn()
        ->make(true);

    }

    //----------UKGM--------------//
    public function pemeriksaan_ukgm(){

        $user = Auth::user();
        $dokter = Dokter::Where('id_users', Auth::user()->id)->value('id_kecamatan');
        $kelurahan = Kelurahan::where('id_kecamatan', $dokter)->pluck('nama','id');
        $sekolah = Sekolah::pluck('nama','id');
        //$sekolah   = Sekolah::all();
        return view('dokter.pemeriksaanData.ukgm',[
            'kelurahan' => $kelurahan, 'sekolah '=> $sekolah,
        ]);

    }

    public function listAnakUkgm(Request $request)
    {
        $pemeriksaanGigi = PemeriksaanGigi::query();
        if($request->has('kelurahan')) {
            $pemeriksaanGigi->with('anak', 'skriningOdontogram', 'sekolah')->whereHas('sekolah', function ($q) use ($request) {
                $q->where('id_kelurahan', $request->kelurahan);
            });
        }
            if ($request->has("id_posyandu")) {
                $pemeriksaanGigi->with('anak', 'skriningOdontogram')->where('id_sekolah', $request->id_posyandu)->get();
            };
        $pemeriksaanGigi->orderBy('created_at', 'desc')->get();
        $pemeriksaanGigi->whereHas('anak', function ($q) {
            $q->whereNotNull('nama');
        });
        $pemeriksaanGigi->whereHas('sekolah', function ($q) {
            $q->whereNotNull('sekolah.nama');
        });
        return datatables()->of($pemeriksaanGigi)
        ->addColumn('action', function($row){
            $btn = '';
            $btn .= '<a type="button" class="btn btn-primary btn-xs text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Rekap Data" href="'.route('dokter.rekapDetailUKGSID',$row->id_anak).'"><i class="mdi mdi-book-open-page-variant"></i> Detail</a> ';

            if($row->skriningOdontogram->isEmpty()){
                $btn .= '<a type="button" class="btn btn-danger btn-xs text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Periksa" href="'.route('dokter.pemeriksaanDataUKGM',$row->id).'">Periksa  <i class="mdi mdi-tooth"></i></a> ';
            }else{
                $btn .= '<a type="button" class="btn btn-info btn-xs text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Periksa" href="'.route('dokter.pemeriksaanDataUKGM',$row->id).'">Periksa  <i class="mdi mdi-tooth"></i></a> ';
            }
            $btn .= '<a type="button" class="btn btn-warning btn-xs text-white  recheck-button" data-bs-toggle="tooltip" data-bs-placement="top" title="Recheck" data-pemeriksaan-id="'.$row->id.'">Recheck<i class="mdi mdi-reload"></i></a>';
            return $btn;
        })

        ->addColumn('tanggal', function($pemeriksaanGigi){
            return $tanggal = date('d-m-Y', strtotime($pemeriksaanGigi->waktu_pemeriksaan));
        })
        ->addColumn('waktu', function($pemeriksaanGigi){
            return $waktu = date('H:i', strtotime($pemeriksaanGigi->waktu_pemeriksaan));
        })
        ->addColumn('nama', function($pemeriksaanGigi){
            return $pemeriksaanGigi->anak->nama ?? " ";
        })

        ->addColumn('posyandu', function($pemeriksaanGigi){
            return $pemeriksaanGigi->sekolah->nama ?? " ";
        })
        ->addColumn('jenis_kelamin', function($pemeriksaanGigi){
            return $pemeriksaanGigi->anak->jenis_kelamin?? " ";
        })
        ->addColumn('umur', function($pemeriksaanGigi){
            $born=Carbon::parse($pemeriksaanGigi->anak->tanggal_lahir?? " ");
            $age = $born->diff(Carbon::now())
            ->format('%y tahun %m bulan ');

            return $age;
        })

        ->addIndexColumn()
       ->make(true);

    }
    // public function pemeriksaan_data_ukgm($id)
    // {
    //     $ukgm=PemeriksaanGigi::with('resikoKaries')->find($id);
    //     return view('dokter.pemeriksaanData.pemeriksaanDataUKGM',compact('ukgm'));
    // }

    //------ Dashboard ----------//
    public function dashboard(){

        $totalukgs = PemeriksaanGigi::all()->count();
        dd($totalukgs);
    }

    public function lihat_gambar($id){
        $pemeriksaan = PemeriksaanGigi::find($id);
        $pemeriksaan_id = $pemeriksaan->id;
        $url = config('app.ai_url') . "/api/result-image/?pemeriksaan_id=$pemeriksaan_id";
        $response = Http::withBasicAuth('user@senyumin.com', 'sdgasdfklsdwqorn')->get($url);
        $decodedImages = [];


            $responseData = $response->json();


            // Check if the response contains 'status' and 'data' keys
            if (isset($responseData['status']) && isset($responseData['data'])) {
                $status = $responseData['status'];
                $data = $responseData['data'];

                // Check if the status is 'Success' and data is not empty
                if ($status === 'Success' && !empty($data)) {
                    foreach ($data as $item) {
                        $result = $item['result'];

                        foreach ($result as $filename => $resultData) {
                            $decodedImage = base64_decode($resultData);
                            $decodedImages[] = [
                                'filename' => $filename,
                                'image' => $decodedImage,
                            ];
                        }
                    }
                }
            }


        return $decodedImages;

    }

    public function recheck($pemeriksaanId)
    {
        $username = 'user@senyumin.com'; // Ganti dengan username yang sesuai
        $password = 'sdgasdfklsdwqorn'; // Ganti dengan password yang sesuai


        $url = config('app.ai_url') . "/api/result-image/?pemeriksaan_id=$pemeriksaanId";
        $response = Http::withBasicAuth('user@senyumin.com', 'sdgasdfklsdwqorn')->get($url);
        // Lakukan penanganan respons API sesuai kebutuhan Anda
        if ($response->successful()) {
            $data = $response->json();
            // Lakukan sesuatu dengan data yang diterima dari API
            // Contoh: Tampilkan respons API dalam log

            // Kirim respons sukses ke frontend
            return response()->json([
                'message' => 'Recheck process completed successfully.'
            ]);
        } else {
            // Penanganan kesalahan jika permintaan gagal
            $statusCode = $response->status();
            $errorMessage = $response->body();
            // Lakukan penanganan kesalahan sesuai kebutuhan Anda

            // Kirim respons gagal ke frontend
            return response()->json([
                'error' => 'Failed to perform recheck process.'
            ], $statusCode);
        }
    }

    public function uploadImage(Request $request)
    {
    $image = $request->file('image');

    if ($image) {
        // Simpan gambar ke penyimpanan (storage) Anda
        $path = $image->store('images', 'public');

        // Lakukan sesuatu dengan path gambar yang baru saja diunggah
        // Misalnya, simpan path ke database
    }

    return redirect()->back()->with('success', 'Gambar berhasil diunggah.');
    }



}
