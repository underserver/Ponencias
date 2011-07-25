<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Funciones de utlidad
 * 			 thumbjpeg		: Genera un thumbail de una imagen (requiere GD)
 * 			 diffdates		: Compara dos fechas
 *
 ***********************************************************************/

function thumbjpeg($imagen,$altura) {

	// Lugar donde se guardarán los thumbnails respecto a la carpeta donde está la imagen "grande".
	$dir_thumb = "";

	// Prefijo que se añadirá al nombre del thumbnail. Ejemplo: si la imagen grande fuera "imagen1.jpg",
	// el thumbnail se llamaría "tn_imagen1.jpg"
	$prefijo_thumb = "th_";
	$camino_nombre=explode("/",$imagen);

	// Aquí tendremos el nombre de la imagen.
	$nombre=end($camino_nombre);

	// Aquí la ruta especificada para buscar la imagen.
	$camino=substr($imagen,0,strlen($imagen)-strlen($nombre));

	// Intentamos crear el directorio de thumbnails, si no existiera previamente.
	if (!file_exists($camino.$dir_thumb))
	mkdir ($camino.$dir_thumb, 0777) or die("No se ha podido crear el directorio $dir_thumb");

	// Aquí comprovamos que la imagen que queremos crear no exista previamente
	if (!file_exists($camino.$dir_thumb.$prefijo_thumb.$nombre)) {
		$img = imagecreatefromjpeg($camino.$nombre) or die("No se encuentra la imagen $camino$nombre<br>n");

		// miramos el tamaño de la imagen original...
		$datos = getimagesize($camino.$nombre) or die("Problemas con $camino$nombre<br>n");

		// intentamos escalar la imagen original a la medida que nos interesa
		$ratio = ($datos[1] / $altura);
		$anchura = round($datos[0] / $ratio);

		// esta será la nueva imagen reescalada
		$thumb = imagecreatetruecolor($anchura,$altura);

		// con esta función la reescalamos
		imagecopyresampled ($thumb, $img, 0, 0, 0, 0, $anchura, $altura, $datos[0], $datos[1]);

		// voilà la salvamos con el nombre y en el lugar que nos interesa.
		imagejpeg($thumb,$camino.$dir_thumb.$prefijo_thumb.$nombre);
	}
}

function diffdates($fecha1,$fecha2)
{
	if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha1))
	list($año1,$mes1,$dia1)=split("/",$fecha1);
	if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha1))
	list($año1,$mes1,$dia1)=split("-",$fecha1);
	if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha2))
	list($año2,$mes2,$dia2)=split("/",$fecha2);
	if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha2))
	list($año2,$mes2,$dia2)=split("-",$fecha2);
	$dif = mktime(0,0,0,$mes1,$dia1,$año1) - mktime(0,0,0, $mes2,$dia2,$año2);
	return ($dif);
}

function spanStatus($status){
  $text = "Desconocido";
  switch($status){
    case 1: $text = "SIN ASIGNAR EVALUADORES"; break;
    case 2: $text = "EN ESPERA DE EVALUACION"; break;
    case 3: $text = "ACEPTADA"; break;
    case 4: $text = "RECHAZADA"; break;
  }
  
  return "<span class='s".$status."'>".$text."</span>";
}
?>