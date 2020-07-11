<?php  if(!defined('_source')) die("Error");
@$idc =  addslashes($_GET['idc']);
@$idl =  addslashes($_GET['idl']);
@$idi =  addslashes($_GET['idi']);
@$ids =  addslashes($_GET['ids']);
@$id  =  addslashes($_GET['id']);
$breadcrumb = '<ul class="breadcrumb">';
$breadcrumb .= '<li id="home-breadcrumb"><a href="./" title="'._trangchu.'">'._trangchu.'</a></li>';
$phantrang = 12;
$sql_product = "ten_$lang as ten,tenkhongdau,id,photo,sp_banchay,sp_moi,giaban,giacu,mota_$lang as mota";
if($id!=''){
	$row_detail = _fetch_array("SELECT * FROM table_product WHERE hienthi=1 AND type='".$type_bar."' AND id ='".$id."'");
	if($row_detail['size'] != ''){
		$size = _result_array("SELECT id,ten_$lang as ten,tenkhongdau FROM table_size WHERE FIND_IN_SET(id,'{$row_detail['size']}') AND type like '{$type_bar}'");
	}
	if($row_detail['mausac'] != ''){
		$mausac = _result_array("SELECT id,ten_$lang as ten,tenkhongdau FROM table_mausac WHERE FIND_IN_SET(id,'{$row_detail['mausac']}') AND type like '{$type_bar}'");
	}
	if($row_detail['tags'] != ''){
		$tags = _result_array("SELECT id,ten_$lang as ten,tenkhongdau FROM table_tags WHERE FIND_IN_SET(id,'{$row_detail['tags']}') AND type like '{$type_bar}'");
	}
	$id_active = $row_detail['id_list'];
	$share_facebook = '<meta property="og:url" content="'.getCurrentPageURL().'" />';
	$share_facebook .= '<meta property="og:type" content="website" />';
	$share_facebook .= '<meta property="og:title" content="'.$row_detail['ten_'.$lang].'" />';
	$share_facebook .= '<meta property="og:description" content="'.strip_tags($row_detail['mota_'.$lang]).'" />';
	$share_facebook .= '<meta property="og:image" content="'.$url_web.'/'._upload_product_l.$row_detail['photo'].'" />';
	$hinhanh = _result_array("SELECT * FROM table_product_photo WHERE hienthi=1 AND id_product='".$row_detail['id']."' AND type='".$type_bar."' order by stt,id desc");
	$d->reset();
	$d->query("UPDATE table_product SET luotxem = luotxem + 1 WHERE id=".$id);
	$product = _result_array("SELECT $sql_product FROM table_product WHERE hienthi=1 AND id_list='".$row_detail['id_list']."' AND type='".$type_bar."' AND type='product' AND id!='".$row_detail['id']."' order by stt,id desc LIMIT 0,10");
	$title_bar .= $row_detail['title_'.$lang];
	$keywords_bar .= $row_detail['keywords_'.$lang];
	$description_bar .= $row_detail['description_'.$lang];
	$breadcrumb .= "<li><a href='".$com.".html' title='".$title_detail_frq."'>".$title_detail_frq."</a></li>";
	if($row_detail['id_list'] > 0 && $row_detail['id_list'] != ''){
		$bread_list = _fetch_array("SELECT ten_$lang,tenkhongdau,id FROM table_product_list WHERE type='".$type_bar."' AND id=".$row_detail['id_list']);
		$breadcrumb .="<li><a href='".$com."/".$bread_list['tenkhongdau']."-".$bread_list['id']."' title='".str_replace('?','',$bread_list['ten_'.$lang])."'>".str_replace('?','',$bread_list['ten_'.$lang])."</a></li>";
	}
	if($row_detail['id_cat'] > 0 && $row_detail['id_cat'] != ''){
		$bread_cat = _fetch_array("SELECT ten_$lang,tenkhongdau,id FROM table_product_cat WHERE type='".$type_bar."' AND id=".$row_detail['id_cat']);
		$breadcrumb .="<li><a href='".$com."/".$bread_list['tenkhongdau']."/".$bread_cat['tenkhongdau']."-".$bread_cat['id']."' title='".$bread_cat['ten_'.$lang]."'>".$bread_cat['ten_'.$lang]."</a></li>";
	}
	if($row_detail['id_item'] > 0 && $row_detail['id_item'] != ''){
		$bread_item = _fetch_array("SELECT ten_$lang,tenkhongdau,id FROM table_product_item WHERE type='".$type_bar."' AND id=".$row_detail['id_item']);
		$breadcrumb .="<li><a href='".$com."/".$bread_list['tenkhongdau']."/".$bread_cat['tenkhongdau']."/".$bread_item['tenkhongdau']."-".$bread_item['id']."' title='".$bread_item['ten_'.$lang]."'>".$bread_item['ten_'.$lang]."</a></li>";
	}
	$breadcrumb .="<li>".$row_detail['ten_'.$lang.'']."</li>";
} elseif($idl!=''){
	$row_detail = _fetch_array("SELECT id,id as id_list,ten_$lang,tenkhongdau,title_$lang as title,keywords_$lang as keywords,description_$lang as description,quangcao FROM table_product_list WHERE hienthi=1 AND type='".$type_bar."' AND id='".$idl."'");
	$photo_breadcrumb = _upload_product_l.$row_detail['quangcao'];
	$id_active = $row_detail['id'];
	$per_page = $phantrang;
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	// dump($_GET['com']);
	if($_GET['com']=='san-pham-moi')
	{
		$check_dk="and sp_moi=1";
	}
	elseif($_GET['com']=='ban-chay')
	{
		$check_dk="and sp_banchay=1";
	}
	$WHERE = " table_product WHERE hienthi=1 AND type='".$type_bar."' ".$add." AND id_list='".$row_detail['id']."' $check_dk order by stt asc ";
	
	$product = _result_array("SELECT $sql_product FROM $WHERE $limit");
	$url = getCurrentPageURL();
	$paging = pagination($WHERE,$per_page,$page,$url,' ');
	$title_detail = $row_detail['ten_'.$lang];
	$title_bar .= $row_detail['title'];
	$keywords_bar .= $row_detail['keywords'];
	$description_bar .= $row_detail['description'];
	$name_list = $row_detail['tenkhongdau'];
	$breadcrumb .= '<li><a href="'.$com.'.html" title="'.$title_detail_frq.'">'.$title_detail_frq.'</a></li>';
	$breadcrumb .= '<li>'.str_replace('?','',$row_detail['ten_'.$lang.'']).'</li>';
} elseif($idc!=''){
	$row_detail = _fetch_array("SELECT id,ten_$lang,tenkhongdau,id_list,title_$lang as title,keywords_$lang as keywords,description_$lang as description,photo FROM table_product_cat WHERE hienthi=1 AND type='".$type_bar."' AND id='".$idc."'");
	$photo_breadcrumb = _upload_product_l.$row_detail['photo'];
	$per_page = $phantrang;
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	$WHERE = " table_product WHERE hienthi=1 AND type='".$type_bar."' ".$add." AND id_cat='".$row_detail['id']."'  order by stt,ngaytao desc";;
	$product = _result_array( "SELECT $sql_product FROM $WHERE $limit");
	$url = getCurrentPageURL();
	$paging = pagination($WHERE,$per_page,$page,$url,' ');
	$title_detail = $row_detail['ten_'.$lang];
	$title_bar .= $row_detail['title'];
	$keywords_bar .= $row_detail['keywords'];
	$description_bar .= $row_detail['description'];
	$id_p_l = $row_detail['id_list'];
	$name_list = _fetch_array("SELECT ten_$lang,tenkhongdau,id FROM table_product_list WHERE id=".$id_p_l."");
	$id_active = $name_list['id'];
	$breadcrumb .= '<li><a href="'.$com.'.html">'.$title_detail_frq.'</a></li>';
	$breadcrumb .= '<li><a href="'.$com.'/'.$name_list['tenkhongdau'].'-'.$name_list['id'].'" title="'.str_replace('?','',$name_list['ten_'.$lang.'']).'">'.str_replace('?','',$name_list['ten_'.$lang.'']).'</a></li>';
	$breadcrumb .= '<li>'.$row_detail['ten_'.$lang.''].'</li>';
} elseif($idi!=''){
	$row_detail = _fetch_array( "SELECT id,ten_$lang,tenkhongdau,id_list,id_cat,title_$lang as title,keywords_$lang as keywords,description_$lang as description,photo FROM table_product_item WHERE hienthi=1 AND type='".$type_bar."' AND id='".$idi."'");
	$photo_breadcrumb = _upload_product_l.$row_detail['photo'];
	$id_p_l = $row_detail['id_list'];
	$per_page = $phantrang;
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;

	$WHERE = " table_product WHERE hienthi=1 AND type='".$type_bar."' ".$add." AND id_item='".$row_detail['id']."'  order by stt,ngaytao desc";
	$product = _result_array( "SELECT $sql_product FROM $WHERE $limit");
	$row_detail_list = _fetch_array("SELECT id,ten_$lang,tenkhongdau FROM table_product_list WHERE hienthi=1 AND type='".$type_bar."' AND id='".$row_detail['id_list']."'");
	$row_detail_cat = _fetch_array("SELECT id,ten_$lang,tenkhongdau FROM table_product_cat WHERE hienthi=1 AND type='".$type_bar."' AND id='".$row_detail['id_cat']."'");
	$url = getCurrentPageURL();
	$paging = pagination($WHERE,$per_page,$page,$url,' ');
	$title_detail = $row_detail['ten_'.$lang];
	$title_bar .= $row_detail['title'];
	$keywords_bar .= $row_detail['keywords'];
	$description_bar .= $row_detail['description'];
	$name_list = _fetch_array("SELECT ten_$lang,tenkhongdau,id FROM table_product_list WHERE id=".$id_p_l."");
	$breadcrumb .= '<li><a href="'.$com.'.html">'.$title_detail_frq.'</a></li>';
	$breadcrumb .= '<li><a href="'.$com.'/'.$name_list['tenkhongdau'].'-'.$name_list['id'].'" title="'.str_replace('?','',$name_list['ten_'.$lang.'']).'">'.str_replace('?','',$name_list['ten_'.$lang.'']).'</a></li>';
	$breadcrumb .='<li><a href="'.$com.'/'.$name_list['tenkhongdau'].'/'.$row_detail_cat['tenkhongdau'].'-'.$row_detail_cat['id'].'">'.$row_detail_cat['ten_'.$lang.''].'</a></li>';
	$breadcrumb .= '<li>'.$row_detail['ten_'.$lang.''].'</li>';
}  elseif($ids!=''){
	$row_detail =_fetch_array("SELECT id,ten_$lang,tenkhongdau,id_list,id_cat,title_$lang as title,keywords_$lang as keywords,description_$lang as description FROM table_product_sub WHERE hienthi=1 AND type='".$type_bar."' AND id='".$ids."'");
	$id_p_l = $row_detail['id_list'];
	$per_page = $phantrang;
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	$WHERE = " #_product WHERE hienthi=1 AND type='".$type_bar."' ".$add." AND id_item='".$row_detail['id']."'  order by stt,ngaytao desc";
	$product = _result_array("SELECT $sql_product FROM $WHERE $limit");
	$row_detail_list = _fetch_array("SELECT id,ten_$lang,tenkhongdau,dientich,diachi FROM table_product_list WHERE hienthi=1 AND type='".$type_bar."' AND id='".$row_detail['id_list']."'");
	$row_detail_cat = _fetch_array("SELECT id,ten_$lang,tenkhongdau FROM table_product_cat WHERE hienthi=1 AND type='".$type_bar."' AND id='".$row_detail['id_cat']."'");
	$url = getCurrentPageURL();
	$paging = pagination($WHERE,$per_page,$page,$url,' ');
	$title_detail = $row_detail['ten_'.$lang];
	$title_bar .= $row_detail['title'];
	$keywords_bar .= $row_detail['keywords'];
	$description_bar .= $row_detail['description'];
	$name_list = _fetch_array("SELECT ten_$lang,tenkhongdau,id FROM table_product_list WHERE id=".$id_p_l."");
	$breadcrumb .= '<li><a href="'.$com.'.html">'.$title_detail_frq.'</a></li>';
	$breadcrumb .= '<li><a href="'.$com.'/'.$name_list['tenkhongdau'].'-'.$name_list['id'].'">'.$name_list['ten_'.$lang.''].'</a></li>';
	$breadcrumb .='<li><a href="'.$com.'/'.$name_list['tenkhongdau'].'/'.$row_detail_cat['tenkhongdau'].'-'.$row_detail_cat['id'].'">'.$row_detail_cat['ten_'.$lang.''].'</a></li>';
	$breadcrumb .= '<li>'.$row_detail['ten_'.$lang.''].'</li>';
} else {
	$per_page = $phantrang;
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	$WHERE = " #_product WHERE hienthi=1 ".$add." AND type='".$type_bar."' $check_dk ";
	$WHERE .= " order by stt asc ";
	$product = _result_array("SELECT $sql_product FROM $WHERE $limit");
	$url = getCurrentPageURL();
	$paging = pagination($WHERE,$per_page,$page,$url,' ');
	$breadcrumb .= '<li>'.$title_detail_frq.'</li>';
	$type = 'bgproducttrangtrong';
	$photo_b = _fetch_array("SELECT photo FROM table_bgweb WHERE type='$type' LIMIT 0,1");
	$photo_breadcrumb = _upload_hinhanh_l.$photo_b['photo'];
}
$breadcrumb .= '</ul>';