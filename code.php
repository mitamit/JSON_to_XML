<?php

$bot = new parser();
$bot->run();


class parser
{
	//Inicio del XML
	public $xml_output = "<?xml version='1.0' encoding='UTF-8'?>\n<bot>\n";
	
	public function run()
	{
		// Abrir el archivo json y guardar en un string el contenido del JSON
		$path = 'C:\Users\jmgle\Desktop\pruebaTIENDEO\stores.json';
		$data = file_get_contents($path);

		// Le pasamos el string a la función crowInfo
		$this->crowInfo($data);
		

	}

	function crowInfo($info)
	{
		// Separar la info por tiendas
		// Puedes dividir la info con json_decode o utilizando expresiones regulares y preg_match
		// http://php.net/manual/es/function.json-decode.php
		// EXAMPLE:
		// $texto = "coche: ford, coche: audi, coche: renault, coche: mercedes,";
		//	if(preg_match_all('/coche:(.*?),/is', $texto, $datos))
		//  {
		//		for($i = 0; $i < count($datos[0]); $i++)
		//      {		
		//         echo $datos[1][$i];    // ford... audi... renault... mercedes
		//		   $this->crowStore($datos[1][$i]);    Enviamos el string con la info de cada tienda a la función crowStore
		//		}
		//	}
		
		/*if(preg_match_all('/StoreId:(.*?)}/is', $info, $datos))
		{
			for($i = 0; $i < count($datos[0]); $i++)
			{
				$this->crowStore($datos[1][$i]);
			}
		}*/
		 
		
			
			if(preg_match_all('/{(.*?)}/is', $info, $datos))
			{
				for($i = 0; $i < count($datos[0]); $i++){
					$this->crowStore($datos[1][$i]);
					var_dump($datos);
			}
		}
		

		


		


		// Una vez rellenado el $xml_output con al info de cada tienda CERRAMOS EL XML
		$this->xml_output .= "</bot>";


		// Guardamos la info en el archivo output.xml
		
		
		$archivo = fopen("C:\\wamp64\www\pruebaTIENDEO\output.xml", "x+");
		fwrite($archivo, $this->xml_output);
		fclose($archivo);



		/*$path2 = 'C:\Users\jmgle\Desktop\pruebaTIENDEO\output.xml';
		$write = new XMLWriter();
		$write->openURI($path2);
		$write->flush($this->xml_output);
		*/


		

	}
	function crowStore($info)
	{
		//SEPARAMOS LA INFO DE CADA TIENDA Y LLENAMOS EL XML
		// Puedes dividir la info con json_decode o utilizando expresiones regulares y preg_match
		// EXAMPLE:
		// $texto = "esto es una prueba de php";
		//	if(preg_match('/es una(.*?)de php/is', $texto, $datos))
		//  {
		//		echo $datos[1];    // " prueba "
		//	}
		//

		$this->xml_output .= "<store>";
			
		
				preg_match('/"StoreId":(.*?),/is', $info, $i);
				preg_match('/"Lat":(.*?),/is', $info, $lat);
				preg_match('/"Lng":(.*?),/is', $info, $lng);
				preg_match('/"Phone":(.*?),/is', $info, $tel);
				//preg_match('/"Address":(.*?),/is', $info, $a);
				//preg_match('/"Address":(.*?),/is', $info, $posCod);
				preg_match('/"Address":"(.*?)"/is', $info, $address);
					



				

				var_dump($info);
				//var_dump($i);
				//var_dump($lat);
				//var_dump($lng);
				//var_dump($tel);
				//var_dump($a);
				//var_dump($posCod);
				var_dump($address);
				


				$this->xml_output .= "<address value=". '"' . $address[1] . '"' . " />\n" . "<phonenumber value=" . $tel[1] . " />\n" . "<coordinates lat=" . '"' .$lat[1]  .'"' . " lon=" . '"' . $lng[1] . '"' ." />\n" . "<id value=" . $i[1] . " />\n\n"; 
						
		


		$this->xml_output .= "</store>";


	}
	
}


?>