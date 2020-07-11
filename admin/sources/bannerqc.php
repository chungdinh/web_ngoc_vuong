<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){
	
	case "capnhat":
	get_banner();
	$template = "bannerqc/banner_add";
	break;
	case "save":
	save_banner();
	break;
	#====================================
	
	default:
	$template = "index";
}


function get_banner(){
	global $d, $item;

	$sql = "select * from #_photo where type='".$_GET['type']."'";
	$d->query($sql);
	//if($d->num_rows()==0) transfer("Dữ liệu chưa khởi tạo.", "index.php");
	$item = $d->fetch_array();
}

function save_banner(){
	global $d,$ar_lang;

	$sql = "select * from #_photo where type='".$_GET['type']."'";
	$d->query($sql);
	$item = $d->fetch_array();
	$id=$item['id'];
	foreach ($ar_lang as $key => $value) {
		if($photo = upload_image("file_".$value['slug'], 'swf|jpg|gif|png', _upload_hinhanh,images_name($_FILES['file_'.$value['slug']]['name']))){
			$data['photo_'.$value['slug']] = $photo;
			$data['thumb_'.$value['slug']] = create_thumb($data['photo_'.$value['slug']], _width_thumb, _height_thumb, _upload_hinhanh,images_name($_FILES['file_'.$value['slug']]['name']),_style_thumb);
			$d->setTable('photo');
			$d->setWhere('id', $id);
			$d->setWhere('type',$_GET['type']);
			$d->select();
			$row = $d->fetch_array();
			delete_file(_upload_hinhanh.$row['photo_'.$value['slug']]);
			delete_file(_upload_hinhanh.$row['thumb_'.$value['slug']]);
		}		
		$data['ten_'.$value['slug']] = $_POST['ten_'.$value['slug']];
	}
	$data['type']=$_GET['type'];
	$data['link'] = $_POST['link'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	if($id){ 
		$d->setTable('photo');
		$d->setWhere('id', $id);
		$d->setWhere('type',$_GET['type']);
		if($d->update($data))
			redirect("index.php?com=bannerqc&act=capnhat&type=".$_GET['type']."");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=bannerqc&act=capnhat&type=".$_GET['type']."");
	}else{
		foreach ($ar_lang as $key => $value) {
			if($photo = upload_image("file_vi", 'swf|jpg|gif|png', _upload_hinhanh,images_name($_FILES['file_'.$value['slug']]['name']))){
				$data['photo_'.$value['slug']] = $photo;
				$data['thumb_'.$value['slug']] = create_thumb($data['photo_'.$value['slug']], _width_thumb, _height_thumb, _upload_hinhanh,images_name($_FILES['file_'.$value['slug']]['name']),_style_thumb);
			}
		}
		
		$d->setTable('photo');
		if($d->insert($data))
			redirect("index.php?com=bannerqc&act=capnhat&type=".$_GET['type']."");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=bannerqc&act=capnhat&type=".$_GET['type']."");

	}
}
// -----------------------------------
?>