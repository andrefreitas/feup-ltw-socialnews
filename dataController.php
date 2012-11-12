<?php

define(SQL_PATH,"..\data\\");

$p="teste";

$teste1=SQL_PATH.$p;
echo $teste1;

class dataController{
	protected $dataBaseName;

	function __construct($dbName) {
     self::$dataBaseName=SQL_PATH.$dbName;
     echo "Data base name".$dataBaseName;
   }
   
}

$teste= new dataController(1);
?>