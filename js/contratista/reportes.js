///por nombre
$(document).ready(function(){

	var rif_b = $('#rif_cont').val();
		if (rif_b != '') {
			//var base_url =window.location.origin+'/asnc/index.php/Contratista/llenar_contratista';
			var base_url = '/index.php/Contratista/llenar_contratista';
			$.ajax({
				url: base_url,
				method: 'post',
				data: { rif_b: rif_b },
				dataType: 'json',
				success: function (data) {
					if (data == null) {
						$("#no_existe").show();
						$("#existe").hide();
	
						$('#exitte').val(0);
	
					} else {
						$("#existe").show();
						$("#no_existe").hide();
	
						$('#exitte').val(1);
						$('#descedocont').val(data['descedocont']);
						$('#infoadic').val(data['infoadic']);
						$('#idedocontratistas').val(data['idedocontratistas']);
						$('#rif_cont').val(data['rifced']);
						$('#nombre').val(data['nombre']);
						$('#tipopersona').val(data['tipopersona']);
						$('#descdencom').val(data['descdencom']);
						$('#descobjcont').val(data['descobjcont']);
						$('#dirfiscal').val(data['dirfiscal']);
						$('#percontacto').val(data['percontacto']);
						$('#tele11').val(data['tele11']);
						$('#fecactsusc_at').val(data['fecactsusc_at']);
						$('#fecvencsusc_at').val(data['fecvencsusc_at']);
						$('#numcertrnc2').val(data['numcertrnc2']);
						$('#nro_correlativo').val(data['nro_correlativo']);
						$('#fecinscrnc_at2').val(data['fecinscrnc_at2']);
						$('#fecvencrnc_at2').val(data['fecvencrnc_at2']);
						$('#situacionact').val(data['descedocont']);
						$('#proceso_id').val(data['proceso_id']);
					  }
					}
				  });
		}
});
