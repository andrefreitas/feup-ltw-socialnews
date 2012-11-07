<?php

class dataAccess{
	protected $dataBaseName;

	function __construct($dbName) {
     self::$dataBaseName=$dbName;
   }
   
}

$teste= new dataAccess(1);
?>