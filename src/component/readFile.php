<?php
/**
 * Created by PhpStorm.
 * User: Aozak
 * Date: 11/14/2017
 * Time: 8:25 PM
 */
require("../lib/fileOp.php");
$file = new fileOp();
$file->fileSelect("../database.json");
echo $file->fileExist();