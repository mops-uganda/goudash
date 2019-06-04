<?php
require_once ('../lib/script/pdocrud.php');
$pdocrud = new PDOCrud(false, "pure", "pure");
echo $pdocrud->dbTable("meettasks")->render();

