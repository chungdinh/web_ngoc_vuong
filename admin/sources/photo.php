<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){
	case "man_photo":
	get_photos();
	$template = "photo/photos";
	break;
	case "add_photo":	
	$template = "photo/photo_add";
	break;
	case "edit_photo":
	get_photo();
	$template = "photo/photo_edit";
	break;
	case "save_photo":
	save_photo();
	break;
	case "delete_photo":
	delete_photo();
	break;			
	default:
	$template = "index";
}

function get_photos(){
	global $d, $items, $paging,$page;
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['iddel'];
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_photo SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);			
		}
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_photo SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){
				
				$sql = "select id,photo_vi as photo from #_photo where id= ".$id_array[$i]."";
				$d->query($sql);
				if($d->num_rows()>0){
					while($row = $d->fetch_array()){
						delete_file(_upload_hinhanh.$row['photo']);
					}
				}
				$sql = "delete from table_photo where id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");			

			}
			redirect("index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);			
		}				
	}

	#----------------------------------------------------------------------------------------
	
	if($_REQUEST['hienthi']!='')
	{
		$id_up = $_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_photo where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
			$sqlUPDATE_ORDER = "UPDATE table_photo SET hienthi =1 WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
			$sqlUPDATE_ORDER = "UPDATE table_photo SET hienthi =0  WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}	
	}

	#-------------------------------------------------------------------------------			
	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = 'ORDER BY id asc limit '.$startpoint.','.$per_page;
	$where = " #_photo where ";
	if($_REQUEST['type']!='')
	{
		$where.="  type='".$_REQUEST['type']."'";
	}
	if($_REQUEST['id_linhvuc']!='')
	{
		$where.=" and id_linhvuc = ".$_GET['id_linhvuc'];
	}
	$sql = "select * from $where $limit";		
	$d->query($sql);
	$items = $d->result_array();	
	$url = getCurrentPageURL();
	$paging = pagination($where,$per_page,$page,$url);		
}

function get_photo(){
	global $d, $item, $list_cat;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
	$d->setTable('photo');
	$d->setWhere('id', $id);
	$d->select();
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
	$item = $d->fetch_array();	
}

function save_photo(){
	global $d,$ar_lang;
	$file_name=fns_Rand_digit(0,9,15);
	$file_name_layer=fns_Rand_digit(0,9,15);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	$data['id_linhvuc'] = $_POST['id_linhvuc'];
	$data['stt'] = $_POST['stt'];
	$data['mota'] = $_POST['mota'];
	$data['link'] = $_POST['link'];	
	$data['mapx'] = $_POST['mapx'];	
	foreach ($ar_lang as $key => $value) {
		$data['ten_'.$value['slug']] = $_POST['ten_'.$value['slug']];
	}	
	$data['type'] = $_POST['type'];	
	$data['hienthi'] = isset($_POST['active']) ? 1 : 0;
	if($id){
		if($photo = upload_image("file_vi", 'Jpg|jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh,$file_name)){
			$data['photo_vi'] = $photo;
			$data['thumb_vi'] = create_thumb($data['photo_vi'], _width_thumb, _height_thumb , _upload_hinhanh,$file_name,_style_thumb);	
			$d->setTable('photo');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_hinhanh.$row['photo_vi']);
				delete_file(_upload_hinhanh.$row['thumb_vi']);
			}
		}		
		$d->reset();
		$d->setTable('photo');
		$d->setWhere('id', $id);
		if(!$d->update($data)) {
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
		} else {
			redirect("index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
		}	
	}else{ 		
		if($photo = upload_image("file_vi", 'Jpg|jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh,$file_name)){
			$data['photo_vi'] = $photo;
			$data['thumb_vi'] = create_thumb($data['photo_vi'], _width_thumb, _height_thumb , _upload_hinhanh,$file_name,_style_thumb);	
		}		
		$data['ngaytao'] = time();
		$d->reset();
		$d->setTable('photo');		
		if($d->insert($data)){
			if($photo_layer = upload_image("file_layer", 'Jpg|jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh,$file_name_layer)){
				$data1['photo_vi'] = $photo_layer;
				$d->setTable('photo');
				$d->setWhere('type','layer');
				$d->select('photo_vi');
				if($d->num_rows()>0){
					$row = $d->fetch_array();
					delete_file(_upload_hinhanh.$row['photo_vi']);
				}
				$d->update($data1);
			}
			redirect("index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
		} else {
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);	
		} 
		
	}
}

function delete_photo(){
	global $d;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->setTable('photo');
		$d->setWhere('id', $id);
		$d->select();
		if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
		$row = $d->fetch_array();
		delete_file(_upload_hinhanh.$row['photo_vi']);
		delete_file(_upload_hinhanh.$row['thumb_vi']);
		if($d->delete())
			redirect("index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
	}else transfer("Không nhận được dữ liệu", "index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
}
?>