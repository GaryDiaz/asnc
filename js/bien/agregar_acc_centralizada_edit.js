
function agregar_ccnu_acc_edit(button) {
	var row = button.parentNode.parentNode;
  	var cells = row.querySelectorAll('td:not(:last-of-type)');
  	agregar_ccnu_accToCartTable(cells);

}

function remove_proy_acc() {
	var row = this.parentNode.parentNode;
    document.querySelector('#target_req_acc tbody').removeChild(row);
	$("#id_unidad_medida_acc").val($("#id_unidad_medida_acc").data("default-value"));
	$("#id_alicuota_iva_acc").val($("#id_alicuota_iva_acc").data("default-value"));

	$("#especificacion_acc").val('');
	$("#cantidad_acc").val('');
	$("#precio_total_acc").val('');
	$("#costo_unitario_acc").val('');
	$('#I_acc').val('0');
	$('#II_acc').val('0');
	$('#III_acc').val('0');
	$('#IV_acc').val('0');
	$("#cant_total_distribuir_acc").val('');
	$("#iva_estimado_acc").val('');
	$("#estimado_i_acc").val('');
	$("#estimado_ii_acc").val('');
	$("#estimado_iii_acc").val('');
	$("#estimado_iV_acc").val('');
	$("#estimado_total_t_acc").val('');
}

function agregar_ccnu_accToCartTable(cells){
	var pp = $("#par_presupuestaria_acc").val();
	var pp1 = pp.split("/")[0];
   	var pp2 = pp.split("/")[1];
	var pp3 = pp.split("/")[2];

	var ccnu = $("#id_ccnu_acc").val();
	var ccnu1 = ccnu.split("/")[0];
   	var ccnu2 = ccnu.split("/")[1];

   	var esp = $("#especificacion_acc").val();
	var id_unid = $("#id_unidad_medida_acc").val();
	var id_unid1 = id_unid.split("/")[0];
	var id_unid2 = id_unid.split("/")[1];

 	var can  = $("#cantidad_acc").val();
   	var cos  = $("#costo_unitario_acc").val();
   	var pret  = $("#precio_total_acc").val();

	var cantidad = $("#cantidad_acc").val();
	var total_distribuir = $("#cant_total_distribuir_acc").val();

	var i = $('#I_acc').val();
	var ii = $('#II_acc').val();
	var iii = $('#III_acc').val();
	var iv = $('#IV_acc').val();

	var al_iva  = $("#id_alicuota_iva_acc").val();
	var al_iva1 = al_iva.split("/")[0];
   	var al_iva2 = al_iva.split("/")[1];
   	var ica_est  = $("#iva_estimado_acc").val();
   	var mo_est  = $("#monto_estimado_acc").val();
	if (pp == 0 || ccnu1 == '0' || esp == ''  || id_unid == '0' || can == '' || cos == '' || al_iva == '0'){

		if (pp== 0) {
			document.getElementById("par_presupuestaria_acc").focus();
		}
		else if (ccnu1 == 0) {
			document.getElementById("id_ccnu_acc").focus();
		}
		else if (esp == '') {
			document.getElementById("especificacion_acc").focus();
		}
		else if (id_unid == '0') {
			document.getElementById("id_unidad_medida_acc").focus();
		}
		else if (cos == '') {
			document.getElementById("costo_unitario_acc").focus();
		}
		else if (can == '') {
			document.getElementById("cantidad_acc").focus();
		}
		else if (al_iva == '0') {
			document.getElementById("id_alicuota_iva_acc").focus();
		}
	}else{
		var newRow = document.createElement('tr');
		var increment = increment +1;
		newRow.className='myTr';
		newRow.innerHTML = `
		<td></td>
		<td>${pp3}<input type="text" name="par_presupuestaria_acc[]" id="ins-type-${increment}" hidden value="${pp1}"></td>

		<td>${ccnu2}<input type="text" name="id_ccnu_acc[]" id="ins-type-${increment}" hidden value="${ccnu1}"></td>

		<td>${esp}<input type="text" name="especificacion_acc[]" id="ins-subtype-${increment}" hidden value="${esp}"></td>
		<td>${id_unid2}<input type="text" name="id_unidad_medida_acc[]" id="ins-subtype-${increment}" hidden value="${id_unid1}"></td>

		<td>${cantidad}<input type="text" hidden name="cantidad_acc[]" id="ins-pres-${increment}" value="${cantidad}"></td>

		<td>${i}<input type="text" hidden name="I_acc[]" id="ins-pres-${increment}" value="${i}"></td>
		<td>${ii}<input type="text" hidden name="II_acc[]" id="ins-pres-${increment}" value="${ii}"></td>
		<td>${iii}<input type="text" hidden name="III_acc[]" id="ins-pres-${increment}" value="${iii}"></td>
		<td>${iv}<input type="text" hidden name="IV_acc[]" id="ins-pres-${increment}" value="${iv}"></td>

		<td>${total_distribuir}<input type="text" hidden name="cant_total_distribuir_acc[]" id="ins-pres-${increment}" value="${total_distribuir}"></td>

		<td>${cos}<input type="text" hidden name="costo_unitario_acc[]" id="ins-pres-${increment}" value="${cos}"></td>
		<td>${pret}<input type="text" hidden name="precio_total_acc[]" id="ins-pres-${increment}" value="${pret}"></td>
		<td>${al_iva1}<input type="text" hidden name="id_alicuota_iva_acc[]" id="ins-pres-${increment}" value="${al_iva1}"></td>
		<td>${ica_est}<input type="text" hidden name="iva_estimado_acc[]" id="ins-pres-${increment}" value="${ica_est}"></td>
		<td>${mo_est}<input type="text" hidden name="monto_estimado_acc[]" id="ins-pres-${increment}" value="${mo_est}"></td>
		<td></td>
		`;

		var cellremove_proy_accBtn = createCell();

		cellremove_proy_accBtn.appendChild(createremove_proy_accBtn())
		newRow.appendChild(cellremove_proy_accBtn);
		document.querySelector('#target_req_acc tbody').appendChild(newRow);
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
