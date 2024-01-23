<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Orangtua;
use App\Models\Anak;
use App\Models\Kelurahan;
use App\Models\PemeriksaanFisik;
use App\Models\PemeriksaanGigi;
use Illuminate\Support\Facades\Response;
use App\Models\Artikel;
use Ramsey\Uuid\Uuid;
use App\Models\Video;
use Illuminate\Support\Facades\File as FacadesFile;
use App\Models\SkriningIndeks;
use Illuminate\Support\Facades\Auth;
// use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Validator;
use RealRashid\SweetAlert\Facades\Alert;

class OrangtuaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  HALAMAN ADMIN

    // function untuk menampilkan data data akun orangtua yang terdaftar
    public function data(){
        $orangtua = Orangtua::all();
        return datatables()->of($orangtua)
        ->addColumn('action', function($row){

            $btn = '<a href="'.route('orangtua.edit',$row->id).'" type="button" id="btn-edit" class="btn btn-warning "><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a>';
            $btn = $btn.' <a title="Delete" id="btn-delete" class="delete-modal btn btn-danger "><i class="fa fa-trash " ></i>Hapus</a>';

            return $btn;

        })->addColumn('email',function($row){
            return $row->user->email;
        })
        ->rawColumns(['action'])->addIndexColumn()->make(true);
    }

    // function untuk menampilkan halaman index akun orangtua
    public function index()
    {
        return view('admin.orangtua.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.orangtua.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //  FUNCTION UNTUK MENDAFTARKAN AKUN ORANGTUA DI HALAMAN ADMIN
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|min:3',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed',
            'id_kecamatan' => 'required',
            'id_kelurahan' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'pendidikan' => 'required',

        ], [
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi',
            'id_kecamatan.required' => 'Kecamatan wajib diisi',
            'id_kelurahan.required' => 'Kelurahan wajib diisi',
            'nama.required' => 'Nama wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'tempat_lahir.required' => 'tempat lahir wajib diisi',
            'tanggal_lahir.required' => 'tanggal lahir wajib diisi',
            'password.confirmed' => 'password tidak sesuai',


        ]);

        if ($validator->fails()) {
            return redirect()->route('orangtua.create')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            $user = User::create([
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'orangtua',
            ]);

            $orangtua = Orangtua::create([
                'id_users' => $user->id,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'id_kecamatan' => $request->id_kecamatan,
                'id_kelurahan' => $request->id_kelurahan,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'pendidikan' => $request->pendidikan,
            ]);

            DB::commit();
            return redirect()->route('orangtua.index');

        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('orangtua.create')->with('error', 'Gagal menambahkan data');
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
        $orangtua= Orangtua::find($id);
        $kelurahan=Kelurahan::all();

        return view('admin.orangtua.edit', compact('orangtua','kelurahan'));
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
        $validator = Validator::make($request->all(), [
            'nama' => 'required|min:3',
            'password' => 'confirmed',
            'id_kecamatan' => 'required',
            'id_kelurahan' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'pendidikan' => 'required',

        ], [
            'id_kecamatan.required' => 'Kecamatan wajib diisi',
            'id_kelurahan.required' => 'Kelurahan wajib diisi',
            'nama.required' => 'Nama wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'tempat_lahir.required' => 'tempat lahir wajib diisi',
            'tanggal_lahir.required' => 'tanggal lahir wajib diisi',
            'password.confirmed' => 'password tidak sesuai',


        ]);

        if ($validator->fails()) {
            return redirect()->route('orangtua.edit',$id)
                ->withErrors($validator)
                ->withInput();
        }
        DB::beginTransaction();

        try {
            $orangtua = Orangtua::find($id);

            if (!empty($request->password)) {
                $user = User::where('id', $orangtua->id_users)->update([
                    // 'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'role' => 'orangtua'
                ]);
            } else {
                $user = User::where('id', $orangtua->id_users)->update([
                    // 'email' => $request->email,
                    'role' => 'orangtua'
                ]);
            }

            if ($user) {
                $orangtua->update([
                    'nama' => $request->nama,
                    'alamat' => $request->alamat,
                    'id_kecamatan' => $request->id_kecamatan,
                    'id_kelurahan' => $request->id_kelurahan,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'pendidikan' => $request->pendidikan,
                ]);

                DB::commit();
                return redirect()->route('orangtua.index');
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('orangtua.edit', $id)->with('error', 'Gagal mengubah data');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // Function untuk menghapus akun orangtua dihalaman admin
    public function destroy($id)
    {
        $orangtua = Orangtua::find($id);
        $user = User::where('id', $orangtua->id_users);
        $user->delete();
        $orangtua->delete();
        return response()->json(['data'=>'success delete data']);
    }




    // HALAMAN ORANGTUA

    // function untuk register akun orangtua dihalaman register
    public function registerUser(Request $request)
    {
        $messages = [
            'nama.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'id_kecamatan.required' => 'Kecamatan wajib diisi.',
            'id_kelurahan.required' => 'Kelurahan wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            'pendidikan.required' => 'Pendidikan wajib diisi.'
        ];

        $validator = $request->validate([
            'nama' => 'required|min:3',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required',
            'id_kecamatan' => 'required',
            'id_kelurahan' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'pendidikan' => 'required'
        ], $messages);
        DB::beginTransaction();
        try{
        $user = New User();
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role ="orangtua";
        if(!empty($request->google_id)) {
            $user->google_id = $request->google_id;
        }

        $user->save();


            $orangtua = new Orangtua();
            $orangtua->id_users=$user->id;
            $orangtua->nama = $request->nama;
            $orangtua->id_kecamatan = $request->id_kecamatan;
            $orangtua->id_kelurahan = $request->id_kelurahan;
            $orangtua->tempat_lahir = $request->tempat_lahir;
            $orangtua->tanggal_lahir = $request->tanggal_lahir;
            $orangtua->alamat = $request->alamat;
            $orangtua->pendidikan= $request->pendidikan;
            if(!empty($request->foto)){
                $file = $request->file('foto');
                $extension = strtolower($file->getClientOriginalExtension());
                $filename = uniqid() . '.' . $extension;
                Storage::put('public/orangtua/' . $filename, File::get($file));
               $orangtua->foto=$filename;
            }


            $orangtua->save();
            DB::commit();
            Auth::loginUsingId($user->id);
            return redirect('/');
        }catch(Exception $e){
            DB::rollback();
            return redirect('/register')->with('error','Gagal menambahkan data');
        }
    }

    // function untuk menampilkan data data anak berupa json untuk datatable dihalaman orangtua berdasarkan id orangtua ketika login
    public function dataAnak(){
        $user = Auth::user();
        $orangtua = Orangtua::Where('id_users', Auth::user()->id)->value('id');
        $anak = Anak::Where('id_orangtua',$orangtua)->get();
        return datatables()->of($anak)
        ->addColumn('action', function($row){

            // $btn = '<a href="'.route('orangtua-anak.edit',$row->id);
            // $btn = '<a href="'.route('orangtua-anak.edit',$row->id).'" class="btn btn-info "><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Periksa</a>';
            $btn =' <button type="submit"  action="'.route('orangtua-anak.destroy', $row->id).'" title="Delete" id="btn-delete" class="delete-modal btn btn-danger mt-0"><i class="fa fa-trash " ></i>Hapus</button>';
            $editProfilBtn = '<a href="'.route('orangtua-anak.editprofile',$row->id).'"  class="btn btn-warning "><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a>';


            return $editProfilBtn.' ' .$btn;
        })
        ->addColumn('tanggal_lahir', function($row){
            return $tanggal = date('d-m-Y', strtotime($row->tanggal_lahir));

         })

        ->rawColumns(['action'])->addIndexColumn()->make(true);
    }

    public function viewDashboard(Request $request){
        $user = Orangtua::with('anak')->where('id_users', Auth::user()->id)->first();

        // $user = Auth::user();
        // $orangtua = Orangtua::Where('id_users', Auth::user()->id)->value('id');
        $anak = Anak::Where('id_orangtua',$user)->get();

        if ($request->ajax()) {
            $data = PemeriksaanFisik::select('tinggi_badan','berat_badan','waktu_pemeriksaan')->where('id_anak', $request->id)->get();
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
            return response()->json([
                'type' => $request->type,
                'label' => $arrayLabel,
                'data' => $arrayData,
            ]);
        }
        return view('orangtua.dashboard.dashboard',compact('user', 'anak'));
    }

    // function untuk menampilkan data anak di halaman orangtua
    public function viewAnak()
    {
        return view('orangtua.anak.index');
    }
    // function untuk menampilkan halaman tambah anak
    public function viewTambahAnak()
    {
        return view ('orangtua.anak.create');
    }


    // function untuk menambah anak di halaman tambah anak orangtua
    public function tambahAnak(Request $request)
    {

        $messages = [
            'nama.required' => 'Nama wajib diisi.',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib diisi',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
            'no_whatsapp.required' => 'nomor whatsapp wajib diisi',
            'no_whatsapp.starts_with' => 'nomor whatsapp wajib diawali dengan +62',
            'no_whatsapp.numeric' => 'Nomor whatsapp harus berupa angka',

        ];
        $validator = $request->validate([

            'nama' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'no_whatsapp' => ['required', 'starts_with:+62','numeric'],


        ], $messages);

        $user = Auth::user();
        $orangtua = Orangtua::Where('id_users', Auth::user()->id)->value('id');

        $anak = new Anak();
        $anak->id_orangtua= $orangtua;
        $anak->nama = $request->nama;
        $anak->jenis_kelamin = $request->jenis_kelamin;
        $anak->tanggal_lahir = $request->tanggal_lahir;
        $anak->no_whatsapp = $request->no_whatsapp;



        $anak->save();

        // from original pemeriksaangigicontroller.store
        $uuid = Uuid::uuid4()->toString();
        $waktu_pemeriksaan = now();

        // $imageArray = [];
        $pgigi = new PemeriksaanGigi();
        $pgigi->id = $uuid;

        $pgigi->id_anak = $anak->id;

        $pgigi->waktu_pemeriksaan = $waktu_pemeriksaan;



        $fieldName = 'gambar1';

        // jika upload gambar dari file
        if ($request->hasFile($fieldName)) {
            $filename = uniqid() . '.' . strtolower($request->file('gambar1')->getClientOriginalExtension());
            $file = $request->file($fieldName);

            Storage::put('public/gigi/' . $filename, FacadesFile::get($file));

            $pgigi->$fieldName = $filename;
            $pgigi->gambar1 = $filename;


            $response = Http::withBasicAuth('user@senyumin.com', 'sdgasdfklsdwqorn');
            $response->attach(
                'gambar[1]',
                file_get_contents($request->gambar1),
                $request->gambar1->getClientOriginalName()
            );

            $response = $response->post(config('app.ai_url') . '/api/detect', [
                'pemeriksaan_id' => $pgigi->id,
                'nama_anak' => $pgigi->anak->nama,
                'nama_ortu' => $pgigi->anak->orangtua->nama,
                // 'nama_instansi' => 'Puskesmas ' . $pgigi->kelas->sekolah->kelurahan->kecamatan->nama,
                // 'nama_sekolah' => $pgigi->kelas->sekolah->nama,
            ])->throw()->json();

        }

        $pgigi->save();



        Alert::success('Sukses', 'Data pasien berhasil disimpan.');

        return redirect()->route('viewanak');
    }

    public function editAnak($id){
        $anak = Anak::find($id);
        return view('orangtua.anak.edit',compact('anak'));
    }
    public function editAnakProfile($id){
        $anak = Anak::find($id);
        return view('orangtua.anak.editProfile',compact('anak'));
    }

    public function pemeriksaanAnak($id)
    {
        $anak = Anak::find($id);
        Session::put('id_anak', $id);

        return view('orangtua.anak.pemeriksaan', compact('anak'));
    }



    public function updateAnak(Request $request, $id){
        $messages = [
            'nama.required' => 'Nama wajib diisi.',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib diisi',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',

        ];
        $validator = $request->validate([

            'nama' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
        ], $messages);

        $anak = Anak::find($id);
        $user = Auth::user();
        $orangtua = Orangtua::Where('id_users', Auth::user()->id)->value('id');

        $anak->nama = $request->nama;
        $anak->jenis_kelamin=$request->jenis_kelamin;
        $anak->tanggal_lahir=$request->tanggal_lahir;
        $anak->no_whatsapp=$request->no_whatsapp;



        $anak->save();
        Alert::success('Sukses', 'Data pasien berhasil diubah.');
        return redirect()->route('viewanak')->with('error',$messages);
    }

    public function deleteAnak($id){
        $anak=Anak::find($id);
        $anak->delete();
    }

    public function profil(){

        $user=User::find(Auth::user()->id);
        return view('orangtua.profil.edit',compact('user'));
    }

    public function updateProfil(Request $request){
        $user = User::find(Auth::user()->id);

        $profilorangtua = $user->profilorangtua;
        if(!$profilorangtua){
            $profilorangtua = new Orangtua();
            $profilorangtua->id_users=$user->id;
        }

        $profilorangtua->nama = $request->nama;
        $profilorangtua->tempat_lahir = $request->tempat_lahir;
        $profilorangtua->tanggal_lahir = $request->tanggal_lahir;
        $profilorangtua->pendidikan = $request->pendidikan;
        $profilorangtua->alamat = $request->alamat;

        if (!empty($request->foto)) {
            $file = $request->file('foto');
            $extension = strtolower($file->getClientOriginalExtension());
            $filename = uniqid() . '.' . $extension;
            Storage::delete('/public/orangtua/' . $profilorangtua->foto);
            Storage::put('public/orangtua/' . $filename, File::get($file));
            $profilorangtua->foto = $filename;
        }

        $profilorangtua->save();

        return redirect()->route('viewanak');

    }

    public function reservasi($id){
        $reservasi=SkriningIndeks::find($id);
        $pgigi= PemeriksaanGigi::where('id',$reservasi->id_pemeriksaan)->first();
        $anak = Anak::where('id',$pgigi->id_anak)->first();

        $klinik = Poli::get();

        return view('orangtua.reservasi.create',compact('reservasi','pgigi','anak','klinik'));
    }

    public function hasilPeriksa($id){
        $anak = Anak::where('id', $id)->first();
        $periksa = PemeriksaanGigi::where('id_anak', $anak->id)->first();
        $url = config('app.ai_url') . "/api/result-image/?pemeriksaan_id=$id";
        $response = Http::withBasicAuth('user@senyumin.com', 'sdgasdfklsdwqorn')->get($url);

        $decodedImage = null; // Initialize the variable

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
                        // Break out of the loop as you only want one image
                        break;
                    }
                }
            }
        }

        return view('orangtua.anak.hasil', compact('anak', 'periksa', 'decodedImage'));
    }

}
