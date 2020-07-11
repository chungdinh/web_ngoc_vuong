<?php  if(!defined('_source')) die("Error");
$id =  addslashes($_GET['id']);
$idl =  addslashes($_GET['idl']);
$phantrang = 8;
$breadcrumb = '<ul class="breadcrumb">';
$breadcrumb .= '<li><a href="./" title="'._trangchu.'">'._trangchu.'</a></li>';
if ($id!='') {
	$row_detail = _fetch_array("select * from #_album where hienthi=1 and id='".$id."'");
	$title_detail = $row_detail['ten_'.$lang];
	$title_bar .= $row_detail['title_'.$lang];
	$keywords_bar .= $row_detail['keywords_'.$lang];
	$description_bar .= $row_detail['description_'.$lang];

	$share_facebook = '<meta property="og:url" content="'.getCurrentPageURL().'" />';
	$share_facebook .= '<meta property="og:type" content="website" />';
	$share_facebook .= '<meta property="og:title" content="'.$row_detail['ten_'.$lang].'" />';
	$share_facebook .= '<meta property="og:description" content="'.strip_tags($row_detail['mota_'.$lang]).'" />';
	$share_facebook .= '<meta property="og:image" content="http://'.$config_url.'/'._upload_album_l.$row_detail['photo'].'" />';
	#các tin cu hon
	$sql_khac = "select * from #_album_photo where hienthi=1 and id_album ='".$row_detail['id']."' order by id desc";
	$d->query($sql_khac);
	$album_images = $d->result_array();
	$album = _result_array("SELECT ten_$lang as ten,tenkhongdau,id,photo FROM table_album WHERE type like 'album' AND hienthi = 1 AND id != '".$row_detail['id']."' ORDER BY stt ASC");
	$breadcrumb .= "<li><a href='".$com.".html' title='".$title_detail_frq."'>".$title_detail_frq."</a></li>";
	$breadcrumb .="<li>".$row_detail['ten_'.$lang.'']."</li>";
} elseif($idl != ''){
	$d->reset();
	$sql="SELECT * FROM table_album_list WHERE id = ".$idl;
	$d->query($sql);
	$row_detail = $d->fetch_array();

	$d->reset();
	$sql_tintuc = "SELECT ten_$lang as ten,thumb,photo,id,tenkhongdau,title_$lang as title,keywords_$lang as keywords,description_$lang from table_album where hienthi=1 AND id_list=".$row_detail['id']." order by id desc";
	$d->query($sql_tintuc);
	$album = $d->result_array();
	$breadcrumb .='<li><a href="'.$com.'.html" title="'.$title_detail_frq.'">'.$title_detail_frq.'</a></li>';
	$breadcrumb .="<li>".$row_detail['ten_'.$lang]."</li>";
	$title_bar .= $row_detail['title_'.$lang];
	$keywords_bar .= $row_detail['keywords_'.$lang];
	$description_bar .= $row_detail['description_'.$lang];

} else {
	$per_page = $phantrang;
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	$WHERE = " table_album WHERE hienthi=1 AND type='".$type_bar."' order by id desc";
	$album = _result_array("SELECT ten_$lang as ten,photo,thumb,tenkhongdau,id FROM $WHERE $limit");
	$url = getCurrentPageURL();
	$paging = pagination($WHERE,$per_page,$page,$url);
	$breadcrumb .= '<li>'.$title_detail_frq.'</li>';
}
$breadcrumb .= '</ul>';
?>