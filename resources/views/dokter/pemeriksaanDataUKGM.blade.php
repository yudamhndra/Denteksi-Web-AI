@extends('layout.master')

@section('content')

<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Pemeriksaan Gigi</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                <--- User ---->
            </li>
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
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ut nulla nunc. Maecenas
                                arcu
                                sem, hendrerit a tempor quis,
                                sagittis accumsan tellus. In hac habitasse platea dictumst. Donec a semper dui. Nunc
                                eget
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

                        <h2>Peneliaian Resiko Karies</h2>
                        <section>
                            <div class="container p-1">
                                <div class="row">
                                    <div class="col-md-15 grid-margin stretch-card">
                                        <div class="card bg-light ">
                                            <div class="card-body">
                                                <div class="card-text">
                                                    <p style="font-weight:bold;">PENILIAN RISIKO KARIES</p>
                                                    <div class="row mb-3 ">
                                                        <label for="nama" class="col-sm-3 col-form-label">Penilaian
                                                            Risiko
                                                            Karies Anak
                                                        </label>
                                                        <div class="col-sm-5">
                                                            <select class="js-example-basic-single form-select"
                                                                data-width="100%" placeholder="Pilih Posyandu">
                                                                <option selected disabled>Pilih Risiko</option>
                                                                <option value="#">Option 1</option>
                                                                <option value="#">Option 2</option>
                                                                <option value="#">Option 3</option>
                                                                <option value="#">Option 4</option>
                                                                <option value="#">Option 5</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container p-1">
                                    <form action="#" method="post">
                                        <p style="font-weight:500;" class="mb-2">Ayah/ Ibu memiliki karies yang tidak ditambal?</p>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="radioDefault"
                                                id="radioDefault">
                                            <label class="form-check-label" for="radioDefault">
                                                Ya
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline mb-3" >
                                            <input type="radio" class="form-check-input" name="radioDefault"
                                                id="radioDefault1">
                                            <label class="form-check-label" for="radioDefault1">
                                                Tidak
                                            </label>
                                        </div>
                                    </form>
                                    <form action="#" method="post">
                                        <p style="font-weight:500;" class="mb-2">Orang tua memiliki sosioekonomi rendah?</p>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="radioDefault"
                                            id="radioDefault2">
                                        <label class="form-check-label" for="radioDefault2">
                                            Ya
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline mb-3">
                                        <input type="radio" class="form-check-input" name="radioDefault"
                                            id="radioDefault13">
                                        <label class="form-check-label" for="radioDefault3">
                                            Tidak
                                        </label>
                                    </div>
                                    </form>
                                    <form action="#" method="post">
                                        <p style="font-weight:500;" class="mb-2">Anak makan makanan ringan dan minuman manis (termasuk minuman bersoda) lebih dari 3x perhari?</p>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="radioDefault"
                                            id="radioDefault4">
                                        <label class="form-check-label" for="radioDefault4">
                                            Ya
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline mb-3">
                                        <input type="radio" class="form-check-input" name="radioDefault"
                                            id="radioDefault5">
                                        <label class="form-check-label" for="radioDefault5">
                                            Tidak
                                        </label>
                                    </div>
                                    </form>
                                    <form action="#" method="post">
                                        <p style="font-weight:500;" class="mb-2">Anak minum susu botol atau ASI sebagai pengantar tidur?</p>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="radioDefault"
                                            id="radioDefault6">
                                        <label class="form-check-label" for="radioDefault6">
                                            Ya
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline mb-3">
                                        <input type="radio" class="form-check-input" name="radioDefault"
                                            id="radioDefault7">
                                        <label class="form-check-label" for="radioDefault7">
                                            Tidak
                                        </label>
                                    </div>
                                    </form>
                                    <form action="#" method="post">
                                        <p style="font-weight:500;" class="mb-2">Anak baru pindah dari daerah tertentu? </p>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="radioDefault"
                                                id="radioDefault10">
                                            <label class="form-check-label" for="radioDefault10">
                                                Ya
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline mb-3">
                                            <input type="radio" class="form-check-input" name="radioDefault"
                                                id="radioDefault11">
                                            <label class="form-check-label" for="radioDefault11">
                                                Tidak
                                            </label>
                                        </div>
                                    </form>
                                    <form action="#" method="post">
                                        <p style="font-weight:500;" class="mb-2">Anak mengkonsumsi vitamin mengandung fluoride?</p>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="radioDefault"
                                            id="radioDefault12">
                                        <label class="form-check-label" for="radioDefault12">
                                            Tidak
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline mb-3">
                                        <input type="radio" class="form-check-input" name="radioDefault"
                                            id="radioDefault13">
                                        <label class="form-check-label" for="radioDefault13">
                                            Ya
                                        </label>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </section>

                        <h2>Hasil Pemeriksaan</h2>
                        <section>
                            <form class="forms-sample">
                                <div class="row mb-3">
                                    <label for="diagnosa" class="col-sm-2 col-form-label">Resiko Karies</label>
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
                    <p> - </p>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
