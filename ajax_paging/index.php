<?php
session_start();
error_reporting(0);

@define ( '_template' , '../templates/');
@define ( '_source' , '../sources/');
@define ( '_lib' , '../libraries/');

if(!isset($_SESSION['lang']))
{
	$_SESSION['lang']='vi';
}
$lang='vi';

include_once _lib."config.php";
include_once _lib."constant.php";
include_once _lib."functions.php";
include_once _lib."class.database.php";
include_once _source."lang_$lang.php";
include_once _lib."functions_giohang.php";
include_once _lib."file_requick.php";
include_once "class_paging_ajax.php";
$d = new database($config['database']);

if(isset($_POST["page"]))
{
	if($_POST["id_list"]!=0){
		$where="and id_list='".$_POST["id_list"]."'";
	}
	if($_POST["id_cat"]!=0){
		$where.="and id_cat='".$_POST["id_cat"]."'";
	}
	if($_POST["loai"]!=''){
		$where.="and ".$_POST["loai"]."=1";
	}

	$str_van = "select ten_$lang as ten,tenkhongdau,mota_ngan,masp,id,photo,giacu,sp_uudai,sp_khuyenmai from table_product where  type='product' and hienthi=1 $where order by stt asc,id desc";

	$paging = new paging_ajax();
	
	$paging->class_pagination = "pagination";
	$paging->class_active = "active";
	$paging->class_inactive = "inactive";
	$paging->class_go_button = "go_button";
	$paging->class_text_total = "total";
	$paging->class_txt_goto = "txt_go_button";
	$paging->per_page = 8; 	
	$paging->page = $_POST["page"];
	$paging->text_sql = $str_van;
	$d->reset();
	$sql = $str_van;
	$d->query($sql);
	$tintuc_moi = $d->result_array();
	$count = count($tintuc_moi);
	$result_pag_data = $paging->GetResult();
	$message = '';
	$paging->data = "" . $message . "";
}
?>
<?php
$i=0;
while ($value = mysql_fetch_array($result_pag_data)){ 
	echo product($value,'sanpham-col','san-pham',$thumb_product);  
	$i++; } 
	if($count>8){ 
		echo $paging->Load(); 		
	} ?>