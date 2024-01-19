<?php

namespace App\Http\Controllers;

use App\Models\PemeriksaanMata;
use Illuminate\Http\Request;
use App\Models\Anak;
use App\Models\Orangtua;
use Auth;

class PemeriksaanMataController extends Controller
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
    public function create()
    {
    
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
     * @param  \App\Models\PemeriksaanMata  $pemeriksaanMata
     * @return \Illuminate\Http\Response
     */
    public function show(PemeriksaanMata $pemeriksaanMata)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PemeriksaanMata  $pemeriksaanMata
     * @return \Illuminate\Http\Response
     */
    public function edit(PemeriksaanMata $pemeriksaanMata)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PemeriksaanMata  $pemeriksaanMata
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PemeriksaanMata $pemeriksaanMata)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PemeriksaanMata  $pemeriksaanMata
     * @return \Illuminate\Http\Response
     */
    public function destroy(PemeriksaanMata $pemeriksaanMata)
    {
        //
    }
}
