
function agregar_ccnu(button) {
	var row = button.parentNode.parentNode;
  	var cells = row.querySelectorAll('td:not(:last-of-type)');
  	agregar_ccnuToCartTable(cells);
}

function remove_proy() {
	var row = this.parentNode.parentNode;
  	document.querySelector('#target_req tbody').removeChild(row);
}

function agregar_ccnuToCartTable(cells){
	var pp = $("#par_presupuestaria").val();
	var pp1 = pp.split("/")[0];
   	var pp2 = pp.split("/")[1];
	var pp3 = pp.split("/")[2];

	var tipo_obra = $("#id_tip_obra_e").val();
	var tipo_obra1 = tipo_obra.split("/")[0];
	var tipo_obra2 = tipo_obra.split("/")[1];

	var alcance_obra = $("#id_alcance_obra_e").val();
	var alcance_obra1 = alcance_obra.split("/")[0];
	var alcance_obra2 = alcance_obra.split("/")[1];

	var obj_obra = $("#id_obj_obra_e").val();
	var obj_obra1 = obj_obra.split("/")[0];
	var obj_obra2 = obj_obra.split("/")[1];

	var fecha_desde = $("#fecha_desde").val();
	var fecha_hasta = $("#fecha_hasta").val();

   	var esp = $("#especificacion").val();
	var id_unid = $("#id_unidad_medida").val();
	var id_unid1 = id_unid.split("/")[0];
	var id_unid2 = id_unid.split("/")[1];

 	var can  = $("#cantidad").val();
   	var pret  = $("#precio_total_e").val();

	var i = $('#i').val();
	var ii = $('#ii').val();
	var iii = $('#iii').val();
	var iv = $('#iv').val();

	var al_iva  = $("#id_alicuota_iva").val();
	var al_iva1 = al_iva.split("/")[0];
   	var al_iva2 = al_iva.split("/")[1];
   	var ica_est  = $("#iva_estimado").val();
   	var mo_est  = $("#monto_estimado").val();

	if (pp == 0 || tipo_obra1 == '0' || alcance_obra1 == '0' || obj_obra1 == '0' || esp == '' || fecha_desde == '' || fecha_hasta == '' || id_unid == '0' || pret == '' || al_iva1 == '0'){

		if (pp== 0) {
			document.getElementById("par_presupuestaria").focus();
		}
		else if (tipo_obra1 == 0) {
			document.getElementById("id_tip_obra").focus();
		}
		else if (alcance_obra1 == 0) {
			document.getElementById("id_alcance_obra").focus();
		}
		else if (obj_obra1 == 0) {
			document.getElementById("id_obj_obra").focus();
		}
		else if (esp == '') {
			document.getElementById("especificacion").focus();
		}
		else if (fecha_desde == '') {
			document.getElementById("fecha_desde").focus();
		}
		else if (fecha_hasta == '') {
			document.getElementById("fecha_hasta").focus();
		}
		else if (id_unid == '') {
			document.getElementById("id_unidad_medida").focus();
		}
		else if (pret == '') {
			document.getElementById("precio_total").focus();
		}
		else if (al_iva1 == '0') {
			document.getElementById("precio_total").focus();
		}

	}else{
		var newRow = document.createElement('tr');
		var increment = increment +1;
		newRow.className='myTr';
		newRow.innerHTML = `
		<td></td>
		<td>${pp3}<input type="text" name="par_presupuestaria[]" id="ins-type-${increment}" hidden value="${pp1}"></td>

		<td>${tipo_obra2}<input type="text" name="id_tip_obra_e[]" id="ins-type-${increment}" hidden value="${tipo_obra1}"></td>
		<td>${alcance_obra2}<input type="text" name="id_alcance_obra_e[]" id="ins-type-${increment}" hidden value="${alcance_obra1}"></td>
		<td>${obj_obra2}<input type="text" name="id_obj_obra_e[]" id="ins-type-${increment}" hidden value="${obj_obra1}"></td>

		<td>${fecha_desde}<input type="text" name="fecha_desde[]" id="ins-type-${increment}" hidden value="${fecha_desde}"></td>
		<td>${fecha_hasta}<input type="text" name="fecha_hasta[]" id="ins-type-${increment}" hidden value="${fecha_hasta}"></td>

		<td>${esp}<input type="text" name="especificacion[]" id="ins-subtype-${increment}" hidden value="${esp}"></td>
		<td>${id_unid2}<input type="text" name="id_unidad_medida[]" id="ins-subtype-${increment}" hidden value="${id_unid1}"></td>

		<td>${i}<input type="text" hidden name="i[]" id="ins-pres-${increment}" value="${i}"></td>
		<td>${ii}<input type="text" hidden name="ii[]" id="ins-pres-${increment}" value="${ii}"></td>
		<td>${iii}<input type="text" hidden name="iii[]" id="ins-pres-${increment}" value="${iii}"></td>
		<td>${iv}<input type="text" hidden name="iv[]" id="ins-pres-${increment}" value="${iv}"></td>

		<td>${pret}<input type="text" hidden name="precio_total_e[]" id="ins-pres-${increment}" value="${pret}"></td>
		<td>${al_iva1}<input type="text" hidden name="id_alicuota_iva[]" id="ins-pres-${increment}" value="${al_iva1}"></td>
		<td>${ica_est}<input type="text" hidden name="iva_estimado[]" id="ins-pres-${increment}" value="${ica_est}"></td>
		<td>${mo_est}<input type="text" hidden name="monto_estimado[]" id="ins-pres-${increment}" value="${mo_est}"></td>
		<td></td>
		`;

		var cellremove_proyBtn = createCell();

		cellremove_proyBtn.appendChild(createremove_proyBtn())
		newRow.appendChild(cellremove_proyBtn);
		document.querySelector('#target_req tbody').appendChild(newRow);

		$("#id_unidad_medida").val($("#id_unidad_medida").data("default-value"));
		$("#id_alicuota_iva").val($("#id_alicuota_iva").data("default-value"));
		$("#especificacion").val('');
		$("#fecha_desde").val('');
		$("#fecha_hasta").val('');
		$("#cantidad").val('');
		$("#cant_total_distribuir").val('100');
		$("#precio_total").val('');
		$('#I').val('0');
		$('#II').val('0');
		$('#III').val('0');
		$('#IV').val('0');
		$("#iva_estimado").val('');
		$("#monto_estimado").val('');
		$("#estimado_i").val('');
		$("#estimado_ii").val('');
		$("#estimado_iii").val('');
		$("#estimado_iV").val('');
		$("#estimado_total_t").val('');

		$("#btn_guar").prop('disabled', false);
	}
}

function createremove_proyBtn() {
    var btnremove_proy = document.createElement('button');
    btnremove_proy.className = 'btn btn-xs btn-danger';
    btnremove_proy.onclick = remove_proy;
    btnremove_proy.innerText = 'Descartar';
    return btnremove_proy;
}

function createCell(text) {
	var td = document.createElement('td');
  if(text) {
  	td.innerText = text;
  }
  return td;
}
