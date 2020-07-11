<?php	if(!defined('_source')) die("Error");
print_r($act);
switch($act){
	case 'man':
	man();
	$template = 'option/item';
	break;

	case 'add':
	add();
	$template = 'option/item_add';
	break;

	case 'edit':
	edit();
	$template = 'option/item_add';
	break;

	case 'save':
	save();
	break;

	case 'delete':
	delete();
	break;

	case 'title':
	get_title();
	$template = 'option/title';
	break;

	default:
	$template = "index";
}

function get_title(){
	global $d,$lang,$ar_lang,$item;
	$item = _result_array("SELECT * FROM table_option WHERE type like '".$_GET['type']."'");
}

function delete(){
	global $d;
	$sql ="DELETE FROM table_option WHERE id IN (".$_GET['listid'].")"; 
	if($d->query($sql))	{
		redirect('index.php?com=option&act=man&type=title');
	}
}

function add(){
	global $d,$item,$paging;
}

function man(){
	global $d,$item,$paging;

	if($_REQUEST['xoa']){
		$sql = "DELETE FROM table_option WHERE id=".$_GET['xoa'];
		if($d->query($sql)){
			redirect('index.php?com=option&act=man&type=title');
		}
	}

	$per_page = 10;
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	$where = " table_option WHERE type='".$_GET['type']."'";
	$item = _result_array("SELECT ten_vi,id,hienthi,stt FROM $where");
	$sql = "SELECT ten_vi,id,hienthi,stt FROM $where";
	//dump($sql);
	$url = getCurrentPage();
	$paging = pagination($where,$per_page,$page,$url);		
}

function save(){
	global $d,$ar_lang;
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	foreach ($ar_lang as $key => $value) {
		$data['ten_'.$value['slug']] = $_POST['ten_'.$value['slug']];
		$data['noidung_'.$value['slug']] = magic_quote($_POST['noidung_'.$value['slug']]);
	}

	$data['stt'] = (int)$_POST['stt'];
	$data['value'] = $_POST['value'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	$data['type'] = $_GET['type'];
	if ($id) {
		$data['ngaysua'] = time();
		$d->setTable('option');
		$d->setWhere('id',$id);
		if($d->update($data)){
			redirect('index.php?com=option&act=man&type=title');
		}
	} else {
		$data['ngaytao'] = time();
		$data['ngaysua'] = time();
		$d->setTable('option');
		if($d->insert($data)){
			redirect('index.php?com=option&act=man&type=title');
		}
	}
}

function edit(){
	global $d,$item;
	$item = _fetch_array("SELECT * FROM table_option WHERE id=".$_GET['id']);
}