
function agregar_acc_ff(button) {
	var row = button.parentNode.parentNode;
  	var cells = row.querySelectorAll('td:not(:last-of-type)');
  	agregar_acc_ffToCartTable(cells);
}

function remove_ff_acc() {
	var row = this.parentNode.parentNode;
    document.querySelector('#target_acc_ff tbody').removeChild(row);
	var par = $("#porcentaje_acc").val('');
	$("#fuente_financiamiento_acc").val($("#fuente_financiamiento_acc").data("default-value"));
}

function agregar_acc_ffToCartTable(cells){
	var pp = $("#par_presupuestaria_acc").val();
	var pp1 = pp.split("/")[0];
   	var pp2 = pp.split("/")[1];
	var pp3 = pp.split("/")[2];

	var estad = $("#id_estado_acc").val();

	var ff = $("#fuente_financiamiento_acc").val();
	var ff1 = ff.split("/")[0];
   	var ff2 = ff.split("/")[1];

	var pc = $("#porcentaje_acc").val();

	if (pp1 == 0 || ff1 == 0 || pc == ''){
		if (pp1== 0) {
			document.getElementById("fuente_financiamiento_acc").focus();
		}else if (ff1== '0') {
			document.getElementById("id_estado_acc").focus();
		}
		else if (pc == '') {
			document.getElementById("fuente_financiamiento_acc").focus();
		}
	}else{
		var newRow = document.createElement('tr');
		var increment = increment +1;
		newRow.className='myTr';
		newRow.innerHTML = `
		<td>${pp3}<input type="text" name="par_presupuestaria_ff[]" id="ins-type-${increment}" hidden value="${pp1}"></td>
		<td>${pp2}<input type="text" name="par_presupuestaria_acc_ff[]" id="ins-type-${increment}" hidden value="${pp1}"></td>
		<td>${estad}<input type="text" name="id_estado_acc[]" id="ins-type-${increment}" hidden value="${estad}"></td>

		<td>${ff2}<input type="text" name="fuente_financiamiento_acc[]" id="ins-type-${increment}" hidden value="${ff1}"></td>
		<td>${pc}<input type="text" name="porcentaje_acc[]" id="ins-type-${increment}" hidden value="${pc}"></td>
		`;

		var cellremove_ff_accBtn = createCell();

		cellremove_ff_accBtn.appendChild(createremove_ff_accBtn())
		newRow.appendChild(cellremove_ff_accBtn);
		document.querySelector('#target_acc_ff tbody').appendChild(newRow);


		var par = $("#porcentaje_acc").val('0');
		$("#fuente_financiamiento_acc").val($("#fuente_financiamiento_acc").data("default-value"));
	}
}

function createremove_ff_accBtn() {
    var btnremove_ff_acc = document.createElement('button');
    btnremove_ff_acc.className = 'btn btn-xs btn-danger';
    btnremove_ff_acc.onclick = remove_ff_acc;
    btnremove_ff_acc.innerText = 'Descartar';
    return btnremove_ff_acc;
}

function createCell(text) {
	var td = document.createElement('td');
  if(text) {
  	td.innerText = text;
  }
  return td;
}
