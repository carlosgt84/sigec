<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Strings for component 'block_publishflow', language 'es_mx', branch 'MOODLE_23_STABLE'
 *
 * @package   block_publishflow
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['accesscategory'] = 'Plataformas Autorizadas';
$string['activities'] = 'Actividad(es)';
$string['allowfreecategoryselection'] = 'Selección libre de categorías destino';
$string['allowfreecategoryselectiondesc'] = 'Si se habilita, el usuario puede elegir la categoría remota final (visible o no) en donde estará el curso desplegado, de lo contrario, se eligirá la categoría configurada por defecto en la configuración remota.';
$string['alreadypublished'] = 'El curso ya está publicado. Usted puede ocultarlo y actualizarlo desde un nuevo respaldo.';
$string['autobackup'] = 'Respaldo automático';
$string['backsettings'] = 'Regresar a página de configuraciones';
$string['backtocourse'] = 'Navegar de regreso al curso';
$string['badkey'] = 'La clave para desplegar no es la que se esperaba.';
$string['badresponse'] = ': el cliente no respondió';
$string['blockname'] = 'Publicación de Curso';
$string['catalog'] = 'Catálogo';
$string['catupdate'] = 'Actualizar catálogo';
$string['cdprivate'] = 'Sesiones privadas.';
$string['cdpublicread'] = 'Sesiones públicas. Usuario no revisado.';
$string['cdpublicwrite'] = 'Sesiones públicas. Revisar identidad de usuario';
$string['choosecat'] = 'Categoría:';
$string['choosecatdefault'] = 'Categoría por defecto';
$string['choosetarget'] = 'Destino:';
$string['clientfailure'] = ': el cliente no contestó, pudiera estar fuera-de-línea o no tener los servicios requeridos habilitados.';
$string['close'] = 'Cerrar';
$string['closedcategory'] = 'Cerrando Categoría';
$string['closedcategory_desc'] = 'Categoría para sesiones de curso archivado';
$string['closehelper'] = 'Nosotros recomendamos encarecidamente que haga un  <b>respaldo completo del curso</b> (incluyendo datos y archivos de usuarios) y guarde Usted una copia. Observe que el proceso de "Generar un Paquete" NO realiza un respaldo completo, simplemente del contenido del curso para transferir la estructura del curso a otros nodos dentro de la red.';
$string['closeprivate'] = 'Cierre privado';
$string['closeprivatehelper'] = 'Cuando se cierra en "modo privado", solamente los administradores y entrenadores pueden ver el contenido del curso. Los otros usuarios no tendrán más acceso. Los aprendices todavía permanecerán inscritos dentro de la sesión, por lo que queda la posibilidad de volver a abrir el curso, empleando las configuraciones del curso.';
$string['closeprotected'] = 'Cierre protegido';
$string['closeprotectedhelper'] = 'Cuando se cierra en "modo protegido", a todos los aprendices se les asigna un rol "deshabilitado", y todavía podrán tener acceso de lectura a los materiales producidos.';
$string['closepublic'] = 'Cierre público';
$string['closepublichelper'] = 'Cuando se cierra en "modo público", se le permitirá a cualquier usuario autenticado navegar el contenido del curso y todas las producciones.';
$string['closing'] = 'Cerrando sesión';
$string['collection'] = 'Colección';
$string['combined'] = 'Tipo Combinado (fábrica + catálogo)';
$string['combinedname'] = 'Fábrica y Catálogo';
$string['completed'] = 'ha concluido. Ha sido asignado el identificador único siguiente : {$a}';
$string['configenableretrofit'] = 'Si esta opción se habilita, el curso puede reconvertirse al nodo(s) de fábrica de curso conocido(s) en la red.';
$string['configmoodlenodetype'] = 'Configurar tipo de Nodo Moodle';
$string['configsubmitto'] = 'Someter configuración a';
$string['confirmupgrade'] = '¿Está seguro de querer actualizar su catálogo?';
$string['contributors'] = 'Contribuyentes';
$string['cost'] = 'Costo por uso';
$string['courseclosed'] = 'Curso cerrado.';
$string['coursecontrol'] = 'Control de curso:';
$string['coursedeliveryislocal'] = 'Los archivos no serán distribuidos por transferencias en red, sino por medio del sistema de archivos local. Esta opción solamente funciona para Moodles que comparten la misma área de almacenamiento.';
$string['coursefordelivery'] = 'Recibiendo curso';
$string['coursefordelivery_desc'] = 'Curso para recibir las descargas de archivos de curso';
$string['courseopen'] = 'El curso está ahora abierto';
$string['createdfields'] = 'Número de campos creados exitosamente:';
$string['datecreated'] = 'Fecha de creación';
$string['defaultplatform'] = 'Local';
$string['defaultrole'] = 'Rol por defecto en cursos entrantes';
$string['defaultrole_desc'] = 'Este rol es asignado automáticamente al desplegador en los cursos publicados, desplegados o reconvertidos. Tenga presente que esta configuración actúa sobre cursos que son empujados a este Moodle. Para configurar un rol en una plataforma remota en donde empujar volúmenes de curso, Usted necesitará configurar esta opción en la plataforma remota.';
$string['deploy'] = 'Desplegar';
$string['deploycategory'] = 'Categoría por defecto';
$string['deploycategory_desc'] = 'Categoría de Curso para el desplegado por defecto de cursos';
$string['deployfortest'] = 'Desplegar para pruebas:';
$string['deployfortest_help'] = '<h2>Desplegado de Sendero de Aprendizaje (Learning Path)</h2>
<h3>Desplegar para pruebas</h3>

<p>Cualquier Autor de Learnig Path puede desplegar un (Learning Path) Sendero de Aprendizaje  en su propio nodo.</p> <p>El desplegado automáticamente enfocará la categoría de sesión hacia "uso libre" ("free use").</p>';
$string['deployfreeuse'] = 'Desplegar';
$string['deploying'] = 'Desplegando un curso';
$string['deployment'] = 'Desplegado de curso';
$string['deploymentkey'] = 'Clave de desplegado';
$string['deploymentkeydesc'] = 'Si se configura aquí una clave, el usuario tendrá que proporcionar esta clave al desplegar. Dejar vacío para deshabilitar.';
$string['deployname'] = 'Desplegado de curso';
$string['deploysuccess'] = 'Desplegado exitoso.';
$string['disabledstudentdesc'] = 'Estudiantes discapacitados (con capacidades diferentes) comparten todas las capacidades con estudiantes, pero no se les permitará más cambiar contenidos de un curso';
$string['disabledstudentrole'] = 'Estudiantes discapacitados (con capacidades diferentes)';
$string['dobackup'] = 'Hacer un respaldo';
$string['doclose'] = 'Cerrar el curso';
$string['doopen'] = 'Abrir el curso';
$string['dosynch'] = 'Re-sincronizar mis hosts';
$string['enableretrofit'] = 'Habilitar retro-alimentar cursos';
$string['enterkey'] = 'Clave para desplegar';
$string['erroradvice'] = 'Errores en su catálogo de plataforma ({$a} error(es)). Por favor corra este script antes de usar las fábricas de cursos';
$string['errorbadblockid'] = 'ID de bloque defectuosa';
$string['errorencountered'] = 'ha encontrado un error :';
$string['errormonitoring'] = 'Parece que Usted tiene :';
$string['errorunpublished'] = 'El curso no tiene un respaldo publicable, por favor haga uno primeramente.';
$string['factory'] = 'Fábrica';
$string['factoryprefix'] = 'Prefijo de fábrica';
$string['factoryprefix_desc'] = 'Prefijo de la plataforma de fábrica';
$string['failed'] = 'La operación falló';
$string['failedfields'] = 'Número de fallas:';
$string['fieldname'] = 'Acceso a plataforma';
$string['finish'] = 'Terminar';
$string['freeuse_help'] = '<h2>Usando sesiones de rutas de aprendizaje de "uso libre"</h2> <p>Cualquier usuario en el modelo de desempeño puede usar libremente las rutas de aprendizaje para un equipo de trabajo local. Este módulo le permite a cualquier usuario registrado y acreditado, desplegar y tomar posesión de una sesión de trabajo de instancia de Sendero de Aprendizaje (Learning Path) .</p>

<p>Este desplegado creará un espacio de trabajo completo en el nodo del usuario, copiando el escenario pedagógico completo al espacio de trabajo creado. El iniciador del desplegador estará inscrito como entrenador dentro del nuevo lugar de trabajo, y se le permitirá inscribir aprendices.</p>

<p>El desplegado de "uso libre" naturalmente usará como destino el nodo original del solicitante.</p>

<p>Cuando se termine el despliegue, a Usted se le invitará a  navegar en el nuevo ambiente de entrenamiento creado.</p>';
$string['helpsynch'] = 'Sincronizando plataforma';
$string['ignoredfields'] = 'Número de hosts ignorados:';
$string['indexing'] = 'Indexación';
$string['indexingof'] = 'Referenciando un curso';
$string['islocal'] = 'Almacenamiento de Datos Local';
$string['jumptothecourse'] = 'Saltar a la nueva instancia de curso';
$string['lastmodified'] = 'Última modificación';
$string['learningarea'] = 'Área de Aprendizaje';
$string['leavehere'] = 'Dejar en su propia categoría';
$string['mainhostprefix'] = 'Prefijo de host principal';
$string['mainhostprefix_desc'] = 'Prefijo de la plataforma de alojamiento (hosting) principal';
$string['mainuseradvice'] = 'Siendo un usuario definido por el entorno principal, Usted no posee ningún destino a donde desplegar.';
$string['managename'] = 'Reconvertir y gestionar cursos';
$string['managepublishedfiles'] = 'Gestionar Archivos Publicados';
$string['moodlenodetype'] = 'Tipo de Nodo Moodle';
$string['networkrefreshautomation'] = 'Refresco de Red Automático';
$string['networktransferadvice'] = 'Precaución: el mandar un paquete de ruta completa por la red puede tomar un cierto tiempo. A pesar que en la mayoría de los casos comunes han sido contemplados, la transferencia de algunos archivos particularmente grandes puede fallar. Contacte a su administrador de sistemas/redes.';
$string['noassignation'] = 'Sin asignación';
$string['noautomatednetworkrefreshment'] = 'Deshabilitado';
$string['nocatalog'] = 'No se encontró catálogo en el ambiente de red. Por favor revise las configuraciones centrales del bloque';
$string['nodeploytargets'] = 'No encontramos destino a desplegar para su definición de perfil';
$string['noexistingtargets'] = 'No existen destinos';
$string['nofactory'] = 'No hay fábrica. La configuración del sistema no está correcta para la acción de reconversión.';
$string['normalmoodle'] = 'Moodle estándar';
$string['notargets_help'] = '<h2>Sin blancos para desplegar</h2> <p>El sistema de desplegado del Sendero de Aprendizaje (Learning Path) no encontró ningún candidato en donde instalar una sesión de trabajo: Las siguientes situaciones deben investigarse:</p> <ul>

<li>Usted no es un Administrador de Entidad ni un Profesor Titular de ninguna de las plataformas de entrenamiento disponibles.</li>

<li>Algunos problemas técnicos impiden físicamente conectarse a los nodos de entrenamiento de su responsabilidad.</li>

<li>Este sendero de aprendizaje no puede desplegarse por estar mal referenciado.</li> <ul>

<p>En cualquier caso, contacte a su soporte técnico local.</p>';
$string['notification'] = 'Abierto con notificación a aprendices';
$string['notpublishedyet'] = 'Aún no publicado.';
$string['OKmonitoring'] = 'La información de red está actualizada. Usted no necesita re-ejecutar este script.';
$string['oneday'] = 'Una vez al día';
$string['onemonth'] = 'Una vez al mes';
$string['oneweek'] = 'Una vez a la semana';
$string['open'] = 'Abrir el curso';
$string['opening'] = 'Abriendo cursos';
$string['opennotifyhelper'] = 'Usando este modo de apertura, Usted les dará acceso a el espacio de trabajo de la sesión de entrenamiento y enviará una notificación de apertura a todos los usuarios registrados en el curso.';
$string['openwithoutnotifyhelper'] = 'Usando este modo de apertura, Usted abrirá <b>silenciosamente</b> la sesión del curso para los usuarios. No se enviarán correos.';
$string['perform'] = 'Realizar la actualización';
$string['platformlastupdate'] = 'Última actualización realizada en';
$string['platformname'] = 'Nombre de Plataforma';
$string['platformstatus'] = 'Tipo de Plataforma';
$string['pluginname'] = 'Flujograma de Publicación de Curso';
$string['publicsessions'] = 'Permitir sesiones públicas';
$string['publicsessions_desc'] = 'Si se habilita, los servidores pueden proporcionarle listas de sesión sin revisar la identidad del usuario';
$string['publish'] = 'Publicar';
$string['publishconfirm'] = 'La visibilidad en el catálogo maestro de cursos es inmediata. ¿Continuar?';
$string['publishedhidden'] = 'El curso está en el catálogo maestro de cursos, pero configurado a oculto. Usted puede volverlo visible de nuevo.';
$string['publishflow'] = 'Renovación del Catálogo de Plataforma';
$string['publishflow:addtocourse'] = 'Añadir el bloque de publicación al curso';
$string['publishflowbackups'] = 'Respaldos de FlujoPublicar (Publishflow)';
$string['publishflowbackupsadvice'] = 'Por favor observe que al eliminar archivos de esta área posiblemente causará una descompostura del desplegado de este curso.';
$string['publishflow:deploy'] = 'Desplegar un curso a un nodo de aprendizaje';
$string['publishflow:deployeverywhere'] = 'Desplegar a todos lados';
$string['publishflow_description'] = 'Este servicio agrupa todas las funciones dedicadas a la publicación de cursos mediante MNET. Usted necesita suscribirse y publicar en ambos lados para habilitar la transferencia de cursos.';
$string['publishflow:manage'] = 'Gestionar la sesión de entrenamiento';
$string['publishflow:managelpoffer'] = 'Gestionar la oferta local en nodos de entrenamiento';
$string['publishflow_name'] = 'Servicios de FlujoPublicar (Publishflow)';
$string['publishflow:publish'] = 'Publicar cursos en catálogo principal';
$string['publishflow:retrofit'] = 'Puede reconvertir el curso a una Fábrica';
$string['publishing'] = 'Publicación';
$string['publishname'] = 'Publicación de curso';
$string['publishsuccess'] = 'Publicación exitosa';
$string['publishtooltip'] = 'Publicar el catálogo maestro de cursos';
$string['reference'] = 'Referencia';
$string['reopen'] = 'Abrir nuevamente';
$string['republish'] = 'Actualizar';
$string['republishconfirm'] = 'Usted remplazará el curso actualmente publicado con el nuevo contenido. ¿Continuar?';
$string['republishtooltip'] = 'Forzar actualización';
$string['retrofeedname'] = 'Retro-alimentar a fábrica';
$string['retrofit'] = 'Reconvertir en la fábrica';
$string['retrofit_help'] = '<h2>FlujoPublicar Cursos</h2>
<h3>Reconvertir cursos a fábrica</h3>

<p>Reconvertir copiará este curso a la instancia de fábrica designada en la red</p>

<p>Al lanzar la operación de reconversión, Usted copiará la estructura y contenido de este curso tal como estuvo almacenada en el último respaldo guardado en los archivos del curso.</p>

<p>El resplado usado para reconvertir DEBE IGNORAR cualquier información relacionada con usuarios y datos del curso; y reproducir las actividades, recursos y bloques con las mismas configuraciones que el original.</p>

<p>La unidad reconvertida estará disponible en una categoría predefinida, a menos que se elija la opción de abrir una categoría para destino.</p>';
$string['retrofiting'] = 'Reconvertir:';
$string['retrofitsuccess'] = 'Reconversión terminada.';
$string['retrofitting'] = 'Reconvirtiendo la ruta a la fábrica';
$string['runningcategory'] = 'Categoría activa';
$string['runningcategory_desc'] = 'Categoría para sesiones activas';
$string['sessionopening'] = 'Abriendo los cursos';
$string['single_full'] = 'Sincronizar tipos de plataforma y categorías';
$string['single_short'] = 'Sincronizar plataformas';
$string['step'] = 'Paso';
$string['submitname'] = 'Enviar nombre';
$string['submittodesc'] = 'Enviar abajo';
$string['synchonizingnetworkconfig'] = 'Adquiriendo la estructura de la red';
$string['synchplatforms'] = '<p>Si recientemente se ha añadido un nuevo host de Moodle a su red, Usted puede re-sincronizar la definicón de los campos de usuario de acceso empleando este script.</p><p>En una red de publicación, el acceso a los hosts en la red está controlado por campos de perfil de usuario personalizado dedicados.</p>';
$string['testdeploy'] = 'Desplegado de prueba';
$string['unavailable'] = 'No hay respaldo disponible. Usted debe respaldar sin datos de usuario antes de transferir.';
$string['unpublish'] = 'Des-publicar';
$string['unpublishable'] = 'No publicable';
$string['unpublishconfirm'] = 'El efecto sobre el catálogo maestro de cursos es inmediato. ¿Continuar?';
$string['unpublishtooltip'] = 'Ocultar el curso en el catálogo maestro de cursos';
$string['unregistered'] = 'Esta ruta no ha recibido aprobación oficial. No se puede publicar ni desplegar.';
$string['updateok'] = 'ha sido actualizado exitosamente';
$string['URL'] = 'URL';
$string['warningadvice'] = 'Advertencias en el catálogo de su plataforma ({$a} advertencia(s)). Por favor considere correr este script pronto.';
$string['warningload'] = 'ADVERTENCIA: La operación que está a punto de ejecutar tiene una carga pesada. ¡NO LA EJECUTE a menos que lo haya pensado realmente bien!';
$string['withoutnotification'] = 'Abrir sin notificar a los usuarios';
