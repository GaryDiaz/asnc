
function agregar_ff(button) {
	var row = button.parentNode.parentNode;
  	var cells = row.querySelectorAll('td:not(:last-of-type)');
  	agregar_ffToCartTable(cells);
}

function remove_ff() {
	var row = this.parentNode.parentNode;
    document.querySelector('#target_ff tbody').removeChild(row);
	$('#fuente_financiamiento').prop('selectedIndex',0);
	var par = $("#porcentaje").val('0');
}

function agregar_ffToCartTable(cells){
	var pp = $("#par_presupuestaria").val();
	var pp1 = pp.split("/")[0];
   	var pp2 = pp.split("/")[1];
	var pp3 = pp.split("/")[2];

	var estad = $("#id_estado").val();
	var desc_ff = $("#descripcion_ff").val();

	var ff = $("#fuente_financiamiento").val();
	var ff1 = ff.split("/")[0];
   	var ff2 = ff.split("/")[1];

	var pc = $("#porcentaje").val();

	if (pp1 == 0 || ff1 == 0 || pc == ''){
		if (pp1== 0) {
			document.getElementById("par_presupuestaria").focus();
		}else if (ff1== '0') {
			document.getElementById("fuente_financiamiento").focus();
		}
		else if (pc == '') {
			document.getElementById("porcentaje").focus();
		}
	}else{
		var newRow = document.createElement('tr');
		var increment = increment +1;
		newRow.className='myTr';
		newRow.innerHTML = `
		<td>${pp3}<input type="text" name="par_presupuestaria_ff[]" id="ins-type-${increment}" hidden value="${pp1}"></td>
		<td>${pp2}<input type="text" name="des_par_presupuestaria_ff[]" id="ins-type-${increment}" hidden value="${pp1}"></td>
		<td>${estad}<input type="text" name="id_estado[]" id="ins-type-${increment}" hidden value="${estad}"></td>

		<td>${ff2}<input type="text" name="fuente_financiamiento[]" id="ins-type-${increment}" hidden value="${ff1}"></td>
		<td >${desc_ff}<input type="text" name="descripcion_ff[]" id="ins-type-${increment}" hidden value="${desc_ff}"></td>
		<td >${pc}<input type="text" name="porcentaje[]" id="ins-type-${increment}" hidden value="${pc}"></td>


		`;

		var cellremove_ffBtn = createCell();

		cellremove_ffBtn.appendChild(createremove_ffBtn())
		newRow.appendChild(cellremove_ffBtn);
		document.querySelector('#target_ff tbody').appendChild(newRow);

		var par = $("#porcentaje").val('');
		$("#desc_ff").val('');
		$("#fuente_financiamiento").val($("#fuente_financiamiento").data("default-value"));

	}
}

function createremove_ffBtn() {
    var btnremove_ff = document.createElement('button');
    btnremove_ff.className = 'btn btn-xs btn-danger';
    btnremove_ff.onclick = remove_ff;
    btnremove_ff.innerText = 'Descartar';
    return btnremove_ff;
}

function createCell(text) {
	var td = document.createElement('td');
  if(text) {
  	td.innerText = text;
  }
  return td;
}
