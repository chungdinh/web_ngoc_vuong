<?php
session_start();
@define ( '_lib' , '../../libraries/');

include_once _lib."config.php";
include_once _lib."constant.php";
include_once _lib."functions.php";
include_once _lib."library.php";
include_once _lib."class.database.php";	
include_once _lib."pclzip.php";
$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";	
if (isAjaxRequest()) {
	$d = new database($config['database']);
	if ($_POST['do'] == 'them') {
		$d->reset();
		$d->query("SELECT count(id) as n FROM table_option WHERE name_vi like '".$_POST['name']."'");
		$num = $d->fetch_array();
		if ($num['n'] == 0) {
			$str = '';
			$data['ten_vi'] = $_POST['ten'];
			$data['name_vi'] = $_POST['name'];
			$data['value'] = $_POST['value'];
			$data['type'] = $_POST['type'];
			$data['ngaytao'] = time();
			$d->setTable('option');
			if ($d->insert($data)) {
				$str .= '<div class="formRow lang_hidden lang_vi active">
				<label>'.$_POST['ten'].'</label>
				<div class="formRight item-capnhat">
				<div class="row">
					<div class="col-xs-12 col-sm-10">
						<input type="text" class="tipS" name="value" data-name="'.$_POST['name'].'" value="'.$_POST['value'].'" />
					</div>
					<div class="col-xs-12 col-sm-2">
						<button type="button" data-id="'.mysql_insert_id().'" class="blueB btn-capnhat">Cập nhật</button>
					</div>
				</div>
				</div>
				<div class="clear"></div>
				</div>';
				echo $str;
			}
		}
	} elseif($_POST['do'] == 'capnhat') {
		$data['ngaysua'] = time();
		$data['value'] = chuanhoa($_POST['value']);
		$d->setTable('option');
		$d->setWhere('id',$_POST['id']);
		if ($d->update($data)) {
			echo '1';
		} else {
			echo '0';
		}
	}
}
?>

