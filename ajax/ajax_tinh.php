<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE & ~8192);
if(!isset($_SESSION['lang'])){
	$_SESSION['lang']='vi';
}
$lang=$_SESSION['lang'];
@define ( '_lib' , '../libraries/');
@define ( '_source' , '../sources/');
include_once _lib."config.php";
include_once _lib."constant.php";;
include_once _lib."functions.php";
include_once _lib."functions_giohang.php";
include_once _lib."class.database.php";
include_once _source."lang_$lang.php";
if(isAjaxRequest()){
	$d = new database($config['database']);
	$id = $_POST['id'];
	$d->reset();
	$sql="SELECT id,ten_vi as ten FROM table_quan WHERE id_list = ".$id."";
	$d->query($sql);
	$huyen = $d->result_array();
	foreach ($huyen as $key => $value) { ?>
	<option value="<?=$value['id']?>"><?=$value['ten']?></option>
	<?php } 
}?>