
function agregar_ccnu_acc(button) {
	var row = button.parentNode.parentNode;
  	var cells = row.querySelectorAll('td:not(:last-of-type)');
  	agregar_ccnu_accToCartTable(cells);

}

function remove_proy_acc() {
	var row = this.parentNode.parentNode;
    document.querySelector('#target_req_acc tbody').removeChild(row);
	$("#id_unidad_medida").val($("#id_unidad_medida").data("default-value"));
	$("#id_alicuota_iva").val($("#id_alicuota_iva").data("default-value"));

	$("#especificacion").val('');
	$("#cantidad").val('');
	$("#precio_total").val('');
	$("#costo_unitario").val('');
	$('#I').val('0');
	$('#II').val('0');
	$('#III').val('0');
	$('#IV').val('0');
	$("#cant_total_distribuir").val('');
	$("#iva_estimado").val('');
	$("#estimado_i").val('');
	$("#estimado_ii").val('');
	$("#estimado_iii").val('');
	$("#estimado_iV").val('');
	$("#estimado_total_t").val('');
}

function agregar_ccnu_accToCartTable(cells){
	var pp = $("#par_presupuestaria").val();
	var pp1 = pp.split("/")[0];
   	var pp2 = pp.split("/")[1];
	var pp3 = pp.split("/")[2];

	var ccnu = $("#id_ccnu").val();
	var ccnu1 = ccnu.split("/")[0];
   	var ccnu2 = ccnu.split("/")[1];

   	var esp = $("#especificacion").val();
	var id_unid = $("#id_unidad_medida").val();
	var id_unid1 = id_unid.split("/")[0];
	var id_unid2 = id_unid.split("/")[1];

 	var can  = $("#cantidad").val();
   	var cos  = $("#costo_unitario").val();
   	var pret  = $("#precio_total").val();

	var cantidad = $("#cantidad").val();
	var total_distribuir = $("#cant_total_distribuir").val();

	var i = $('#I').val();
	var ii = $('#II').val();
	var iii = $('#III').val();
	var iv = $('#IV').val();

	var al_iva  = $("#id_alicuota_iva").val();
	var al_iva1 = al_iva.split("/")[0];
   	var al_iva2 = al_iva.split("/")[1];
   	var ica_est  = $("#iva_estimado").val();
   	var mo_est  = $("#monto_estimado").val();
	if (pp == 0 || ccnu1 == '0' || esp == ''  || id_unid == '0' || can == '' || cos == '' || al_iva == '0'){

		if (pp== 0) {
			document.getElementById("par_presupuestaria").focus();
		}
		else if (ccnu1 == 0) {
			document.getElementById("id_ccnu").focus();
		}
		else if (esp == '') {
			document.getElementById("especificacion").focus();
		}
		else if (id_unid == '0') {
			document.getElementById("id_unidad_medida").focus();
		}
		else if (cos == '') {
			document.getElementById("costo_unitario").focus();
		}
		else if (can == '') {
			document.getElementById("cantidad").focus();
		}
		else if (al_iva == '0') {
			document.getElementById("id_alicuota_iva").focus();
		}
	}else{
		var newRow = document.createElement('tr');
		var increment = increment +1;
		newRow.className='myTr';
		newRow.innerHTML = `
		<td>${pp3}<input type="text" name="par_presupuestaria[]" id="ins-type-${increment}" hidden value="${pp1}"></td>

		<td>${ccnu2}<input type="text" name="id_ccnu[]" id="ins-type-${increment}" hidden value="${ccnu1}"></td>

		<td>${esp}<input type="text" name="especificacion[]" id="ins-subtype-${increment}" hidden value="${esp}"></td>
		<td>${id_unid2}<input type="text" name="id_unidad_medida[]" id="ins-subtype-${increment}" hidden value="${id_unid1}"></td>

		<td>${cantidad}<input type="text" hidden name="cantidad[]" id="ins-pres-${increment}" value="${cantidad}"></td>

		<td>${i}<input type="text" hidden name="I[]" id="ins-pres-${increment}" value="${i}"></td>
		<td>${ii}<input type="text" hidden name="II[]" id="ins-pres-${increment}" value="${ii}"></td>
		<td>${iii}<input type="text" hidden name="III[]" id="ins-pres-${increment}" value="${iii}"></td>
		<td>${iv}<input type="text" hidden name="IV[]" id="ins-pres-${increment}" value="${iv}"></td>

		<td>${total_distribuir}<input type="text" hidden name="cant_total_distribuir[]" id="ins-pres-${increment}" value="${total_distribuir}"></td>

		<td>${cos}<input type="text" hidden name="costo_unitario[]" id="ins-pres-${increment}" value="${cos}"></td>
		<td>${pret}<input type="text" hidden name="precio_total[]" id="ins-pres-${increment}" value="${pret}"></td>
		<td>${al_iva1}<input type="text" hidden name="id_alicuota_iva[]" id="ins-pres-${increment}" value="${al_iva1}"></td>
		<td>${ica_est}<input type="text" hidden name="iva_estimado[]" id="ins-pres-${increment}" value="${ica_est}"></td>
		<td>${mo_est}<input type="text" hidden name="monto_estimado[]" id="ins-pres-${increment}" value="${mo_est}"></td>
		`;

		var cellremove_proy_accBtn = createCell();

		cellremove_proy_accBtn.appendChild(createremove_proy_accBtn())
		newRow.appendChild(cellremove_proy_accBtn);
		document.querySelector('#target_req_acc tbody').appendChild(newRow);

		$("#id_unidad_medida").val($("#id_unidad_medida").data("default-value"));
		$("#id_alicuota_iva").val($("#id_alicuota_iva").data("default-value"));

		$("#especificacion").val('');
		$("#cantidad").val('');
		$("#precio_total").val('');
		$("#costo_unitario").val('');
		$('#I').val('0');
		$('#II').val('0');
		$('#III').val('0');
		$('#IV').val('0');
		$("#cant_total_distribuir").val('');
		$("#iva_estimado").val('');
		$("#estimado_I").val('');
		$("#estimado_iI").val('');
		$("#estimado_iiI").val('');
		$("#estimado_iV").val('');
		$("#estimado_total_t").val('');

		$("#btn_guar_2").prop('disabled', false);
	}
}

function createremove_proy_accBtn() {
    var btnremove_proy_acc = document.createElement('button');
    btnremove_proy_acc.className = 'btn btn-xs btn-danger';
    btnremove_proy_acc.onclick = remove_proy_acc;
    btnremove_proy_acc.innerText = 'Descartar';
    return btnremove_proy_acc;
}

function createCell(text) {
	var td = document.createElement('td');
  if(text) {
  	td.innerText = text;
  }
  return td;
}
