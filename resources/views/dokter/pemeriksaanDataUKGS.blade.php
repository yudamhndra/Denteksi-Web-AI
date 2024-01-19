@extends('layout.master')

@section('content')


<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Pemeriksaan Gigi</a></li>
            <li class="breadcrumb-item active" aria-current="page"><--- User ----></li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div id="wizard">
                        <h2>Pengisian Odontogram</h2>
                        <section>
                            <h4>First Step</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ut nulla nunc. Maecenas arcu
                                sem, hendrerit a tempor quis,
                                sagittis accumsan tellus. In hac habitasse platea dictumst. Donec a semper dui. Nunc eget
                                quam libero. Nam at felis metus.
                                Nam tellus dolor, tristique ac tempus nec, iaculis quis nisi.</p>
                        </section>
    
                        <h2>Skrining Indeks</h2>
                        <section>
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">SKOR def t</h6>
                                        <form class="forms-sample">
                                            <div class="row mb-3">
                                                <label for="d" class="col-sm-1 col-form-label">d</label>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" id="exampleInputD"
                                                        placeholder="0">
                                                </div>
                                                <label for="e" class="col-sm-1 col-form-label">e</label>
                                                <div class="col-sm-2">
                                                    <input type="email" class="form-control" id="exampleInputE"
                                                        placeholder="0">
                                                </div>
                                                <label for="f" class="col-sm-1 col-form-label">f</label>
                                                <div class="col-sm-2">
                                                    <input type="number" class="form-control" id="exampleInputF"
                                                        placeholder="0">
                                                </div>
                                            </div>
                                        </form>
                                        <form class="forms-sample">
                                            <div class="row mb-3">
                                                <label for="readonlyDEFT" class="col-sm-1 col-form-label">def-t</label>
                                                <div class="col-sm-1">
                                                    <input type="text" class="form-control" id="exampleDEFT" readonly
                                                        value="0">
                                                </div>
                                            </div>
                                        </form>
                                        <h6 class="card-title">SKOR DMF-T</h6>
                                        <form class="forms-sample">
                                            <div class="row mb-3">
                                                <label for="d" class="col-sm-1 col-form-label">d</label>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" id="exampleInputUsername2"
                                                        placeholder="0">
                                                </div>
                                                <label for="m" class="col-sm-1 col-form-label">e</label>
                                                <div class="col-sm-2">
                                                    <input type="email" class="form-control" id="exampleInputEmail2"
                                                        placeholder="0">
                                                </div>
                                                <label for="f" class="col-sm-1 col-form-label">f</label>
                                                <div class="col-sm-2">
                                                    <input type="number" class="form-control" id="exampleInputMobile"
                                                        placeholder="0">
                                                </div>
                                            </div>
                                        </form>
                                        <form class="forms-sample">
                                            <div class="row mb-3">
                                                <label for="readonlyDMFT" class="col-sm-1 col-form-label">DMF-T</label>
                                                <div class="col-sm-1">
                                                    <input type="text" class="form-control" id="exampleDEFT" readonly
                                                        value="0">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <h2>Hasil Pemeriksaan</h2>
                        <section>
                            <form class="forms-sample">
                                <div class="row mb-3">
                                    <label for="diagnosa" class="col-sm-2 col-form-label">Diagnosa</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="exampleInputD"
                                            placeholder="isi diagnosa...">
                                    </div>
                                </div>
                            </form>
                            <form class="forms-sample">
                                <div class="row mb-3">
                                    <label for="rekomendasi" class="col-sm-2 col-form-label">Rekomendasi</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="exampleInputD"
                                            placeholder="isi rekomendasi...">
                                    </div>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card" id="keterangan">
                <div class="card-body">
                    <p class="text-muted">KETERANGAN: </p>

                    <div class="mt-2">
                        <div class="row mb-3">
                            <label for="#" class="col-sm-2 col-form-label">Sisa Akar</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="exampleInputDisabled1" disabled value="2">
                                <p>Gigi-14    Gigi-15</p>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="#" class="col-sm-2 col-form-label">Gigi Akar</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="exampleInputDisabled1" disabled value="2">
                                <p>Gigi-14    Gigi-15</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection