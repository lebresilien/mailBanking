<?php

  if(isset($_FILES['fichier']) && !empty($_FILES['fichier']['tmp_name']))
  {
      
      include("../PHPExcel/IOFactory.php");
      include_once("../modeles/connexion_to_bd.php") ;
      
      $objPHPExcel = PHPExcel_IOFactory::load($_FILES['fichier']['tmp_name']);
      $bd_connection = new connexion_to_bd() ; $bd_connection->etablir_connection();

      foreach($objPHPExcel->getWorksheetIterator() as $worksheet){

		      $highestRow = $worksheet->getHighestRow();

		      for($row = 2 ; $row <= $highestRow ; $row++){	
 
             $account =  $worksheet->getCellByColumnandRow(0,$row)->getValue().'_';
            
             echo $account;
	        }

	        

	    }

  }