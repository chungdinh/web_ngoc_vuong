<?php 
session_start();
@define ( '_lib' , '../../libraries/');
include_once _lib."config.php";
include_once _lib."constant.php";
include_once _lib."functions.php";
include_once _lib."class.database.php";
$d = new database($config['database']);
if (isAjaxRequest()) {
	$id = $_POST['id'];
	$table = $_POST['table'];
	$type = 'type = "'.$_POST['type'].'"';
	$list = _result_array("SELECT ten_vi as ten,id FROM $table WHERE $type AND id_linhvuc=".$id);
	echo '<option value="">Chọn danh mục</option>';
	foreach ($list as $key => $value) {
		echo '<option value="'.$value['id'].'">'.$value['ten'].'</option>';
	}
}
?>
