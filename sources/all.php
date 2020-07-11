<?php  if(!defined('_source')) die("Error");

$phantrangtintuc = 6;
$phantrang = 12;
$sql_product = "ten_$lang as ten,tenkhongdau,id,photo,sp_uudai,giaban,mota_$lang as mota";
$breadcrumb = '<ul class="breadcrumb">';
$breadcrumb .= '<li><a href="'.$url_web.'" title="'._trangchu.'">'._trangchu.'</a></li>';

$id = $_GET['id'];
$tintuc_all = _fetch_array("SELECT count(id) as num FROM table_baiviet WHERE tenkhongdau like '$id' AND hienthi = 1");
$tintuc_list = _fetch_array("SELECT count(id) as num FROM table_baiviet_list WHERE tenkhongdau like '$id' AND hienthi = 1");
$sanpham_all = _fetch_array("SELECT count(id) as num FROM table_product WHERE tenkhongdau like '$id' AND hienthi = 1");
$hinhanh_all = _fetch_array("SELECT count(id) as num FROM table_album WHERE tenkhongdau like '$id' AND hienthi = 1");
$hinhanh_list = _fetch_array("SELECT count(id) as num FROM table_album_list WHERE tenkhongdau like '$id' AND hienthi = 1");
if ($id == 'video') {
	$per_page = $phantrang;
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	$where = " #_video where hienthi=1 and type='video' order by id desc";
	$sql = "select ten_$lang as ten,tenkhongdau,id,ngaytao,links,luotxem from $where $limit";
	$d->query($sql);
	$video = $d->result_array();
	$url = getCurrentPageURL();
	$paging = pagination($where,$per_page,$page,$url);
	$breadcrumb .= '<li>Video</li>';
	$template = 'video';
	$active = 8;
} elseif($id == 'cong-trinh'){
		$per_page = $phantrang;
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	$WHERE = " table_baiviet WHERE hienthi=1 AND type like 'congtrinh' $and order by id desc";
	$tintuc = _result_array("SELECT ten_$lang as ten,photo,thumb,tenkhongdau,mota_$lang as mota,ngaytao,id,file_baogia FROM $WHERE $limit");
	$url = getCurrentPageURL();
	$paging = pagination($WHERE,$per_page,$page,$url);
	$breadcrumb .= '<li>'._congtrinh.'</li>';
	$active = 6;
	$template = 'news';
} elseif($id == 'bo-suu-tap'){
	$per_page = $phantrang;
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	$WHERE = " table_album WHERE hienthi=1 AND type like 'album' order by id desc";
	$album = _result_array("SELECT ten_$lang as ten,photo,thumb,tenkhongdau,id FROM $WHERE $limit");
	$url = getCurrentPageURL();
	$paging = pagination($WHERE,$per_page,$page,$url);
	$breadcrumb .= '<li>'._bosuutap.'</li>';
	$template = 'album';
	$active = 7;
} elseif ($id == 'gioi-thieu') {
	$breadcrumb .= '<li>Giới thiệu</li>';
	$row_detail = _fetch_array("SELECT ten_$lang,noidung_$lang,title_$lang as title,keywords_$lang as keywords,description_$lang as description FROM table_info WHERE type like 'gioithieu' ");
	$title_bar .= $row_detail['title'];
	$keywords_bar .= $row_detail['keywords'];
	$description_bar .= $row_detail['description'];
	$template = 'about';
	$active = 2;
} elseif($id == 'mo-da'){

	$breadcrumb .= '<li>'._moda.'</li>';
	$row_detail = _fetch_array("SELECT ten_$lang,noidung_$lang,title_$lang as title,keywords_$lang as keywords,description_$lang as description FROM table_info WHERE type like 'moda' ");
	$title_bar .= $row_detail['title'];
	$keywords_bar .= $row_detail['keywords'];
	$description_bar .= $row_detail['description'];
	$template = 'about';
	$active = 5;
} elseif($id == 'nha-may-san-xuat') {
	$breadcrumb .= '<li>'._nhamaysanxuat.'</li>';
	$row_detail = _fetch_array("SELECT ten_$lang,noidung_$lang,title_$lang as title,keywords_$lang as keywords,description_$lang as description FROM table_info WHERE type like 'nhamaysx' ");
	$title_bar .= $row_detail['title'];
	$keywords_bar .= $row_detail['keywords'];
	$description_bar .= $row_detail['description'];
	$template = 'about';
	$active = 4;

} elseif($id == 'san-pham'){

	$per_page = $phantrang;
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	$WHERE = " #_product WHERE hienthi=1 ".$add." AND type like 'product' ";
	$WHERE .= " order by stt asc ";
	$product = _result_array("SELECT $sql_product FROM $WHERE $limit");
	$url = getCurrentPageURL();
	$paging = pagination($WHERE,$per_page,$page,$url,' ');
	$breadcrumb .= '<li>'._sanpham.'</li>';
	$template = 'product';
	$active = 3;

} elseif($id == 'tin-tuc'){
	$per_page = $phantrangtintuc;
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	$WHERE = " table_baiviet WHERE hienthi=1 AND type like 'tintuc' $and order by id desc";
	$tintuc = _result_array("SELECT ten_$lang as ten,photo,thumb,tenkhongdau,mota_$lang as mota,ngaytao,id,file_baogia FROM $WHERE $limit");
	$url = getCurrentPageURL();
	$paging = pagination($WHERE,$per_page,$page,$url);
	$breadcrumb .= '<li>'._tintuc.'</li>';
	$template = 'news';
	$active = 9;
} elseif($id == 'lien-he'){
	$active = 10;
	$breadcrumb .= ' <li>'._lienhe.'</li>';
	$row_detail = _fetch_array("select noidung_$lang,title_$lang as title,keywords_$lang as keywords,description_$lang as description from #_company where type like 'lienhe' ");
	if(isset($_POST['btn-send']) && $_SESSION['token'] == $_POST['token'] && $_POST['captcha'] == $_SESSION['security_code']){
		include_once "phpMailer/class.phpmailer.php";
		$mail = new PHPMailer();
		$mail->IsSMTP(); // Gọi đến class xử lý SMTP
		$mail->Host       = $config_ip; // tên SMTP server
		$mail->SMTPAuth   = true;                  // Sử dụng đăng nhập vào account
		$mail->Username   = $config_email; // SMTP account username
		$mail->Password   = $config_pass;  

		//Thiet lap thong tin nguoi gui va email nguoi gui
		$mail->SetFrom($config_email,$row_setting['ten_'.$lang]);
		
		$mail->AddAddress($row_setting['email'],$row_setting['ten_'.$lang]);
		$mail->AddAddress($_POST['email'],$row_setting['ten_'.$lang]);
		
		/*=====================================
		 * THIET LAP NOI DUNG EMAIL
		*=====================================*/

		//Thiết lập tiêu đề
		$mail->Subject    = '['.$_POST['ten'].']';
		$mail->IsHTML(true);
		//Thiết lập định dạng font chữ
		$mail->CharSet = "utf-8";	
		$body = '<table>';
		$body .= '
		<tr> 
		<th colspan="2">&nbsp;</th>
		</tr>

		<tr>
		<th colspan="2">Thư liên hệ từ website <a href="http://'.$config_url.'">www.'.$config_url.'</a></th>
		</tr>

		<tr>
		<th colspan="2">&nbsp;</th>
		</tr>

		<tr>
		<th>Họ tên :</th><td>'.$_POST['ten'].'</td>
		</tr>

		<tr>
		<th>Địa chỉ :</th><td>'.$_POST['diachi'].'</td>
		</tr>

		<tr>
		<th>Điện thoại :</th><td>'.$_POST['dienthoai'].'</td>
		</tr>

		<tr>
		<th>Email :</th><td>'.$_POST['email'].'</td>
		</tr>
		
		<tr>
		<th>Tiêu đề :</th><td>'.$_POST['tieude'].'</td>
		</tr>
		<tr>
		<th>Nội dung :</th><td>'.$_POST['noidung'].'</td>
		</tr>';
		$body .= '</table>';

		$data1['ten'] = $_POST['ten'];
		$data1['diachi'] = $_POST['diachi'];
		$data1['dienthoai'] = $_POST['dienthoai'];
		$data1['email'] = $_POST['email'];
		$data1['tieude'] = $_POST['tieude'];
		$data1['noidung'] = $_POST['noidung'];
		$data1['stt'] = $_POST['stt'];
		$data1['type'] = $_POST['type'];
		$data1['nhucau'] = $_POST['nhucau'];
		$data1['khuvuc'] = $_POST['khuvuc'];
		$data1['ngansach'] = $_POST['ngansach'];
		$data1['ngaytao'] = time();
		$d->setTable('contact');
		$d->insert($data1);
		$mail->Body = $body;
		if($mail->Send())
		{	
			transfer("Thông tin liên hệ được gửi.<br>Cảm ơn.", "trang-chu.html");
		} else {
			transfer("Xin lỗi quý khách.<br>Hệ thống bị lỗi, xin quý khách thử lại.", "lien-he.html");
		}
	}
	$template = 'contact';
} elseif($tintuc_all['num'] > 0){
	$row_detail = _fetch_array("SELECT * FROM table_baiviet WHERE hienthi=1 AND tenkhongdau like '".$id."'");
	switch ($row_detail['type']) {
		case 'tintuc':
		$com = 'tin-tuc';
		$name = _tintuc;
		$active = 9;
		break;
		case 'congtrinh':
		$com = 'cong-trinh';
		$active = 6;
		$name = _congtrinh;
		break;
		default:
		$com = 'tin-tuc';
		$name = _tintuc;
		break;
	}

	$share_facebook = '<meta property="og:url" content="'.getCurrentPageURL().'" />';
	$share_facebook .= '<meta property="og:type" content="website" />';
	$share_facebook .= '<meta property="og:title" content="'.$row_detail['ten_'.$lang].'" />';
	$share_facebook .= '<meta property="og:description" content="'.strip_tags($row_detail['mota_'.$lang]).'" />';
	$share_facebook .= '<meta property="og:image" content="http://'.$config_url.'/'._upload_baiviet_l.$row_detail['photo'].'" />';
	$title_bar .= $row_detail['title_'.$lang];
	$keywords_bar .= $row_detail['keywords_'.$lang];
	$description_bar .= $row_detail['description_'.$lang];
	$tintuc = _result_array("SELECT ten_$lang,ngaytao,id,tenkhongdau,thumb,photo,mota_$lang as mota,file_baogia FROM table_baiviet WHERE hienthi=1 AND id !='".$row_detail['id']."' and type like '".$row_detail['type']."' order by stt,ngaytao desc");
	if ($row_detail['type'] != 'icon') {
		$breadcrumb .= "<li><a href='".$com.".html' title='".$name."'>".$name."</a></li>";	
	}
	$breadcrumb .="<li>".$row_detail['ten_'.$lang.'']."</li>";
	$template = 'news_detail';
	
} elseif($hinhanh_all['num'] > 0){
	$row_detail = _fetch_array("SELECT * FROM table_album WHERE hienthi=1 and tenkhongdau  like '".$id."'");
	$title_detail = $row_detail['ten_'.$lang];
	$title_bar .= $row_detail['title_'.$lang];
	$keywords_bar .= $row_detail['keywords_'.$lang];
	$description_bar .= $row_detail['description_'.$lang];

	$share_facebook = '<meta property="og:url" content="'.getCurrentPageURL().'" />';
	$share_facebook .= '<meta property="og:type" content="website" />';
	$share_facebook .= '<meta property="og:title" content="'.$row_detail['ten_'.$lang].'" />';
	$share_facebook .= '<meta property="og:description" content="'.strip_tags($row_detail['mota_'.$lang]).'" />';
	$share_facebook .= '<meta property="og:image" content="'.$url_web.'/'._upload_album_l.$row_detail['photo'].'" />';
	#các tin cu hon
	$sql_khac = "SELECT * FROM table_album_photo WHERE hienthi=1 and id_album ='".$row_detail['id']."' order by id desc";
	$d->query($sql_khac);
	$album_images = $d->result_array();
	$album = _result_array("SELECT ten_$lang as ten,tenkhongdau,id,photo FROM table_album WHERE type like 'album' AND hienthi = 1 AND id != '".$row_detail['id']."' ORDER BY stt ASC");
	$breadcrumb .= "<li><a href='bo-suu-tap.html' title='"._bosuutap	."'>"._bosuutap	."</a></li>";
	$breadcrumb .="<li>".$row_detail['ten_'.$lang.'']."</li>";
	$template = 'album_detail';
	$active = 7;
} elseif($hinhanh_list['num'] > 0){

	$row_detail = _fetch_array("SELECT * FROM table_album_list WHERE tenkhongdau like '".$id."'");

	$d->reset();
	$sql_tintuc = "SELECT ten_$lang as ten,thumb,photo,id,tenkhongdau,title_$lang as title,keywords_$lang as keywords,description_$lang from table_album where hienthi=1 AND id_list=".$row_detail['id']." order by id desc";
	$d->query($sql_tintuc);
	$album = $d->result_array();
	$breadcrumb .='<li><a href="bo-suu-tap.html" title="'._bosuutap.'">'._bosuutap.'</a></li>';
	$breadcrumb .="<li>".$row_detail['ten_'.$lang]."</li>";
	$title_bar .= $row_detail['title_'.$lang];
	$keywords_bar .= $row_detail['keywords_'.$lang];
	$description_bar .= $row_detail['description_'.$lang];
	$template = 'album';
	$active = 7;
} elseif($sanpham_all['num'] > 0){
	$row_detail = _fetch_array("SELECT * FROM table_product WHERE hienthi=1 AND tenkhongdau like '".$id."'");
	$id_active = $row_detail['id_list'];
	$share_facebook = '<meta property="og:url" content="'.getCurrentPageURL().'" />';
	$share_facebook .= '<meta property="og:type" content="website" />';
	$share_facebook .= '<meta property="og:title" content="'.$row_detail['ten_'.$lang].'" />';
	$share_facebook .= '<meta property="og:description" content="'.strip_tags($row_detail['mota_'.$lang]).'" />';
	$share_facebook .= '<meta property="og:image" content="'.$url_web.'/'._upload_product_l.$row_detail['photo'].'" />';
	$hinhanh = _result_array("SELECT * FROM table_product_photo WHERE hienthi=1 AND id_product='".$row_detail['id']."' AND type='".$type_bar."' order by stt,id desc");
	$d->reset();
	$d->query("UPDATE table_product SET luotxem = luotxem + 1 WHERE id='".$row_detail['id']."'");
	$product = _result_array("SELECT $sql_product FROM table_product WHERE hienthi=1 AND id_list='".$row_detail['id_list']."' AND type like 'product' AND id!='".$row_detail['id']."' order by stt,id desc LIMIT 0,10");
	$title_bar .= $row_detail['title_'.$lang];
	$keywords_bar .= $row_detail['keywords_'.$lang];
	$description_bar .= $row_detail['description_'.$lang];
	$breadcrumb .= "<li><a href='san-pham.html' title='"._sanpham."'>"._sanpham."</a></li>";
	if($row_detail['id_list'] > 0 && $row_detail['id_list'] != ''){
		$bread_list = _fetch_array("SELECT ten_$lang,tenkhongdau,id FROM table_product_list WHERE type like 'product' AND id=".$row_detail['id_list']);
		$breadcrumb .="<li><a href='".$bread_list['tenkhongdau'].".html' title='".str_replace('?','',$bread_list['ten_'.$lang])."'>".str_replace('?','',$bread_list['ten_'.$lang])."</a></li>";
	}
	if($row_detail['id_cat'] > 0 && $row_detail['id_cat'] != ''){
		$bread_cat = _fetch_array("SELECT ten_$lang,tenkhongdau,id FROM table_product_cat WHERE type like 'product' AND id=".$row_detail['id_cat']);
		$breadcrumb .="<li><a href='".$bread_cat['tenkhongdau'].".html' title='".$bread_cat['ten_'.$lang]."'>".$bread_cat['ten_'.$lang]."</a></li>";
	}
	if($row_detail['id_item'] > 0 && $row_detail['id_item'] != ''){
		$bread_item = _fetch_array("SELECT ten_$lang,tenkhongdau,id FROM table_product_item WHERE type like 'product' AND id=".$row_detail['id_item']);
		$breadcrumb .="<li><a href='".$bread_item['tenkhongdau'].".html' title='".$bread_item['ten_'.$lang]."'>".$bread_item['ten_'.$lang]."</a></li>";
	}
	$breadcrumb .="<li>".$row_detail['ten_'.$lang.'']."</li>";
	$template = 'product_detail';
	$active = 3;
} elseif($id == 'tim-kiem'){
	$keywords=trim($_GET['keywords']);
	$per_page = $phantrang;
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	$where = " table_product where hienthi=1 and (type='product') and (ten_$lang like '%".$keywords."%' OR tenkhongdau like '%".$keywords."%') $str AND hienthi = 1 ORDER BY id DESC";
	$product = _result_array("SELECT ten_$lang as ten,tenkhongdau,id,photo,giaban,giacu,sp_uudai,sp_khuyenmai,ngaytao,mota_$lang as mota FROM $where $limit");
	$url = getCurrentPageURL();
	$title_bar = _timkiem;
	$paging = pagination($where,$per_page,$page,$url);
	$breadcrumb .= '<li>'._timkiem.'</li>';
	$template = 'search';
	$active = 11;
} elseif($tintuc_list['num'] > 0){
	$row_detail = _fetch_array("SELECT id,ten_$lang,tenkhongdau,photo,thumb,title_$lang as title,description_$lang as description,keywords_$lang as keywords,type FROM table_baiviet_list WHERE hienthi=1 $and AND tenkhongdau like '".$id."'");
	$breadcrumb .= '<li><a href="cong-trinh.html" title="'._congtrinh.'">'._congtrinh.'</a></li>';
	$breadcrumb .= '<li>'.$row_detail['ten_'.$lang.''].'</li>';
	$per_page = $phantrangtintuc;
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	$WHERE = " table_baiviet WHERE hienthi=1 AND id_list='".$row_detail['id']."' AND type like 'congtrinh' $and order by stt,ngaytao desc";
	$tintuc = _result_array("SELECT ten_$lang as ten,id,thumb,mota_$lang,tenkhongdau,photo,ngaythicong,ngayhoanthanh,file_baogia,mota_$lang as mota,ngaytao FROM $WHERE $limit");
	$url = getCurrentPageURL();
	$paging = pagination($WHERE,$per_page,$page,$url);
	$title_detail = $row_detail['ten_'.$lang];
	$title_bar .= $row_detail['title'];
	$keywords_bar .= $row_detail['keywords'];
	$description_bar .= $row_detail['description'];
	$template = 'news';
	$active = 6;
}
$breadcrumb .= '</ul>';
