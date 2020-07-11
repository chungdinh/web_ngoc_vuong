<?php  if(!defined('_source')) die("Error");
$id =  $_GET['id'];
$idl =  addslashes($_GET['idl']);
$idc =  addslashes($_GET['idc']);
$idi =  addslashes($_GET['idi']);
$ids =  addslashes($_GET['ids']);
$breadcrumb = '<ul class="breadcrumb">';
$breadcrumb .= '<li><a href="trang-chu.html" title="'._trangchu.'">'._trangchu.'</a></li>';
$phantrang = 10;
if($id!=''){
	$row_detail = _fetch_array("SELECT * FROM table_baiviet WHERE hienthi=1 AND id='".$id."' AND type='".$type_bar."'");
	$idactive = $row_detail['id_list'];
	$add = ($com == 'dich-vu') ? ' AND id_list = '.$row_detail['id_list'].' ' : '' ;
	$share_facebook = '<meta property="og:url" content="'.getCurrentPageURL().'" />';
	$share_facebook .= '<meta property="og:type" content="website" />';
	$share_facebook .= '<meta property="og:title" content="'.$row_detail['ten_'.$lang].'" />';
	$share_facebook .= '<meta property="og:description" content="'.strip_tags($row_detail['mota_'.$lang]).'" />';
	$share_facebook .= '<meta property="og:image" content="http://'.$config_url.'/'._upload_baiviet_l.$row_detail['photo'].'" />';
	$title_bar .= $row_detail['title_'.$lang];
	$keywords_bar .= $row_detail['keywords_'.$lang];
	$description_bar .= $row_detail['description_'.$lang];
	$tintuc = _result_array("SELECT ten_$lang as ten,ngaytao,id,tenkhongdau,thumb,photo,mota_$lang as mota,file_baogia FROM table_baiviet WHERE hienthi=1 $add $and AND id !='".$row_detail['id']."' AND type='".$type_bar."' order by stt,ngaytao desc");
	$breadcrumb .= "<li><a href='".$com.".html' title='".$title_detail_frq."'>".$title_detail_frq."</a></li>";
	/*
	if($row_detail['id_list'] > 0 && !empty($row_detail['id_list'])){
		$bread_list = _fetch_array("SELECT ten_$lang,tenkhongdau,id FROM table_baiviet_list WHERE type='".$type_bar."' AND id=".$row_detail['id_list']);
		$breadcrumb .="<li><a href='".$com."/".$bread_list['tenkhongdau']."-".$bread_list['id']."' title='".str_replace('?','',$bread_list['ten_'.$lang])."'>".str_replace('?','',$bread_list['ten_'.$lang])."</a></li>";
	}
	if($row_detail['id_cat'] > 0 && $row_detail['id_cat'] != ''){
		$bread_cat = _fetch_array("SELECT ten_$lang,tenkhongdau,id FROM table_baiviet_cat WHERE type='".$type_bar."' AND id=".$row_detail['id_cat']);
		$breadcrumb .="<li><a href='".$com."/".$bread_list['tenkhongdau']."/".$bread_cat['tenkhongdau']."-".$bread_cat['id']."' title='".$bread_cat['ten_'.$lang]."'>".$bread_cat['ten_'.$lang]."</a></li>";
	}
	if($row_detail['id_item'] > 0 && $row_detail['id_item'] != ''){
		$bread_item = _fetch_array("SELECT ten_$lang,tenkhongdau,id FROM table_baiviet_item WHERE type='".$type_bar."' AND id=".$row_detail['id_item']);
		$breadcrumb .="<li><a href='".$com."/".$bread_list['tenkhongdau']."/".$bread_cat['tenkhongdau']."/".$bread_item['tenkhongdau']."-".$bread_item['id']."' title='".$bread_item['ten_'.$lang]."'>".$bread_item['ten_'.$lang]."</a></li>";
	}
	*/
	$breadcrumb .="<li>".$row_detail['ten_'.$lang.'']."</li>";
} elseif($idl!=''){
	$row_detail = _fetch_array("SELECT id,ten_$lang,tenkhongdau,photo,thumb,title_$lang as title,description_$lang as description,keywords_$lang as keywords FROM table_baiviet_list WHERE hienthi=1 $and AND type='".$type_bar."' AND id='".$idl."'");
	$idactive = $row_detail['id'];
	$breadcrumb .= '<li><a href="'.$com.'.html" title="'.$title_detail_frq.'">'.$title_detail_frq.'</a></li>';
	$breadcrumb .= '<li>'.$row_detail['ten_'.$lang.''].'</li>';
	$per_page = $phantrang;
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	$WHERE = " table_baiviet WHERE hienthi=1 AND type='".$type_bar."' AND id_list='".$row_detail['id']."' $and order by stt,ngaytao desc";
	$tintuc = _result_array("SELECT ten_$lang as ten,id,thumb,tenkhongdau,photo,ngaythicong,ngayhoanthanh,file_baogia,mota_$lang as mota,ngaytao FROM $WHERE $limit");
	$url = getCurrentPageURL();
	$paging = pagination($WHERE,$per_page,$page,$url);
	$title_detail = $row_detail['ten_'.$lang];
	$title_bar .= $row_detail['title'];
	$keywords_bar .= $row_detail['keywords'];
	$description_bar .= $row_detail['description'];
} elseif($idc!='') {
	$row_detail = _fetch_array("SELECT id,ten_$lang,tenkhongdau,id_list,photo,thumb,title_$lang as title,description_$lang as description,keywords_$lang as keywords FROM table_baiviet_cat WHERE hienthi=1 AND type='".$type_bar."' $and AND id='".$idc."'");
	$idactive = $row_detail['id_list'];
	$row_detail_list = _fetch_array("SELECT id,ten_$lang,tenkhongdau FROM table_baiviet_list WHERE hienthi=1 AND type='".$type_bar."' AND id='".$row_detail['id_list']."'");
	$per_page = $phantrang;
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	$WHERE = " table_baiviet WHERE hienthi=1 AND type='".$type_bar."' AND id_cat='".$row_detail['id']."'  order by stt,ngaytao desc";
	$tintuc = _result_array("SELECT ten_$lang as ten,ngaytao,id,tenkhongdau,thumb,photo,mota_$lang as mota,ngaythicong,ngayhoanthanh FROM $WHERE $limit");
	$url = getCurrentPageURL();
	$paging = pagination($WHERE,$per_page,$page,$url);
	$title_detail = $row_detail['ten_'.$lang];
	$title_bar .= $row_detail['title'];
	$keywords_bar .= $row_detail['keywords'];
	$description_bar .= $row_detail['description'];
	$breadcrumb .= "<li><a href='".$com.".html' title='".$title_detail_frq."'>".$title_detail_frq."</a></li>";
	$breadcrumb .= "<li><a title='".$row_detail_list['ten_'.$lang.'']."' href='".$com."/".$row_detail_list['tenkhongdau']."/".$row_detail_list['id']."'>".$row_detail_list['ten_'.$lang.'']."</a></li>";
	$breadcrumb .= "<li>".$row_detail['ten_'.$lang.'']."</li>";

} elseif($idi != ''){
	$row_detail = _fetch_array( "SELECT id,ten_$lang,tenkhongdau,id_list,id_cat,title_$lang as title,description_$lang as description,keywords_$lang as keywords FROM table_baiviet_item WHERE hienthi=1 AND type='".$type_bar."' $and AND id='".$idi."'");
	$id_p_l = $row_detail['id_list'];
	$idactive = $row_detail['id_list'];
	$per_page = $phantrang;
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;

	$WHERE = " table_baiviet WHERE hienthi=1 AND type='".$type_bar."' ".$add." AND id_item='".$row_detail['id']."'  order by stt,ngaytao desc";
	$tintuc = _result_array( "SELECT ten_$lang as ten,id,thumb,tenkhongdau,photo,ngaythicong,ngayhoanthanh,file_baogia,mota_$lang FROM $WHERE $limit");
	$row_detail_list = _fetch_array("SELECT id,ten_$lang,tenkhongdau FROM table_baiviet_list WHERE hienthi=1 AND type='".$type_bar."' AND id='".$row_detail['id_list']."'");
	$row_detail_cat = _fetch_array("SELECT id,ten_$lang,tenkhongdau FROM table_baiviet_cat WHERE hienthi=1 AND type='".$type_bar."' AND id='".$row_detail['id_cat']."'");
	$url = getCurrentPageURL();
	$paging = pagination($WHERE,$per_page,$page,$url,' ');
	$title_detail = $row_detail['ten_'.$lang];
	$title_bar .= $row_detail['title'];
	$keywords_bar .= $row_detail['keywords'];
	$description_bar .= $row_detail['description'];
	$name_list = _fetch_array("SELECT ten_$lang,tenkhongdau,id FROM table_baiviet_list WHERE id=".$id_p_l."");
	$breadcrumb .= '<li><a href="'.$com.'.html">'.$title_detail_frq.'</a></li>';
	$breadcrumb .= '<li><a href="'.$com.'/'.$name_list['tenkhongdau'].'-'.$name_list['id'].'" title="'.str_replace('?','',$name_list['ten_'.$lang.'']).'">'.str_replace('?','',$name_list['ten_'.$lang.'']).'</a></li>';
	$breadcrumb .='<li><a href="'.$com.'/'.$name_list['tenkhongdau'].'/'.$row_detail_cat['tenkhongdau'].'-'.$row_detail_cat['id'].'">'.$row_detail_cat['ten_'.$lang.''].'</a></li>';
	$breadcrumb .= '<li>'.$row_detail['ten_'.$lang.''].'</li>';
} elseif($ids != ''){
	$row_detail =_fetch_array("SELECT id,ten_$lang,tenkhongdau,id_list,id_cat,title,keywords,description FROM table_baiviet_sub WHERE hienthi=1 AND  type='".$type_bar."' $and AND id='".$ids."'");
	$idactive = $row_detail['id_list'];
	$id_p_l = $row_detail['id_list'];
	$per_page = $phantrang;
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	$WHERE = " #_baiviet WHERE hienthi=1 AND type='".$type_bar."' ".$add." AND id_item='".$row_detail['id']."'  order by stt,ngaytao desc";
	$tintuc = _result_array("SELECT ten_$lang as ten,id,thumb,tenkhongdau,photo,ngaythicong,ngayhoanthanh,file_baogia,mota_$lang FROM $WHERE $limit");
	$row_detail_list = _fetch_array("SELECT id,ten_$lang,tenkhongdau FROM table_baiviet_list WHERE hienthi=1 AND type='".$type_bar."' AND id='".$row_detail['id_list']."'");
	$row_detail_cat = _fetch_array("SELECT id,ten_$lang,tenkhongdau FROM table_baiviet_cat WHERE hienthi=1 AND type='".$type_bar."' AND id='".$row_detail['id_cat']."'");
	$url = getCurrentPageURL();
	$paging = pagination($WHERE,$per_page,$page,$url,' ');
	$title_detail = $row_detail['ten_'.$lang];
	$title_bar .= $row_detail['title'];
	$keywords_bar .= $row_detail['keywords'];
	$description_bar .= $row_detail['description'];
	$name_list = _fetch_array("SELECT ten_$lang,tenkhongdau,id FROM table_baiviet_list WHERE id=".$id_p_l."");
	$breadcrumb .= '<li><a href="'.$com.'.html">'.$title_detail_frq.'</a></li>';
	$breadcrumb .= '<li><a href="'.$com.'/'.$name_list['tenkhongdau'].'-'.$name_list['id'].'">'.$name_list['ten_'.$lang.''].'</a></li>';
	$breadcrumb .='<li><a href="'.$com.'/'.$name_list['tenkhongdau'].'/'.$row_detail_cat['tenkhongdau'].'-'.$row_detail_cat['id'].'">'.$row_detail_cat['ten_'.$lang.''].'</a></li>';
	$breadcrumb .= '<li>'.$row_detail['ten_'.$lang.''].'</li>';
} else {
	$per_page = $phantrang;
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	$WHERE = " table_baiviet WHERE hienthi=1 AND type='".$type_bar."' $and order by id desc";
	$tintuc = _result_array("SELECT ten_$lang as ten,photo,thumb,tenkhongdau,mota_$lang as mota,ngaytao,id,file_baogia FROM $WHERE $limit");
	$url = getCurrentPageURL();
	$paging = pagination($WHERE,$per_page,$page,$url);
	$breadcrumb .= '<li>'.$title_detail_frq.'</li>';
}
$breadcrumb .= '</ul>';