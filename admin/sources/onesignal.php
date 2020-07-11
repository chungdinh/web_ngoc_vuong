<?php	if(!defined('_source')) die("Error");
$p = (int)(!isset($_GET["p"]) ? 1 : $_GET["p"]);
if ($p <= 0) $p = 1;
$template = "onesignal/onesignal";
switch ($act) {
	case 'save':
	save_onesignal();
	break;

	case 'push':
	push();
	break;

	default:
	get_onesignal();
	break;

}

function fns_Rand_digit($min,$max,$num) {
	$result='';
	for($i=0;$i<$num;$i++){
		$result.=rand($min,$max);
	}
	return $result;	
}

function get_onesignal(){
	global $d,$config,$items,$item,$paging,$p;
	$per_page = 10;
	$startpoint = ($p * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	$where = 'table_onesignal';
	$where .=" order by id desc";
	$d->reset();
	$d->query("SELECT * FROM $where $limit");
	$items = $d->result_array();
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";

	if ($id) {
		$d->reset();
		$d->query("SELECT * FROM table_onesignal WHERE id=".$id);
		$item = $d->fetch_array();
	}

	if(isset($_GET['delete'])){
		$d->setTable('onesignal');
		$d->setWhere('id', $_GET['delete']);
		$d->select();
		if($d->num_rows()>0){
			$row = $d->fetch_array();
			delete_file(_upload_hinhanh.$row['photo']);	
			if($d->query("DELETE FROM table_onesignal WHERE id= ".$_GET['delete'])){
				transfer("Cập nhật dữ liệu thành công",'index.php?com=onesignal');
			}
		}	
	}
	$url = getCurrentPageURL();
	$paging = pagination($where,$per_page,$p,$url);
}

function save_onesignal(){
	global $d,$config;
	$file_name=$_FILES['file']['name'];
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if ($id) {
		if($photo = upload_image("file", _format_duoihinh, _upload_hinhanh,$file_name)){
			$data['photo'] = $photo;		
			$d->setTable('onesignal');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_hinhanh.$row['photo']);	
			}		
		}		
		$data['ten'] = $_POST['heading'];
		$data['noidung'] = $_POST['content'];
		$data['link'] = $_POST['url'];
		$data['ngaytao'] = $_POST['seticronjob'];
		$d->setTable('onesignal');
		$d->setWhere('id', $id);
		if($d->update($data)){
			transfer("Cập nhật dữ liệu thành công",'index.php?com=onesignal');
		}
	} else {
		if($photo = upload_image("file", _format_duoihinh, _upload_hinhanh,$file_name)){
			$data['photo'] = $photo;		
		}
		$data['ten'] = $_POST['heading'];
		$data['noidung'] = $_POST['content'];
		$data['link'] = $_POST['url'];
		$data['ngaytao'] = $_POST['seticronjob'];
		$d->setTable('onesignal');
		if($d->insert($data)){
			transfer("Cập nhật dữ liệu thành công",'index.php?com=onesignal');
		}
	}
}

function sendMessage($heading,$content,$url='',$img){
	global $config_url; 
	$url_web = 'https://'.$config_url;
	$contents = array(
		"en" => $content
	);
	$headings = array(
		"en" => $heading
	);

	$fields = array(
		'app_id' => "ba3f65b3-28c4-4dea-a953-8419e03d708c", //thay đổi OneSignal App ID
		'included_segments' => array('All'),
		'contents' => $contents,
		'headings' => $headings,
		'url' => $url,
	);
	if (!empty($img)) {
		$fields['chrome_web_icon'] = $url_web.'/upload/hinhanh/'.$img;
		$fields['firefox_icon'] = $url_web.'/upload/hinhanh/'.$img;
		
	}
	//dump($fields);
	$fields = json_encode($fields);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
		'Authorization: Basic OTgwOTNhNGItOTc3Yy00YTA4LTgwZmMtYjNhNzJkNmFjOTFk'));// thay đổi REST API Key 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_POST, TRUE);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

	$response = curl_exec($ch);
	curl_close($ch);

	return $response;
}

function push(){
	global $d,$config;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if ($id) {
		$d->reset();
		$d->query("SELECT * FROM table_onesignal WHERE id=".$id);
		$item = $d->fetch_array();		
		sendMessage($item['ten'],$item['noidung'],$item['link'],$item['photo']);
		transfer('Tin nhắn đã được gửi','index.php?com=onesignal');		
	}
}