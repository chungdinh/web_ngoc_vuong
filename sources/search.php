<?php  if(!defined('_source')) die("Error");
$breadcrumb = '<ul class="breadcrumb">';
$breadcrumb .= '<li id="home-breadcrumb"><a href="./" title="'._trangchu.'">'._trangchu.'</a></li>';
$breadcrumb .= '<li>'.$title_detail_frq.'</li>';
$breadcrumb .= '</ul>';
$title_detail = _timkiem;
$keywords=trim($_GET['keywords']);

if (isset($_GET['list']) & $_GET['list'] != 0) {
	$str = ' AND id_list="'.trim($_GET['list']).'"';
}
$per_page = 12;
$startpoint = ($page * $per_page) - $per_page;
$limit = ' limit '.$startpoint.','.$per_page;
$where = " table_product where hienthi=1 and (type='product') and (ten_$lang like '%".$keywords."%' OR tenkhongdau like '%".$keywords."%') $str AND hienthi = 1 ORDER BY id DESC";
$product = _result_array("SELECT ten_$lang as ten,tenkhongdau,id,photo,giaban,giacu,sp_uudai,sp_khuyenmai,ngaytao,mota_$lang as mota FROM $where $limit");
$url = getCurrentPageURL();
$title_bar = 'Tìm kiếm';
$paging = pagination($where,$per_page,$page,$url);