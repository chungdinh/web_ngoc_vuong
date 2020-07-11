<?php
session_start();
@define ( '_lib' , '../libraries/');
@define ( '_source' , '../sources/');
if(!isset($_SESSION['lang']))
{
	$_SESSION['lang']='vi';
}
$lang=$_SESSION['lang'];
include_once _lib."config.php";
include_once _lib."constant.php";
include_once _lib."functions.php";
include_once _lib."class.database.php";
include_once _source."lang_$lang.php";
$d = new database($config['database']);
$id = $_GET['id'];
$idl = $_GET['idl'];
$check=' and id_list='.$id.' and noibat>0';
$d->reset();
$sql = "select ten_$lang as ten,tenkhongdau,id,photo,giacu,dientich,diachi from #_product where hienthi=1 and type='product' and noibat = 1 $check order by stt asc limit 0,8";
$d->query($sql);
$sanpham_show_in = $d->result_array();
?>
<div class="tab-box flexbox">
    <?php if (count($sanpham_show_in)>0){
			foreach ($sanpham_show_in as $key => $value) { echo product($value,'sanpham-col','san-pham','200x200/1'); }
		}else echo '<p class="notice"> Nội dung đang cập nhật</p>';  ?>
</div>