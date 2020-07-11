<?php  if(!defined('_source')) die("Error");
$breadcrumb = '<ul class="breadcrumb">';
$breadcrumb .= '<li><a href="./" title="'._trangchu.'">'._trangchu.'</a></li>';
$breadcrumb .= '<li>'.$title_detail_frq.'</li>';
$breadcrumb .= '</ul>';
$row_detail = _fetch_array("SELECT ten_$lang,noidung_$lang,title_$lang as title,keywords_$lang as keywords,description_$lang as description FROM table_info WHERE type='".$type_bar."' ");
$title_bar .= $row_detail['title'];
$keywords_bar .= $row_detail['keywords'];
$description_bar .= $row_detail['description'];

?>