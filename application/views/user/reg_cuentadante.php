 <html lang="en">

 <head>
    <meta charset="utf-8" />
    <title>Inicio de Sesión</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
 
 </head>

 <body class="pace-top bg-white">
    <div id="page-loader" class="fade show"><span class="spinner"></span></div>
    <div class="sidebar-bg"></div>
    <div id="content" class="content" style="margin-left: 20px;">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                    <div class="brand text-center mt-2">
                        <h4 class="mt-2">Registro de Cuentadante</h4>
                    </div>

                    <div class="panel-heading"></div>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-4">
                                <label>Rif del Organismo/Ente/Unidad Ejecutora a Consultar</label>
                                <input class="form-control" type="text" name="rif_b" id="rif_b" placeholder="123456789, SIN LETRA NI GUION">
                            </div>
                            <div class="col- mt-4">
                                <button type="button" class="btn btn-default" onclick="consultar_rif();" name="button"> <i class="fas fa-search"></i> </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12" style="display: none" id="items">
                <form action="<?= base_url() ?>index.php/User/savedante" class="form-horizontal" data-parsley-validate="true" name="demo-form" method="POST">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title"><b>Datos del Organismo/Ente/Unidad Ejecutora</b></h4>
                        </div>
                        <div class="panel-body" id="existe">
                            <div class="row">
                                <div class="form-group col-3">
                                    <label>Rif del Organismo/Ente/Unidad Ejecutora</label>
                                    <input class="form-control" type="text" name="rif_cont" id="rif_cont" readonly>
                                </div>
                                <div class="form-group col-6">
                                    <label>Nombre del Organismo/Ente/Unidad Ejecutora</label>
                                    <input type="text" name="nombre" id="nombre" class="form-control" readonly>
                                </div>
                                <div class="form-group col-3">
                                    <label>Codigo ONAPRE</label>
                                    <input type="text" name="cod_onapre" id="cod_onapre" class="form-control" readonly>
                                </div>
                                <div class="form-group col-3">
                                    <label>Siglas</label>
                                    <input type="text" name="siglas" id="siglas" class="form-control" readonly>
                                </div>
                                <div class="form-group col-3">
                                    <label>Dirección Fiscal</label>
                                    <input type="text" name="direccion_fiscal" id="direccion_fiscal" class="form-control" readonly>
                                </div>
                                <div class="col-6"></div>
                            </div>
                        </div>
                        <div class="panel-body" id="no_existe">
                            <div class="row">
                                <div class="col-md-12 mt-2 mb-2">
                                    <h4 class="mt-2"><label>Rif no existe en nuestra base de datos, por favor, elija una de las siguientes opciones.</label></h4>
                                    <h4 class="mt-2">una vez terminado el registro, actualice la pagina y vuelva a consultar el Rif</h4>
                                </div>
                                <div class="col-md-12 mt-2 mb-2">
                                    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#myModal">
                                        Registrar Organismo
                                    </button>
                                    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#entes">
                                        Registrar Ente
                                    </button>
                                    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                                        Registrar Unidad Ejecutora
                                    </button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="exitte" id="exitte">
                        <div class="panel-heading">
                            <h4 class="panel-title"><b>Datos del Cuenta-Dante</b></h4>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-6">
                                    <label>Nombre Completo </label>
                                    <input class="form-control" type="hidden" name="unidad_1" id="unidad_1" readonly>
                                    <input type="text" name="nombrefun" class="form-control <?php echo form_error('nombrefun') ? 'is-invalid' : ''; ?>" placeholder="Nombre completo" onKeyUp="mayus(this);" value="<?php echo set_value('nombrefun'); ?>">
                                    <div class="invalid-feedback">
                                        <?php echo form_error('nombrefun'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label>Apellido Completo </label>
                                    <input type="text" name="apellido" class="form-control <?php echo form_error('apellido') ? 'is-invalid' : ''; ?>" placeholder="Nombre completo" onKeyUp="mayus(this);" value="<?php echo set_value('apellido'); ?>">
                                    <div class="invalid-feedback">
                                         <?php echo form_error('apellido'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-1">
                                    <label></label>
                                    <input type="text" class="form-control" id="tipo_ced" name="tipo_ced" value="V" readonly />
                                </div>
                                <div class="form-group col-4">
                                    <label>Cédula de Identidad </label>
                                    <input type="text" class="form-control" id="cedula" name="cedula" placeholder="ingrese la Cédula sin punto ni coma" />
                                </div>
                                <div class="form-group col-4">
                                    <label>Cargo</label>
                                    <input type="text" class="form-control" id="cargo" name="cargo" placeholder="Cargo del Cuenta-Dante" onKeyUp="mayus(this);" />
                                </div>
                                <div class="form-group col-2">
                                    <label>Teléfono</label>
                                    <input type="text" class="form-control" id="tele_1" name="tele_1" placeholder="Teléfono del Cuenta-Dante" />
                                </div>
                                <div class="form-group col-2">
                                    <label>Teléfono 2</label>
                                    <input type="text" class="form-control" id="tele_2" name="tele_2" placeholder="Teléfono del Cuenta-Dante" />
                                </div>
                                <div class="form-group col-2">
                                    <label>Oficina</label>
                                    <input type="text" class="form-control" id="oficina" name="oficina" placeholder="oficina del Cuenta-Dante" onKeyUp="mayus(this);" />
                                </div>
                                <div class="form-group col-3">
                                    <label>Fecha de Designación</label>
                                    <input type="date" class="form-control" id="fecha_designacion" name="fecha_designacion" placeholder="fecha" />

                                </div>
                                <div class="form-group col-3">
                                    <label>Número de la Gaceta o la Resolución:</label>
                                    <div class="input-group input-daterange">
                                        <input type="text" class="form-control" id="numero_gaceta" name="numero_gaceta" placeholder="Número de la Gaceta o la Resolución:" onKeyUp="mayus(this);" />
                                    </div>
                                </div>
                                <div class="form-group col-5">
                                    <label>Observaciones</label>
                                    <textarea class="form-control" name="obser" id="obser" rows="3" cols="70" onKeyUp="mayus(this);"></textarea>
                                </div>
                                <div class="form-group col-5">
                                    <label>CORREO INSTITUCIONAL (CUENTADANTE)</label>
                                    <input type="text" name="email" class="form-control <?php echo form_error('email') ? 'is-invalid' : ''; ?>" aria-describedby="emailHelp" placeholder="Correo eléctronico" value="<?php echo set_value('email'); ?>">
                                    <div class="invalid-feedback">
                                        <?php echo form_error('email'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-5">
                                    <label>Ingrese Un Usuario</label>
                                    <input type="text" name="usuario" class="form-control <?php echo form_error('usuario') ? 'is-invalid' : ''; ?>" placeholder="usuario completo" value="<?php echo set_value('usuario'); ?>">
                                    <div class="invalid-feedback">
                                        <?php echo form_error('usuario'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-5">
                                    <label for="exampleInputPassword1">Contraseña</label>
                                    <input type="password" name="password" class="form-control <?php echo form_error('password') ? 'is-invalid' : ''; ?>" placeholder="Contraseña" value="<?php echo set_value('password'); ?>">
                                    <div class="invalid-feedback">
                                        <?php echo form_error('password'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-5">
                                    <label for="exampleInputPassword1">Repite la contraseña</label>
                                    <input type="password" name="repeatPassord" class="form-control <?php echo form_error('repeatPassord') ? 'is-invalid' : ''; ?>" placeholder="Contraseña" value="">
                                    <div class="invalid-feedback">
                                        <?php echo form_error('repeatPassord'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col 12 text-center">
                            <button type="submit" class="btn btn-primary">Guardar Cuenta-Dante</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Crear Organismo</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">Registro de Órganos</h4>
                                    </div>
                                    <div class="panel-body">
                                        <form action="<?= base_url() ?>index.php/User/save_organismo" method="POST" class="form-horizontal">
                                            <div class="row">
                                                <div class="form-group col-4">
                                                    <label>Órgano Perteneciente</label><br>
                                                    <select id="id_organoads" name="id_organoads" class="form-control">
                                                        <?php foreach ($organo as $data) : ?>
                                                            <option>Seleccione</option>
                                                            <option value="0">Órgano Padre</option>
                                                            <option value="<?= $data['id_organo'] ?>"><?= $data['desc_organo'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-4">
                                                    <label>Órgano</label>
                                                    <input type="text" name="organo" class="form-control <?php echo form_error('organo') ? 'is-invalid' : ''; ?>" placeholder="Nombre" value="<?php echo set_value('organo'); ?>">
                                                    <div class="invalid-feedback">
                                                        <?php echo form_error('organo'); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group col-4">
                                                    <label>Código ONAPRE</label>
                                                    <input type="text" name="cod_onapre" class="form-control <?php echo form_error('cod_onapre') ? 'is-invalid' : ''; ?>" placeholder="Código" value="<?php echo set_value('cod_onapre'); ?>">
                                                    <div class="invalid-feedback">
                                                        <?php echo form_error('cod_onapre'); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group col-4">
                                                    <label>Siglas del Órgano</label>
                                                    <input type="text" name="siglas" class="form-control <?php echo form_error('siglas') ? 'is-invalid' : ''; ?>" placeholder="Código" value="<?php echo set_value('siglas'); ?>">
                                                    <div class="invalid-feedback">
                                                        <?php echo form_error('siglas'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <label>Rif del Órgano</label>
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <select id="tipo_rif" name="tipo_rif" class="form-control">
                                                                    <option value="0">Sel</option>
                                                                    <?php foreach ($tipo_rif as $data) : ?>
                                                                        <option value="<?= $data['id_rif'] ?>"><?= $data['desc_rif'] ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-8">
                                                                <input type="number" name="rif" class="form-control <?php echo form_error('rif') ? 'is-invalid' : ''; ?>" placeholder="Código" value="<?php echo set_value('rif'); ?>">
                                                                <div class="invalid-feedback">
                                                                    <?php echo form_error('rif'); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="col-4 form-group">
                                                    <label>Clasificación</label>
                                                    <select id="id_clasificacion" name="id_clasificacion" class="form-control">
                                                        <option>Ejemplo</option>
                                                        <option value="1">Prueba</option>
                                                    </select>
                                                </div>
                                                <div class="col-3 form-group">
                                                    <label>Teléfono Local</label>
                                                    <input type="text" class="form-control" name="tel_local" id="tel_local" placeholder="(999) 999-9999" />
                                                </div>
                                                <div class="col-3 form-group">
                                                    <label>Teléfono Local 2</label>
                                                    <input type="text" class="form-control" name="tel_local_2" id="tel_local_2" placeholder="(999) 999-9999" />
                                                </div>
                                                <div class="col-3 form-group">
                                                    <label>Teléfono Móvil</label>
                                                    <input type="text" class="form-control" name="tel_movil" id="tel_movil" placeholder="(999) 999-9999" />
                                                </div>
                                                <div class="col-3 form-group">
                                                    <label>Teléfono Móvil 2</label>
                                                    <input type="text" class="form-control" name="tel_movil_2" id="tel_movil_2" placeholder="(999) 999-9999" />
                                                </div>
                                                <div class="form-group col-6">
                                                    <label>Página Web</label>
                                                    <input type="text" name="pag_web" class="form-control <?php echo form_error('pag_web') ? 'is-invalid' : ''; ?>" placeholder="Nombre" value="<?php echo set_value('pag_web'); ?>">
                                                    <div class="invalid-feedback">
                                                        <?php echo form_error('pag_web'); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group col-6">
                                                    <label>Correo Electronico</label>
                                                    <input type="email" name="email" class="form-control <?php echo form_error('email') ? 'is-invalid' : ''; ?>" placeholder="Nombre" value="<?php echo set_value('email'); ?>">
                                                    <div class="invalid-feedback">
                                                        <?php echo form_error('email'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <ul class="nav nav-tabs" style="background: #080808;">
                                                    <li class="nav-items">
                                                        <a href="#direccion_fiscal" data-toggle="tab" class="nav-link active">
                                                            <span class="d-sm-none">Tab 1</span>
                                                            <span class="d-sm-block d-none">Dirección Fiscal</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-items">
                                                        <a href="#datos-legales" data-toggle="tab" class="nav-link">
                                                            <span class="d-sm-none">Tab 2</span>
                                                            <span class="d-sm-block d-none">Datos Legales</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane fade active show" id="direccion_fiscal">
                                                        <div class="row">
                                                            <div class="form-group col-4">
                                                                <label>Estado</label>
                                                                <select id="id_estado" name="id_estado" class="form-control" onclick="llenar_municipio();listar_ciudades();">
                                                                    <option>Seleccione</option>
                                                                    <?php foreach ($estados as $data) : ?>
                                                                        <option value="<?= $data['id'] ?>"><?= $data['descedo'] ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-4">
                                                                <label>Municipio</label>
                                                                <select id="id_municipio" name="id_municipio" class="form-control"  onclick="llenar_parroquia();">
                                                                    <option>Seleccione</option>
                                                                    <!-- <option value="1">Libertador</option> -->
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-4">
                                                                <label>Parroquia</label>
                                                                <select id="id_parroquia" name="id_parroquia" class="form-control">
                                                                    <option>Seleccione</option>
                                                                    <!-- <option value="1">Catia</option> -->
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-12">
                                                                <label>Dirección</label>
                                                                <textarea class="form-control" id="direccion_fiscal" name="direccion_fiscal" rows="3" cols="125"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="datos-legales">
                                                        <div class="row">
                                                            <div class="form-group col-6">
                                                                <label>Gaceta Oficial</label>
                                                                <input type="text" name="gaceta_oficial" class="form-control <?php echo form_error('gaceta_oficial') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('gaceta_oficial'); ?>">
                                                                <div class="invalid-feedback">
                                                                    <?php echo form_error('gaceta_oficial'); ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <label>Fecha de Gaceta</label>
                                                                <input type="date" class="form-control" name="fecha_gaceta" placeholder="Seleccionar Fecha" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 text-center">
                                                    <button type="submit" class="btn btn-success" style="color: black;">Guardar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="entes" class="modal " role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Crear Organismo</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="undeje" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Crear Organismo</h4>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <script src="<?= base_url() ?>/js/dante.js"></script>
     <script src="<?= base_url() ?>/js/dependientes.js"></script>
     <script>
        <?php if ($this->session->flashdata("success")) : ?>
            Swal.fire({
                icon: 'success',
                title: 'Cuenta-Dante Registrado Correctamete',
                text: '<?php echo $this->session->flashdata("success"); ?>',
            });
        <?php endif; ?>
    </script>
 </body>

 </html>
