<?php  if(!defined('_source')) die("Error");

$id =  addslashes($_GET['id']);
$breadcrumb = '<ul class="breadcrumb">';
$breadcrumb .= '<li><a href="trang-chu.html" title="'._trangchu.'">'._trangchu.'</a></li>';
if($id!=''){

	$sql_lanxem = "UPDATE table_video SET luotxem=luotxem+1  WHERE tenkhongdau ='".$id."'";
	$d->query($sql_lanxem);

	$sql = "select * from #_video where hienthi=1 and tenkhongdau='".$id."'";
	$d->query($sql);
	$row_detail = $d->fetch_array();

	$title_detail = "Video";
	$title_bar .= $row_detail['title'];
	$keyword_bar .= $row_detail['keywords'];
	$description_bar .= $row_detail['description'];
	$sql_khac = "select ten_$lang,ngaytao,id,tenkhongdau,links,luotxem from #_video where hienthi=1 and tenkhongdau !='".$id."' and type='video' order by stt,ngaytao desc limit 0,10";
	$d->query($sql_khac);
	$video = $d->result_array();

} else {
	$per_page = 12;
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;

	$where = " #_video where hienthi=1 and type='video' order by id desc";

	$sql = "select ten_$lang,tenkhongdau,id,ngaytao,links,luotxem from $where $limit";
	$d->query($sql);
	$video = $d->result_array();

	$url = getCurrentPageURL();
	$paging = pagination($where,$per_page,$page,$url);
	$breadcrumb .= '<li>'.$title_detail_frq.'</li>';

}
$breadcrumb .= '</ul>';