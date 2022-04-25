if ($('#id_programacion_acc_b').val().length != " "){//FUNCION EN DONDE SE CARGA LA TABLA DE IFF
    var id_programacion = $('#id_programacion_acc_b').val();
    var separar   = id_programacion.split("/");
    var id_p_programacion = separar['0'];
    var id_p_acc_centralizada = separar['1'];

    //var base_url =window.location.origin+'/asnc/index.php/Programacion/ver_acc_editar';
    var base_url = '/index.php/Programacion/ver_acc_editar';
    $.ajax({
       url:base_url,
       method: 'post',
       data: {id_p_acc_centralizada: id_p_acc_centralizada},
       dataType: 'json',

        success: function(data){
            $("#target_acc_ff tbody").html('');
            if(data != null && $.isArray(data)){
                $.each(data, function(index, value){

                    var newRow = document.createElement('tr');

                    var increment = increment +1;
                    newRow.className='myTr';
                    newRow.innerHTML = `
                        <td>${value.codigopartida_presupuestaria}<input type="text" name="par_presupuestaria_acc_ff[]" id="ins-type-${increment}" hidden value="${ value.id_partidad_presupuestaria}"></td>

                        <td>${value.desc_partida_presupuestaria}<input type="text" name="des_par_presupuestaria_ff[]" id="ins-type-${increment}" hidden value="${ value.desc_partida_presupuestaria}"></td>

                        <td>${value.id_estado}<input type="text" name="id_estado_acc[]" id="ins-subtype-${increment}" hidden value="${value.id_estado} "></td>

                        <td>${value.desc_fuente_financiamiento}<input type="text" hidden name="fuente_financiamiento_acc[]" id="ins-pres-${increment}" value="${value.id_fuente_financiamiento}"></td>

                        <td>${value.porcentaje}<input type="text" hidden name="porcentaje_acc[]" id="ins-pres-${increment}" value="${value.porcentaje}"></td>
                    `;

                    var cellremove_medBtn = createCell();
                    cellremove_medBtn.appendChild(createremove_medBtn())
                    newRow.appendChild(cellremove_medBtn);

                    document.querySelector('#target_acc_ff tbody').appendChild(newRow);

                    function remove_med() {
                	       var row = this.parentNode.parentNode;
                           document.querySelector('#target_acc_ff tbody')
                           .removeChild(row);
                    }

                    function createremove_medBtn() {
                        var btnremove_med = document.createElement('button');
                        btnremove_med.className = 'btn btn-xs btn-danger';
                        btnremove_med.onclick = remove_med;
                        btnremove_med.innerText = 'Descartar';
                        return btnremove_med;
                    }
                });
            }
        }
    })
}

if ($('#id_programacion_acc_b').val().length != " "){//FUNCION EN DONDE SE CARGA LA TABLA DE IP
    var id_programacion = $('#id_programacion_acc_b').val();
    var separar   = id_programacion.split("/");
    var id_p_programacion = separar['0'];
    var id_p_acc_centralizada = separar['1'];

    //var base_url =window.location.origin+'/asnc/index.php/Programacion/ver_acc_editar_items_b';
    var base_url = '/index.php/Programacion/ver_acc_editar_items_b';
    $.ajax({
       url:base_url,
       method: 'post',
       data: {id_p_acc_centralizada: id_p_acc_centralizada},
       dataType: 'json',

        success: function(data){
            $("#target_req_acc tbody").html('');
            if(data != null && $.isArray(data)){
                $.each(data, function(index, value){
                    var newRow = document.createElement('tr');

                    var increment = increment +1;
                    newRow.className='myTr';
                    newRow.innerHTML = `

                    <td>${value.id_p_items}<input type="text" name="id_p_items[]" id="ins-type-${increment}" hidden value="${value.id_p_items}"></td>

                    <td>${value.codigopartida_presupuestaria}<input type="text" name="par_presupuestaria_acc[]" id="ins-type-${increment}" hidden value="${value.id_partidad_presupuestaria}"></td>

                    <td>${value.desc_ccnu}<input type="text" name="id_ccnu_acc[]" id="ins-type-${increment}" hidden value="${value.id_ccnu}"></td>

                    <td>${value.especificacion}<input type="text" name="especificacion_acc[]" id="ins-subtype-${increment}" hidden value="${value.especificacion}"></td>
                    <td>${value.desc_unidad_medida}<input type="text" name="id_unidad_medida_acc[]" id="ins-subtype-${increment}" hidden value="${value.id_unidad_medida}"></td>

                    <td>${value.cantidad}<input type="text" name="cantidad_acc[]" id="ins-subtype-${increment}" hidden value="${value.cantidad}"></td>

                    <td>${value.i}<input type="text" hidden name="I_acc[]" id="ins-pres-${increment}" value="${value.i}"></td>
                    <td>${value.ii}<input type="text" hidden name="II_acc[]" id="ins-pres-${increment}" value="${value.ii}"></td>
                    <td>${value.iii}<input type="text" hidden name="III_acc[]" id="ins-pres-${increment}" value="${value.iii}"></td>
                    <td>${value.iv}<input type="text" hidden name="IV_acc[]" id="ins-pres-${increment}" value="${value.iv}"></td>

                    <td>${value.cant_total_distribuir}<input type="text" name="cant_total_distribuir_acc[]" id="ins-subtype-${increment}" hidden value="${value.cant_total_distribuir}"></td>

                    <td>${value.costo_unitario}<input type="text" hidden name="costo_unitario_acc[]" id="ins-pres-${increment}" value="${value.costo_unitario}"></td>

                    <td>${value.precio_total}<input type="text" hidden name="precio_total_acc[]" id="ins-pres-${increment}" value="${value.precio_total}"></td>
                    <td>${value.alicuota_iva}<input type="text" hidden name="id_alicuota_iva_acc[]" id="ins-pres-${increment}" value="${value.alicuota_iva}"></td>
                    <td>${value.iva_estimado}<input type="text" hidden name="iva_estimado_acc[]" id="ins-pres-${increment}" value="${value.iva_estimado}"></td>
                    <td>${value.monto_estimado}<input type="text" hidden name="monto_estimado_acc[]" id="ins-pres-${increment}" value="${value.monto_estimado}"></td>

                    <td>
                        <button type="button" class="btn btn-info btn-xs" data-toggle="modal" id="editar" onclick="editar_modal_b(${value.id_p_items});" data-target="#myModal_b"><i class="fas fa-lg fa-fw fa-edit"></i></button>
                    </td>`;

                    var cellremove_medBtn = createCell();
                    cellremove_medBtn.appendChild(createremove_medBtn())
                    newRow.appendChild(cellremove_medBtn);

                    document.querySelector('#target_req_acc tbody').appendChild(newRow);

                    function remove_med() {
                	       var row = this.parentNode.parentNode;
                           document.querySelector('#target_req_acc tbody')
                           .removeChild(row);
                    }

                    function createremove_medBtn() {
                        var btnremove_med = document.createElement('button');
                        btnremove_med.className = 'btn btn-xs btn-danger';
                        btnremove_med.onclick = remove_med;
                        btnremove_med.innerText = 'Descartar';
                        return btnremove_med;
                    }
                });
            }
        }
    })
}

function editar_modal_b(id){
    var id_items_proy = id

    //var base_url =window.location.origin+'/asnc/index.php/Programacion/cons_items_acc_b';
    //var base_url1 =window.location.origin+'/asnc/index.php/Programacion/llenar_par_pre_mod';
    //var base_url2 =window.location.origin+'/asnc/index.php/Programacion/llenar_uni_med_mod';
    //var base_url3 =window.location.origin+'/asnc/index.php/Programacion/llenar_alic_iva_mod';

    var base_url = '/index.php/Programacion/cons_items_acc_b';
    var base_url1 = '/index.php/Programacion/llenar_par_pre_mod';
    var base_url2 = '/index.php/Programacion/llenar_uni_med_mod';
    var base_url3 = '/index.php/Programacion/llenar_alic_iva_mod';

    $.ajax({
        url:base_url,
        method: 'post',
        data: {id_items_proy: id_items_proy},
        dataType: 'json',
        success: function(response){
            $('#id_items_b').val(id);

            $('#id_part_pres_b').val(response['id_partidad_presupuestaria']);
            $('#cod_partida_pre_b').val(response['codigopartida_presupuestaria']);
            $('#partida_pre_b').val(response['desc_partida_presupuestaria']);

            $('#id_ccnu_mod_b').val(response['id_ccnu']);
            $('#ccnu_mod_b').val(response['desc_ccnu']);

            $('#esp_b').val(response['especificacion']);

            $('#id_unid_med_b').val(response['id_unidad_medida']);
            $('#unid_med_b').val(response['desc_unidad_medida']);

            $('#cantidad_mod_b').val(response['cantidad']);
            $('#primero_b').val(response['i']);
            $('#segundo_b').val(response['ii']);
            $('#tercero_b').val(response['iii']);
            $('#cuarto_b').val(response['iv']);
            $('#cant_total_distribuir_mod_b').val(response['cant_total_distribuir']);

            $('#costo_unitario_mod_b').val(response['costo_unitario']);
            $('#precio_total_mod_b').val(response['precio_total']);
            $('#ali_iva_e_b').val(response['alicuota_iva']);
            $('#iva_estimado_mod_b').val(response['iva_estimado']);
            $('#monto_estimado_mod_b').val(response['monto_estimado']);

            //CALCULOS PARA LOS TRIMESTRES ESTIMADOS
            var cant_t = Number(response['i']) + Number(response['ii']) + Number(response['iii']) + Number(response['iv'])
            var monto_esti = response['monto_estimado']
            var newstr = monto_esti.replace('.', "");
            var newstr2 = newstr.replace('.', "");
            var newstr3 = newstr2.replace('.', "");
            var newstr4 = newstr3.replace('.', "");
            var monto_est = newstr4.replace(',', ".");

            var prim_es = (monto_est/cant_t)*Number(response['i'])
            var prim_esti = parseFloat(prim_es).toFixed(2);
            var prim_est  = Intl.NumberFormat("de-DE").format(prim_esti);
            $('#estimado_primer').val(prim_est);

            var segund_es = (monto_est/cant_t)*Number(response['ii'])
            var segund_esti = parseFloat(segund_es).toFixed(2);
            var segund_est  = Intl.NumberFormat("de-DE").format(segund_esti);
            $('#estimado_segundo').val(segund_est);

            var terc_es = (monto_est/cant_t)*Number(response['iii'])
            var terc_esti = parseFloat(terc_es).toFixed(2);
            var terc_est  = Intl.NumberFormat("de-DE").format(terc_esti);
            $('#estimado_tercer').val(terc_est);

            var cuarto_es = (monto_est/cant_t)*Number(response['iv'])
            var cuarto_esti = parseFloat(cuarto_es).toFixed(2);
            var cuarto_est  = Intl.NumberFormat("de-DE").format(cuarto_esti);
            $('#estimado_cuarto').val(cuarto_est);

            var total_est = prim_es+segund_es+terc_es+cuarto_es
            var total_estim = parseFloat(total_est).toFixed(2);
            var estimado_total_t  = Intl.NumberFormat("de-DE").format(total_estim);
            $('#estimado_total_t_mod').val(estimado_total_t);

            //FUNCIO PARA LLENAR EL SELECT DE PARTIDA PRESUPUESTARIA PARA CAMBIAR
            var cod_partida_pre = response['codigopartida_presupuestaria'];
            $.ajax({
                url:base_url1,
                method: 'post',
                data: {cod_partida_pre: cod_partida_pre},
                dataType: 'json',
                success: function(data){
                    $('#selc_part_pres_b').find('option').not(':first').remove();
                    $.each(data, function(index, response){
                        $('#selc_part_pres_b').append('<option value="'+response['id_partida_presupuestaria']+'">'+response['desc_partida_presupuestaria']+'</option>');
                    });
                }
            })

            //FUNCIO PARA LLENAR EL SELECT DE UNIDAD DE MEDIDA PARA CAMBIAR
            var id_unid_med = response['id_unidad_medida'];
            $.ajax({
                url:base_url2,
                method: 'post',
                data: {id_unid_med: id_unid_med},
                dataType: 'json',
                success: function(data){
                    $.each(data, function(index, response){
                        $('#camb_unid_medi_b').append('<option value="'+response['id_unidad_medida']+'">'+response['desc_unidad_medida']+'</option>');
                    });
                }
            })

            //FUNCIO PARA LLENAR EL SELECT DE ALICUOTA IVA
            var id_alic_iva = response['alicuota_iva'];
            $.ajax({
                url:base_url3,
                method: 'post',
                data: {id_unid_med: id_unid_med},
                dataType: 'json',
                success: function(data){
                    console.log(data);
                    $.each(data, function(index, response){
                        $('#sel_id_alic_iva_b').append('<option value="'+response['desc_alicuota_iva']+'">'+response['desc_porcentaj']+'</option>');
                    });
                }
            })
        }
    })
}

function buscar_ccnnu_m_b(){ //PARA LLENAR EN SELECT DE CCNNU DENTRO DEL MODAL
    var ccnu_b_m = $('#ccnu_b_m_b').val();

    console.log(ccnu_b_m);
    //var base_url =window.location.origin+'/asnc/index.php/Programacion/llenar_selc_ccnu_m';
    var base_url = '/index.php/Programacion/llenar_selc_ccnu_m';
    $.ajax({
        url:base_url,
        method: 'post',
        data: {ccnu_b_m: ccnu_b_m},
        dataType: 'json',
        success: function(data){
            $('#sel_ccnu_b_m_b').find('option').not(':first').remove();
            $.each(data, function(index, response){
                $('#sel_ccnu_b_m_b').append('<option value="'+response['codigo_ccnu']+'">'+response['desc_ccnu']+'</option>');
            });
        }
    })
}

function calcular_mod_bienes(){

    var cantidad_acc = $('#cantidad_mod_b').val();
    $('#cant_total_distribuir_mod_b').val(cantidad_acc);

    var i = $('#primero_b').val();
    var ii = $('#segundo_b').val();
    var iii = $('#tercero_b').val();
    var iv = $('#cuarto_b').val();
    var cant_total_distribuir = cantidad_acc - i - ii - iii - iv

    var cantidad2 = Number(i) + Number(ii) + Number(iii) + Number(iv)
    $('#cant_total_distribuir_mod_b').val(cant_total_distribuir);

    if (cant_total_distribuir < 0) {
        swal({
            title: "¡ATENCION!",
            text: "La cantidad a distribuir no puede ser menor a la Cantidad estipulada! Por favor modifique para seguir con la carga.",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#00897b",
            confirmButtonText: "CONTINUAR",
            closeOnConfirm: false
        }, function(){
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
        });

        $("#costo_unitario_mod_b").prop('disabled', true);
        $("#sel_id_alic_iva_b").prop('disabled', true);
    }else{
        $("#costo_unitario_mod_b").prop('disabled', false);
        $("#sel_id_alic_iva_b").prop('disabled', false);
        //Remplazar decimales para caculos
        var costo_unitario = $('#costo_unitario_mod_b').val();
        var newstr = costo_unitario.replace('.', "");
        var newstr2 = newstr.replace('.', "");
        var newstr3 = newstr2.replace('.', "");
        var newstr4 = newstr3.replace('.', "");
        var precio = newstr4.replace(',', ".");

        var tota = cantidad2 * precio
        var tota2 = parseFloat(tota).toFixed(2);
        var precio_total_acc = Intl.NumberFormat("de-DE").format(tota2);
        $('#precio_total_mod_b').val(precio_total_acc);

        var id_alicuota_iva = $('#ali_iva_e_b').val();

        var sel_id_alic_iva_b = $('#sel_id_alic_iva_b').val();

        if (sel_id_alic_iva_b == 's') {
            var id_al_iva = id_alicuota_iva
        }else {
            var id_al_iva = sel_id_alic_iva_b
        }

        var newstr5 = precio_total_acc.replace('.', "");
        var newstr6 = newstr5.replace('.', "");
        var newstr7 = newstr6.replace('.', "");
        var newstr8 = newstr7.replace('.', "");
        var precio_total_ac = newstr8.replace(',', ".");

        var monto_iva_estimado = precio_total_ac*id_al_iva;
        var iva_estimado = parseFloat(monto_iva_estimado).toFixed(2);
        var iva_estimado_acc = Intl.NumberFormat("de-DE").format(iva_estimado);
        $('#iva_estimado_mod_b').val(iva_estimado_acc);

        var newstr9 = iva_estimado_acc.replace('.', "");
        var newstr10 = newstr9.replace('.', "");
        var newstr11 = newstr10.replace('.', "");
        var newstr12 = newstr11.replace('.', "");
        var iva_estimado_ac = newstr12.replace(',', ".");

        var monto_t_estimado = Number(precio_total_ac) + Number(iva_estimado_ac);
        var monto_total_estimadoo = parseFloat(monto_t_estimado).toFixed(2);
        var monto_total_estimado = Intl.NumberFormat("de-DE").format(monto_total_estimadoo);
        $('#monto_estimado_mod_b').val(monto_total_estimado);

        var primer =  parseFloat(Number(monto_t_estimado) / Number(cantidad2) * Number(i)).toFixed(2);
        var primer_e = parseFloat(primer).toFixed(2);
        var estimado_i = Intl.NumberFormat("de-DE").format(primer_e);
        $('#estimado_primer').val(estimado_i);

        var segun = parseFloat(Number(monto_t_estimado) / Number(cantidad2) * Number(ii)).toFixed(2);
        var segun_e = parseFloat(segun).toFixed(2);
        var estimado_i = Intl.NumberFormat("de-DE").format(segun_e);
        $('#estimado_segundo').val(estimado_i);

        var terc = parseFloat(Number(monto_t_estimado) / Number(cantidad2) * Number(iii)).toFixed(2);
        var terc_e = parseFloat(terc).toFixed(2);
        var estimado_iii = Intl.NumberFormat("de-DE").format(terc_e);
        $('#estimado_tercer').val(estimado_iii);

        var cuar = parseFloat(Number(monto_t_estimado) / Number(cantidad2) * Number(iv)).toFixed(2);
        var cuar_e = parseFloat(cuar).toFixed(2);
        var estimado_iv = Intl.NumberFormat("de-DE").format(cuar_e);
        $('#estimado_cuarto').val(estimado_iv);

        var total_e = Number(primer)+Number(segun)+Number(terc)+Number(cuar)
        var total_es = parseFloat(total_e).toFixed(2);
        var total_est = Intl.NumberFormat("de-DE").format(total_es);
        $('#estimado_total_t_mod').val(total_est);
    }
}

function guardar_tabla_b(){
    event.preventDefault();

    swal.fire({
        title: '¿Seguro que desea guardar el registro? Se editara en la Base de Datos',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, Modificar!'
    }).then((result) => {
        if (result.value == true) {
            var id_items_proy = $('#id_items_b').val();

            var partida_pre = $('#id_part_pres_b').val();
            var selc_part_pres = $('#selc_part_pres_b').val();

            var ccnu = $('#id_ccnu_mod_b').val();
            var sel_ccnu = $('#sel_ccnu_b_m_b').val();

            var esp = $('#esp_b').val();

            var unid_med = $('#id_unid_med_b').val();
            var sel_camb_unid_medi = $('#camb_unid_medi_b').val();

            var cantidad = $('#cantidad_mod_b').val();
            var primero = $('#primero_b').val();
            var segundo = $('#segundo_b').val();
            var tercero = $('#tercero_b').val();
            var cuarto = $('#cuarto_b').val();
            var cantidad_distribuir = $('#cant_total_distribuir_mod_b').val();

            var cost_uni = $('#costo_unitario_mod_b').val();
            var prec_t = $('#precio_total_mod_b').val();

            var ali_iva_e = $('#ali_iva_e_b').val();
            var sel_id_alic_iva = $('#sel_id_alic_iva_b').val();

            var monto_iva_e = $('#iva_estimado_mod_b').val();
            var monto_tot_est = $('#monto_estimado_mod_b').val();

            //var base_url =window.location.origin+'/asnc/index.php/Programacion/editar_fila_ip_b';
            var base_url = '/index.php/Programacion/editar_fila_ip_b';

            $.ajax({
                url:base_url,
                method: 'post',
                data:{
                    id_items_proy: id_items_proy,
                    partida_pre: partida_pre,
                    selc_part_pres:selc_part_pres,
                    ccnu: ccnu,
                    sel_ccnu: sel_ccnu,

                    esp: esp,
                    unid_med: unid_med,
                    sel_camb_unid_medi: sel_camb_unid_medi,
                    cantidad:cantidad,
                    primero: primero,
                    segundo: segundo,
                    tercero: tercero,
                    cuarto: cuarto,
                    cantidad_distribuir:cantidad_distribuir,
                    cost_uni:cost_uni,
                    prec_t: prec_t,
                    ali_iva_e: ali_iva_e,
                    sel_id_alic_iva:sel_id_alic_iva,
                    monto_iva_e: monto_iva_e,
                    monto_tot_est: monto_tot_est
                },
                dataType: 'json',
                success: function(response){
                    if(response == 1) {
                        swal.fire({
                            title: 'Modificacion Exitosa',
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value == true) {
                                location.reload();
                            }
                        });
                    }
                }
            })
        }
    });
}
