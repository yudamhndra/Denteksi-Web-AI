<div>
    <div class="mb-3">
        <label class="col-md-12 mb-2"> Ayah / Ibu memiliki karies yang tidak ditambal? </label>
        <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" value="ya" name="rksoal1" id="radioInline"  {{ (@$data->resikoKaries->rksoal1=="ya")? "checked" : "" }}>
            <label class="form-check-label" for="radioInline">
                Ya
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input type="radio" value="tidak" class="form-check-input" name="rksoal1" id="radioInline1" {{ (@$data->resikoKaries->rksoal1=="tidak")? "checked" : "" }}>
            <label class="form-check-label" for="radioInline1">
                Tidak
            </label>
        </div>
    </div>
    <div class="mb-3">
        <label class="col-md-12 mb-2"> Orangtua memiliki sosioekonomi rendah? </label>
        <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" value="ya" name="rksoal2" id="radioInline" {{ (@$data->resikoKaries->rksoal2=="ya")? "checked" : "" }}>
            <label class="form-check-label" for="radioInline">
                Ya
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input type="radio" value="tidak" class="form-check-input" name="rksoal2" id="radioInline1" {{ (@$data->resikoKaries->rksoal2=="tidak")? "checked" : "" }}>
            <label class="form-check-label" for="radioInline1">
                Tidak
            </label>
        </div>
    </div>
    <div class="mb-3">
        <label class="col-md-12 mb-2"> Anak makan makanan ringan dan minuman manis (termasuk minuman bersoda) lebih dari 3x perhari </label>
        <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" value="ya" name="rksoal3" id="radioInline" {{ (@$data->resikoKaries->rksoal3=="ya")? "checked" : "" }}>
            <label class="form-check-label" for="radioInline">
                Ya
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input type="radio" value="tidak" class="form-check-input" name="rksoal3" id="radioInline1" {{ (@$data->resikoKaries->rksoal3=="tidak")? "checked" : "" }}>
            <label class="form-check-label" for="radioInline1">
                Tidak
            </label>
        </div>
    </div>
    <div class="mb-3">
        <label class="col-md-12 mb-2"> Anak minum susu botol atau ASI sebagai pengantar tidur </label>
        <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" value="ya" name="rksoal4" id="radioInline" {{ (@$data->resikoKaries->rksoal4=="ya")? "checked" : "" }}>
            <label class="form-check-label" for="radioInline">
                Ya
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input type="radio" value="tidak" class="form-check-input" name="rksoal4" id="radioInline1"{{ (@$data->resikoKaries->rksoal4=="tidak")? "checked" : "" }}>
            <label class="form-check-label" for="radioInline1">
                Tidak
            </label>
        </div>
    </div>
    <div class="mb-3">
        <label class="col-md-12 mb-2"> Anak berkebutuhan khusus </label>
        <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" value="ya" name="rksoal5" id="radioInline"{{ (@$data->resikoKaries->rksoal5=="ya")? "checked" : "" }}>
            <label class="form-check-label" for="radioInline">
                Ya
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input type="radio" value="tidak" class="form-check-input" name="rksoal5" id="radioInline1" {{ (@$data->resikoKaries->rksoal5=="tidak")? "checked" : "" }}>
            <label class="form-check-label" for="radioInline1">
                Tidak
            </label>
        </div>
    </div>
    <div class="mb-3">
        <label class="col-md-12 mb-2"> Anak baru pindah dari daerah tertentu </label>
        <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" value="ya" name="rksoal6" id="radioInline" {{ (@$data->resikoKaries->rksoal6=="ya")? "checked" : "" }}>
            <label class="form-check-label" for="radioInline">
                Ya
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input type="radio" value="tidak" class="form-check-input" name="rksoal6" id="radioInline1" {{ (@$data->resikoKaries->rksoal6=="tidak")? "checked" : "" }}>
            <label class="form-check-label" for="radioInline1">
                Tidak
            </label>
        </div>
    </div>
    <div class="mb-3">
        <label class="col-md-12 mb-2"> Anak mengkonsumsi vitamin mengandung fluoride </label>
        <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" value="ya" name="rksoal7" id="radioInline" {{ (@$data->resikoKaries->rksoal7=="ya")? "checked" : "" }}>
            <label class="form-check-label" for="radioInline">
                Ya
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input type="radio" value="tidak" class="form-check-input" name="rksoal7" id="radioInline1" {{ (@$data->resikoKaries->rksoal7=="tidak")? "checked" : "" }}>
            <label class="form-check-label" for="radioInline1">
                Tidak
            </label>
        </div>
    </div>
    <div class="mb-3">
        <label class="col-md-12 mb-2"> Anak menyikat gigi 2x sehari secara teratur dan waktu yang tepat menggunakan pasta gigi mengandung fluoride </label>
        <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" value="ya" name="rksoal8" id="radioInline" {{ (@$data->resikoKaries->rksoal8=="ya")? "checked" : "" }}>
            <label class="form-check-label" for="radioInline">
                Ya
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input type="radio" value="tidak" class="form-check-input" name="rksoal8" id="radioInline1"{{ (@$data->resikoKaries->rksoal8=="tidak")? "checked" : "" }}>
            <label class="form-check-label" for="radioInline1">
                Tidak
            </label>
        </div>
    </div>
    <div class="mb-3">
        <label class="col-md-12 mb-2"> Anak kontrol ke dokter gigi 6 bulan sekali</label>
        <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" value="ya" name="rksoal9" id="radioInline" {{ (@$data->resikoKaries->rksoal9=="ya")? "checked" : "" }}>
            <label class="form-check-label" for="radioInline">
                Ya
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input type="radio" value="tidak" class="form-check-input" name="rksoal9" id="radioInline1" {{ (@$data->resikoKaries->rksoal9=="tidak")? "checked" : "" }}>
            <label class="form-check-label" for="radioInline1">
                Tidak
            </label>
        </div>
    </div>
    <div class="mb-3">
        <label class="col-md-12 mb-2"> Anak memiliki karies/missing/filling</label>
        <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" value="ya" name="rksoal10" id="radioInline" {{ (@$data->resikoKaries->rksoal10=="ya")? "checked" : "" }}>
            <label class="form-check-label" for="radioInline">
                Ya
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input type="radio" value="tidak" class="form-check-input" name="rksoal10" id="radioInline1" {{ (@$data->resikoKaries->rksoal10=="tidak")? "checked" : "" }}>
            <label class="form-check-label" for="radioInline1">
                Tidak
            </label>
        </div>
    </div>
    <div class="mb-3">
        <label class="col-md-12 mb-2"> Anak memiliki karies/missing/filling</label>
        <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" value="ya" name="rksoal11" id="radioInline" {{ (@$data->resikoKaries->rksoal11=="ya")? "checked" : "" }}>
            <label class="form-check-label" for="radioInline">
                Ya
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input type="radio" value="tidak" class="form-check-input" name="rksoal11" id="radioInline1" {{ (@$data->resikoKaries->rksoal11=="tidak")? "checked" : "" }}>
            <label class="form-check-label" for="radioInline1">
                Tidak
            </label>
        </div>
    </div>
    <div class="mb-3">
        <label class="col-md-12 mb-2"> Anak memiliki whitespot</label>
        <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" value="ya" name="rksoal12" id="radioInline "{{ (@$data->resikoKaries->rksoal12=="ya")? "checked" : "" }}>
            <label class="form-check-label" for="radioInline">
                Ya
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input type="radio" value="tidak" class="form-check-input" name="rksoal12" id="radioInline1" {{ (@$data->resikoKaries->rksoal12=="tidak")? "checked" : "" }}>
            <label class="form-check-label" for="radioInline1">
                Tidak
            </label>
        </div>
    </div>
    <div class="mb-3">
        <label class="col-md-12 mb-2"> Anak memiliki plak</label>
        <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" value="ya" name="rksoal13" id="radioInline" {{ (@$data->resikoKaries->rksoal13=="ya")? "checked" : "" }}>
            <label class="form-check-label" for="radioInline">
                Ya
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input type="radio" value="tidak" class="form-check-input" name="rksoal13" id="radioInline1" {{ (@$data->resikoKaries->rksoal13=="tidak")? "checked" : "" }}>
            <label class="form-check-label" for="radioInline1">
                Tidak
            </label>
        </div>
    </div>
</div>
