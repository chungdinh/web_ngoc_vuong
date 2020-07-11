<?php 
$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$d = new database($config['database']);

$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;

$row_setting=_fetch_array("select * from #_setting limit 0,1");
$favicon = _fetch_array("select thumb_$lang as thumb from #_photo where type='favicon'");
$arrayphone = str_replace(',.', '', $row_setting['dienthoai']);
$_SESSION['watermark'] = $row_setting['watermark'];
$_SESSION['watermark2'] = $row_setting['watermark2'];
switch($com){

	case 'gioi-thieu':
		$source = "about";
		$template = 'about';
		$type_bar = "gioithieu";
		$title_detail_frq = 'Giới thiệu';
		break;

	case 'dich-vu':
		$source = 'news';
		$template = isset($_GET['id']) ? "news_detail" : "news";
		$type_bar = 'dichvu';
		$title_detail_frq = 'Dịch vụ';
		break;

	case 'giai-phap':
		$source = 'news';
		$template = isset($_GET['id']) ? "news_detail" : "news_more";
		$type_bar = 'giaiphap';
		$title_detail_frq = 'Giải Pháp';
		break;

	case 'tin-tuc':
		$source = 'news';
		$template = isset($_GET['id']) ? "news_detail" : "news_more";
		$type_bar = 'tintuc';
		$title_detail_frq = 'Tin tức';
		break;

	case 'chinh-sach':
		$source = 'news';
		$template = isset($_GET['id']) ? "news_detail" : "news";
		$type_bar = 'chinhsach';
		$title_detail_frq = 'Chính sách';
		break;

	case 'san-pham':
		$source = 'product';
		$template = isset($_GET['id']) ? "product_detail" : "product";
		$type_bar = 'product';
		$title_detail_frq = 'Sản phẩm';
		break;

	case 'san-pham-moi':
		$source = 'product';
		$template = isset($_GET['id']) ? "product_detail" : "product";
		$type_bar = 'product';
		$title_detail_frq = 'Sản phẩm Mới';
		break;

	case 'ban-chay':
		$source = 'product';
		$template = isset($_GET['id']) ? "product_detail" : "product";
		$type_bar = 'product';
		$title_detail_frq = 'Sản phẩm bán Chạy';
		break;

	case 'du-an':
		$source = 'album';
		$template = isset($_GET['id']) ? "album_detail" : "album";
		$type_bar = 'duan';
		$title_detail_frq = 'Dự Án';
		break;

	case 'search':
		$source = "search";
		$template = 'search';
		$title_detail_frq = 'Tìm kiếm';
		break;

	case 'video':
		$source = "video";
		$template = 'video';
		$title_detail_frq = 'Video';
		break;

	case 'lien-he':
		$source = "contact";
		$template = 'contact';
		$title_detail_frq = 'Liên hệ';
		break;
		
	// case 'tags':
	// 	$template = 'tags';
	// 	$source = "tags";
	// 	$title_detail_frq = 'tags';
	// 	break;

	case 'mail':
		$source = "mail";
		break;

	// case 'gio-hang':
	// $source = "giohang";
	// $template = 'giohang';
	// $title_detail_frq = 'Giỏ hàng';
	// break;
	
	// case 'thanh-toan':
	// $source = "thanhtoan";
	// $template = 'thanhtoan';
	// $title_detail_frq = 'Thanh toán';
	// break;
	
	case 'ngonngu':
	if(isset($_GET['lang'])){
		switch($_GET['lang']){
			case 'vi':
				$_SESSION['lang'] = 'vi';
				break;

			case 'en':
				$_SESSION['lang'] = 'en';
				break;

			case 'cn':
				$_SESSION['lang'] = 'cn';
				break;	

			default: 
				$_SESSION['lang'] = 'vi';
				break;
		}
	}
	else{
		$_SESSION['lang'] = 'vi';
	}
	header('Location: '.$_SERVER['HTTP_REFERER']);
	break; 

	default:
	$template = 'index';
	break;
}
if($source!="") include _source.$source.".php";