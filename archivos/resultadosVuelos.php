<?php
$estructuraConsulta = new estructuraModelo();
	
	$var1 = $_POST['Origen'];
	$var2 = $_POST['destino'];

	//Hago la primer consulta para saber que dias sale el vuelo y ver sin coincide con la seleccionada//
	//************************************************************************************************//
	$diasvuelos = $estructuraConsulta->get_sql('Select Dia_vuelo from vuelo V1 inner join aeropuerto A1
	on V1.Aepto_Origen = A1.idAepto inner join aeropuerto A2 on V1.Aepto_Destino = A2.idAepto
	where A1.Ciudad = "' . $var1 . '" and A2.Ciudad = "' . $var2 . '" ');

	//Cheque cuales son los dias que hace ese vuelo en la semana seguen el binario//
	//****************************************************************************//
	$bin = array();
	foreach ($diasvuelos as $row)
	 {
		echo "</br>DIAS DE VUELO BINARIO COMPLETO : " . $row['Dia_vuelo'];
		$bin = trim($row['Dia_vuelo']);
	 }

	//Dentro del include se hacen las comparaciones dia a dia segun el binario entregado//
	//---------------------------------------------------------------------------------//
	include "archivos/diasVuelo.php";

	//Si la fecha que selecciono posee algun vuelo realizo la consulta para mostrar el vuelo segun los horarios//
	//---------------------------------------------------------------------------------------------------//							
	
	if (($arraydia[$pos]) == ($arraybinarios[$pos]))
	{							
		echo "</br><h1>ESTE VUELO NO TIENE SALIDAS ESA FECHA SELECCIONE OTRA POR FAVOR CHAS GRACIAS AIREXPRESS.COM</H1>";
		$clientes = $estructuraConsulta->get_sql('select A1.Ciudad as CiudadOrigen, A2.Ciudad as CiudadDestino,
		V1.Hora_Salida as HoraSalida, V1.Hora_Llegada as HoraLlegada from vuelo V1 inner join aeropuerto A1
		on V1.Aepto_Origen = A1.idAepto inner join aeropuerto A2 on V1.Aepto_Destino = A2.idAepto
		where A1.Ciudad = "' . $var1 . '" and A2.Ciudad = "' . $var2 . '" ');								
		//----------------//INICIO DE LA TABLA DE RESULTADOS//----------------------//

		foreach ($clientes as $row) {
		 	echo "<div class='wrapper'>";
			echo "<div id='lineaVuelta'>";
			echo "<div class='marker'><ul><li><strong>&nbsp;&nbsp;CLASE</strong></li> <li><strong>HORA DE SALIDA</strong></li> <li><strong>HORA DE LLEGADA</strong></li> <li><strong>PRECIO</strong></li></ul></div>";
			echo "<ul> <label><li><input type='radio' name='v1'></li><li>Primera</li><li> ".$row['HoraSalida']." </li><li>".$row['HoraLlegada']."</li><li> TiempoViaje </li><li> Directo </li><li> LineaAvion </li></label> </ul> ";
			echo "</div>";
			echo "</div>";

             echo "\t<tr>\n";
             echo "<td>".$row['HoraSalida']."</td><td>".$row['HoraLlegada']."</td>";	 	   		 
 	   		 echo "\t</tr>\n";
		 }
	}
else 
{
		echo "</br><h3>ESTE VUELO NO TIENE SALIDAS ESA FECHA SELECCIONE OTRA POR FAVOR CHAS GRACIAS AIREXPRESS.COM</h3>";
}
?>