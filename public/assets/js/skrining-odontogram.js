$(document).ready(function(){
    let action, x, y, filled;
    $('.btn-group-aksi').click(function(){
        action = $(this).attr('id');
        $('.btn-aksi').removeClass('btn-success').addClass('btn-light');
        $(this).removeClass('btn-light').addClass('btn-success');
    });

    $(document).on("click", "polygon,text,line", function (evt) {
        let color,type,element;
        var odontogram = $(evt.target);
        var odontogramParent = odontogram.parent().attr('id');
        var odontogramId = odontogramParent + '-' +odontogram.attr('id');

        let foundParent = Object.keys(arrayAksi).filter(function(key) {
            return arrayAksi[key].includes(odontogramParent);
        });


        let foundParentId = Object.keys(arrayAksi).filter(function(key) {
            return arrayAksi[key].includes(odontogramId);
        });

        switch (action) {
            case 'belum-erupsi':
                if (foundParent < 1) {
                    type = 'insert-text';
                    x = 1.5; y = 15;
                    color = '#5D5FEF';
                    style = 'font-size: 10pt;font-weight:bold;cursor:default';
                    element = 'UE';
                    arrayAksi['belum-erupsi'].push(odontogramParent);
                    filled = true;
                }
                break;
            case 'erupsi-sebagian':
                if (foundParent < 1) {
                    type = 'insert-text';
                    x = 1.5; y = 15;
                    color = '#5D5FEF';
                    style = 'font-size: 10pt;font-weight:bold;cursor:default';
                    element = 'PE'
                    arrayAksi['erupsi-sebagian'].push(odontogramParent);
                    filled = true;
                }
                break;
            case 'karies':
                if (foundParentId < 1) {
                    color = 'grey';
                    arrayAksi['karies'].push(odontogramId);
                    filled = true;
                    let d = 0, D = 0;
                    let check = parseInt(odontogramParent.replace('p',''))
                    if (55 <= check && check <= 85) {
                        d++;
                        let skor = parseInt($(".skor-d").val());
                        $(".skor-d").val(skor+d);
                    } else if (11 <= check && check <= 48) {
                        D++;
                        let skor = parseInt($(".skor-D").val());
                        $(".skor-D").val(skor+D);
                    }
                }
                break;
            case 'non-vital':
                if (foundParent < 1) {
                    type = 'insert-non-vital';
                    arrayAksi['non-vital'].push(odontogramParent);
                    style = 'stroke-width:2';
                    color = '#C71616';
                    filled = true;
                }
                break;
            case 'tambalan-logam':
                if (foundParentId < 1) {
                    color = 'pink';
                    arrayAksi['tambalan-logam'].push(odontogramId);
                    filled = true;
                    let d = 0, D = 0;
                    let check = parseInt(odontogramParent.replace('p',''))
                    if (55 <= check && check <= 85) {
                        d++;
                        let skor = parseInt($(".skor-f").val());
                        $(".skor-f").val(skor+d);
                    } else if (11 <= check && check <= 48) {
                        D++;
                        let skor = parseInt($(".skor-F").val());
                        $(".skor-F").val(skor+D);
                    }
                }
                break;
            case 'tambalan-non-logam':
                if (foundParentId < 1) {
                    color = 'blue';
                    arrayAksi['tambalan-non-logam'].push(odontogramId)
                    filled = true;
                    let d = 0, D = 0;
                    let check = parseInt(odontogramParent.replace('p',''))
                    if (55 <= check && check <= 85) {
                        d++;
                        let skor = parseInt($(".skor-f").val());
                        $(".skor-f").val(skor+d);
                    } else if (11 <= check && check <= 48) {
                        D++;
                        let skor = parseInt($(".skor-F").val());
                        $(".skor-F").val(skor+D);
                    }
                }
                break;
            case 'mahkota-logam':
                if (foundParentId < 1) {
                    color = 'green';
                    arrayAksi['mahkota-logam'].push(odontogramId);
                    filled = true;
                    let d = 0, D = 0;
                    let check = parseInt(odontogramParent.replace('p',''))
                    if (55 <= check && check <= 85) {
                        d++;
                        let skor = parseInt($(".skor-f").val());
                        $(".skor-f").val(skor+d);
                    } else if (11 <= check && check <= 48) {
                        D++;
                        let skor = parseInt($(".skor-F").val());
                        $(".skor-F").val(skor+D);
                    }
                }
                break;
            case 'mahkota-non-logam':
                if (foundParentId < 1) {
                    color = '#66D1D1';
                    arrayAksi['mahkota-non-logam'].push(odontogramId);
                    filled = true;
                    let d = 0, D = 0;
                    let check = parseInt(odontogramParent.replace('p',''))
                    if (55 <= check && check <= 85) {
                        d++;
                        let skor = parseInt($(".skor-f").val());
                        $(".skor-f").val(skor+d);
                    } else if (11 <= check && check <= 48) {
                        D++;
                        let skor = parseInt($(".skor-F").val());
                        $(".skor-F").val(skor+D);
                    }
                }
                break;
            case 'sisa-akar':
                if (foundParent < 1) {
                    type = 'insert-text';
                    x = 3.5; y = 17;
                    color = '#5D5FEF';
                    style = 'font-size: 15pt;font-weight:bold;cursor:default';
                    element = 'V'
                    arrayAksi['sisa-akar'].push(odontogramParent);
                    let d = 0, D = 0;
                    let check = parseInt(odontogramParent.replace('p',''))
                    if (55 <= check && check <= 85) {
                        d++;
                        let skor = parseInt($(".skor-e").val());
                        $(".skor-e").val(skor+d);
                    } else if (11 <= check && check <= 48) {
                        D++;
                        let skor = parseInt($(".skor-M").val());
                        $(".skor-M").val(skor+D);
                    }
                    filled = true;
                }
                break;
            case 'gigi-hilang':
                if (foundParent < 1) {
                    type = 'insert-text';
                    x = 3.5; y = 17;
                    color = '#C71616';
                    style = 'font-size: 15pt;font-weight:bold;cursor:default';
                    element = 'X'
                    arrayAksi['gigi-hilang'].push(odontogramParent);
                    let d = 0, D = 0;
                    let check = parseInt(odontogramParent.replace('p',''))
                    if (55 <= check && check <= 85) {
                        d++;
                        let skor = parseInt($(".skor-e").val());
                        $(".skor-e").val(skor+d);
                    } else if (11 <= check && check <= 48) {
                        D++;
                        let skor = parseInt($(".skor-M").val());
                        $(".skor-M").val(skor+D);
                    }
                    filled = true;
                }
                break;
            case 'jembatan':
                if (foundParent < 1) {
                    type = 'insert-line';
                    color = '#048A3F';
                    style = 'stroke-width:2';
                    arrayAksi['jembatan'].push(odontogramParent);
                    filled = true;
                }
                break;
            case 'gigi-tiruan-lepas':
                if (foundParent < 1) {
                    type = 'insert-line';
                    color = '#E4AA04';
                    style = 'stroke-width:2';
                    arrayAksi['gigi-tiruan-lepas'].push(odontogramParent);
                    filled = true;
                }
                break;
            case 'hapus-aksi':
                filled = true;
                Object.keys(arrayAksi).filter(function(key) {
                    arrayAksi[key] = arrayAksi[key].filter(e => e !== odontogramParent);
                    arrayAksi[key] = arrayAksi[key].filter(e => e !== odontogramId);
                });
                switch ($(this).attr('type')) {
                    case 'insert-text':
                        d3.select("text#"+odontogramParent).remove();
                        break;
                    case 'insert-line':
                        d3.select("line#"+odontogramParent).remove();
                        break;
                    case 'insert-non-vital':
                        d3.select("line#"+odontogramParent).remove();
                        d3.select("line#"+odontogramParent).remove();
                        d3.select("line#"+odontogramParent).remove();
                        break;
                    case 'insert-fill':
                        odontogram.attr('fill', 'white');
                        break;
                }
                break;
        }

        // console.log(arrayAksi);

        if (type == 'insert-text') {
            d3.select('g#'+odontogramParent).append('text').attr('id',odontogramParent).attr('type','insert-text').attr('x', x).attr('y', y).attr('stroke', color).attr('fill', color).attr('stroke-width', '0.1').attr('style', style).text(element);
        } else if (type == 'insert-line') {
            d3.select('g#'+odontogramParent).append('line').attr('id',odontogramParent).attr('type','insert-line').attr('x1', '20').attr('y1', '10').attr('x2', '0').attr('y2', '10').attr('stroke',color).attr('style', style);
        } else if (type == 'insert-non-vital') {
            d3.select('g#'+odontogramParent).append('line').attr('id',odontogramParent).attr('type','insert-non-vital').attr('x1', '5').attr('y1', '15').attr('x2', '0').attr('y2', '15').attr('stroke',color).attr('style', style);
            d3.select('g#'+odontogramParent).append('line').attr('id',odontogramParent).attr('type','insert-non-vital').attr('x1', '15').attr('y1', '5').attr('x2', '5').attr('y2', '15').attr('stroke',color).attr('style', style);
            d3.select('g#'+odontogramParent).append('line').attr('id',odontogramParent).attr('type','insert-non-vital').attr('x1', '20').attr('y1', '5').attr('x2', '15').attr('y2', '5').attr('stroke',color).attr('style', style);
        } else {
            odontogram.attr('fill', color).attr('type','insert-fill');
        }

        if (filled) {
            $.each(arrayAksi, function(index, value) {
                $("#keterangan").find("input[id='field-"+index+"']").val(arrayAksi[index].length);
                $("#keterangan").find("input[id='h-"+index+"']").val(value.toString());
                $("#keterangan").find("input[id='field-"+index+"']").parent().find('span').text(value.toString().toUpperCase());
            });
            // let total_skor = arrayAksi['gigi-hilang'].length + arrayAksi['sisa-akar'].length + arrayAksi['karies'].length + arrayAksi['tambalan-logam'].length + arrayAksi['tambalan-non-logam'].length + arrayAksi['mahkota-logam'].length + arrayAksi['mahkota-non-logam'].length;
            $("input[name='def_t']").val(parseInt($(".skor-d").val()) + parseInt($(".skor-e").val()) + parseInt($(".skor-f").val()));
            $("input[name='dmf_t']").val(parseInt($(".skor-D").val()) + parseInt($(".skor-M").val()) + parseInt($(".skor-F").val()));
            filled = false;
        }
    });


});
