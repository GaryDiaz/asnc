<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//******************************************************************************
//***                 RUTAS DE LAS PAGINAS DE GESTION                        ***
//******************************************************************************
$route['diasferiados'] = 'Gestion/dias_feriados';
$route['gestionlapsos'] = 'Gestion/lapsos';
$route['perfilinstitucional'] = 'Gestion/perfilinstitucional';
$route['regllamadoconcurso']['get'] = 'Gestion/registrollamado';
$route['editllamadoconcurso/(:any)']['get'] = 'Gestion/editarllamado/$1';
$route['llamadoconcurso']['get'] = 'Gestion/llamadoconcurso';
//******************************************************************************
//******************************************************************************
//***               RUTAS PARA EL SERVICIO DE FORMULARIOS                    ***
//******************************************************************************
$route['frmFeriadoEspecifico'] = 'Formulario/feriado_especifico';
$route['frmFeriadoMunicipal'] = 'Formulario/feriado_municipal';
$route['frmFeriadoEstadal'] = 'Formulario/feriado_estadal';
$route['frmFeriadoNacional'] = 'Formulario/feriado_nacional';
$route['frmConfirmarBorrar'] = 'Formulario/confirmar_borrar';
$route['frmEntidadDescriptiva'] = 'Formulario/entidad_descriptiva';
$route['frmLapso'] = 'Formulario/lapso';
//******************************************************************************
//
//         ***   ******   ***    ******   ********  *****   ********
//       *** *** ***  *** ***    ***  *** ***      **    *     **
//      ***  *** ***  *** ***    ***  *** ******    ****       **
//      ******** ******   ***    ******   ******        ***    **
//      ***  *** ***      ***    ***  **  ***      *    **     **
//      ***  *** ***      ***    ***  *** ********  *****      **
//
//******************************************************************************
//******************************************************************************
//***                    Rutas para Llamados a Concurso                      ***
//******************************************************************************
$route['apirest/calcularLapsos/(:any)/(:any)/(:num)/(:num)/(:num)']['get'] = 'LlamadoConcursoRest/calcular_lapsos/$1/$2/$3/$4/$5';
$route['apirest/recalcularLapsos/(:any)/(:any)/(:any)']['get'] = 'LlamadoConcursoRest/recalcular_lapsos/$1/$2/$3';
$route['apirest/llamadoConcurso']['get'] = 'LlamadoConcursoRest/buscar_todos';
$route['apirest/llamadoConcursoPropio']['get'] = 'LlamadoConcursoRest/buscar_todos_propios';
$route['apirest/llamadoConcurso/(:any)']['get'] = 'LlamadoConcursoRest/buscar_por_numero_proceso/$1';
$route['apirest/llamadoConcurso/(:any)/(:any)']['get'] = 'LlamadoConcursoRest/buscar_por_rif_y_numero_proceso/$1/$2';
$route['apirest/llamadoConcurso/(:any)/(:num)']['get'] = 'LlamadoConcursoRest/buscar_por_texto/$1/$2';
$route['apirest/llamadoConcurso/(:any)/(:any)/(:any)/(:num)']['get'] = 'LlamadoConcursoRest/buscar_por_fecha/$1/$2/$3/$4';
$route['apirest/llamadoConcurso']['post'] = 'LlamadoConcursoRest/llamado_concurso';
$route['apirest/llamadoConcurso/(:any)/(:any)']['put'] = 'LlamadoConcursoRest/llamado_concurso/$1/$2';


//******************************************************************************
//***                      RUTAS PARA LAS DIRECCIONES                        ***
//******************************************************************************
$route['apirest/estados'] = 'DireccionRest/estados';
$route['apirest/estado/(:num)'] = 'DireccionRest/estado/$1';
$route['apirest/municipios/(:num)'] = 'DireccionRest/municipios/$1';
$route['apirest/municipio/(:num)'] = 'DireccionRest/municipio/$1';
$route['apirest/parroquias/(:num)'] = 'DireccionRest/parroquias/$1';
$route['apirest/parroquia/(:num)'] = 'DireccionRest/parroquia/$1';
//******************************************************************************
//***                  RUTAS PARA LA GESTION DE LAPSOS                       ***
//******************************************************************************
$route['apirest/lapso/(:num)/(:num)/(:num)']['get'] = 'LapsoRest/lapso/$1/$2/$3';
$route['apirest/lapsos']['get'] = 'LapsoRest/lapsos';
$route['apirest/lapso/(:num)/(:num)/(:num)']['delete'] = 'LapsoRest/lapso/$1/$2/$3';
$route['apirest/lapso']['post'] = 'LapsoRest/lapso';
$route['apirest/lapso']['put'] = 'LapsoRest/lapso';
//------------------------------------------------------------------------------
$route['apirest/mecanismo/(:num)']['get'] = 'LapsoRest/mecanismo/$1';
$route['apirest/mecanismos']['get'] = 'LapsoRest/mecanismos';
$route['apirest/mecanismo/(:num)']['delete'] = 'LapsoRest/mecanismo/$1';
$route['apirest/mecanismo']['post'] = 'LapsoRest/mecanismo';
$route['apirest/mecanismo']['put'] = 'LapsoRest/mecanismo';
//------------------------------------------------------------------------------
$route['apirest/modalidad/(:num)']['get'] = 'LapsoRest/modalidad/$1';
$route['apirest/modalidades']['get'] = 'LapsoRest/modalidades';
$route['apirest/modalidad/(:num)']['delete'] = 'LapsoRest/modalidad/$1';
$route['apirest/modalidad']['post'] = 'LapsoRest/modalidad';
$route['apirest/modalidad']['put'] = 'LapsoRest/modalidad';
//------------------------------------------------------------------------------
$route['apirest/objetocont/(:num)']['get'] = 'LapsoRest/objeto_contratacion/$1';
$route['apirest/objetoscont']['get'] = 'LapsoRest/objetos_contratacion';
$route['apirest/objetocont/(:num)']['delete'] = 'LapsoRest/objeto_contratacion/$1';
$route['apirest/objetocont']['post'] = 'LapsoRest/objeto_contratacion';
$route['apirest/objetocont']['put'] = 'LapsoRest/objeto_contratacion';
//******************************************************************************
//******************************************************************************
//***                RUTAS PARA LA GESTION DE ORGANO-ENTE                    ***
//******************************************************************************
$route['apirest/organo/(:num)'] = 'APIRest/organo/$1';
$route['apirest/organo/(:any)'] = 'APIRest/organo_por_rif/$1';
$route['apirest/organos'] = 'OrganoEnteRest/organos';
$route['apirest/organo']['put'] = 'OrganoEnteRest/organo';
$route['apirest/organospadres']['get'] = 'OrganoEnteRest/organos_padres';
$route['apirest/organosadscritos']['get'] = 'OrganoEnteRest/organos_adscritos';
$route['apirest/miperfilinstitucional']['get'] = 'OrganoEnteRest/organo_propio';
$route['apirest/miperfilinstitucionaldetalle']['get'] = 'OrganoEnteRest/organo_propio_detalle';
//******************************************************************************
//******************************************************************************
//***                Rutas para los Feriados Específicos                     ***
//******************************************************************************
$route['apirest/feriadoEspecifico/(:any)']['get'] = 'FeriadoRest/feriado_especifico/$1';                //PK (fecha (aaaa-mm-dd))
$route['apirest/feriadosEspecificos']['get'] = 'FeriadoRest/feriados_especificos';                      //Todos
$route['apirest/feriadosEspecificos/(:num)']['get'] = 'FeriadoRest/feriados_especificos_por_anio/$1';   //Varios por año
$route['apirest/feriadosEspecificos/(:any)']['get'] = 'FeriadoRest/feriados_especificos_cercanos/$1';   //Varios Cercanos a la fecha (fecha (aaaa-mm-dd))
$route['apirest/feriadosEspecificos']['put'] = 'FeriadoRest/feriados_especificos';                      //Varios por descripcion
$route['apirest/feriadosEspecificos2']['put'] = 'FeriadoRest/feriados_especificos2';                    //Varios por descripcion y anio
//------------------------------------------------------------------------------
$route['apirest/feriadoEspecifico']['post'] = 'FeriadoRest/feriado_especifico';                         //Agregar
$route['apirest/feriadoEspecifico']['put'] = 'FeriadoRest/feriado_especifico';                          //Editar
$route['apirest/feriadoEspecifico/(:any)']['delete'] = 'FeriadoRest/feriado_especifico/$1';             //Eliminar PK (fecha (aaaa-mm-dd))
//******************************************************************************
//******************************************************************************
//***                Rutas para los Feriados Nacionales                      ***
//****************************************************************************** 
$route['apirest/feriadoNacional/(:num)/(:num)']['get'] = 'FeriadoRest/feriado_nacional/$1/$2';          // PK (Mes y día)
$route['apirest/feriadosNacionales']['get'] = 'FeriadoRest/feriados_nacionales';                        // Todos
$route['apirest/feriadosNacionales/(:num)']['get'] = 'FeriadoRest/feriados_nacionales_cercanos/$1';     // Varios por Mes
$route['apirest/feriadosNacionales']['put'] = 'FeriadoRest/feriados_nacionales';                        // Varios Por descripcion
//------------------------------------------------------------------------------
$route['apirest/feriadoNacional']['post'] = 'FeriadoRest/feriado_nacional';                             //Agregar
$route['apirest/feriadoNacional']['put'] = 'FeriadoRest/feriado_nacional';                              //Editar
$route['apirest/feriadoNacional/(:num)/(:num)']['delete'] = 'FeriadoRest/feriado_nacional/$1/$2';       //Eliminar PK (Mes y día)
//******************************************************************************
//******************************************************************************
//***                Rutas para los Feriados Estadales                       ***
//******************************************************************************
$route['apirest/feriadoEstadal/(:num)/(:num)/(:num)']['get'] = 'FeriadoRest/feriado_estadal/$1/$2/$3';      //PK (id_estado, mes y dia)
$route['apirest/feriadosEstadales/(:num)']['get'] = 'FeriadoRest/feriados_estadales/$1';                    //Todos por id_estado
$route['apirest/feriadosEstadales/(:num)/(:num)']['get'] = 'FeriadoRest/feriados_estadales_cercanos/$1/$2'; //Varios por id_estado y mes
$route['apirest/feriadosEstadales']['put'] = 'FeriadoRest/feriados_estadales';                              //Varios por id_estado y descripcion
//------------------------------------------------------------------------------
$route['apirest/feriadoEstadal']['post'] = 'FeriadoRest/feriado_estadal';                                   //Agregar
$route['apirest/feriadoEstadal']['put'] = 'FeriadoRest/feriado_estadal';                                    //Editar
$route['apirest/feriadoEstadal/(:num)/(:num)/(:num)']['delete'] = 'FeriadoRest/feriado_estadal/$1/$2/$3';   //Eliminar PK (id_estado, mes y dia)
//******************************************************************************
//******************************************************************************
//***                 Rutas para los Feriados Municipales                    ***
//******************************************************************************
$route['apirest/feriadoMunicipal/(:num)/(:num)/(:num)']['get'] = 'FeriadoRest/feriado_municipal/$1/$2/$3';  //PK (id_municipio, mes y dia)
$route['apirest/feriadosMunicipales/(:num)']['get'] = 'FeriadoRest/feriados_municipales/$1';                //Todos por id_municipio
$route['apirest/feriadosMunicipales/(:num)/(:num)']['get'] = 'FeriadoRest/feriados_municipales_cercanos/$1/$2'; //Varios por id_municipio y mes
$route['apirest/feriadosMunicipales']['put'] = 'FeriadoRest/feriados_municipales';                          //Varios por id_estado y descripcion
//------------------------------------------------------------------------------
$route['apirest/feriadoMunicipal']['post'] = 'FeriadoRest/feriado_municipal';                               //Agregar
$route['apirest/feriadoMunicipal']['put'] = 'FeriadoRest/feriado_municipal';                                //Editar
$route['apirest/feriadoMunicipal/(:num)/(:num)/(:num)']['delete'] = 'FeriadoRest/feriado_municipal/$1/$2/$3';//Eliminar PK (id_municipio, mes y dia)
//******************************************************************************
