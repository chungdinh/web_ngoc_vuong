<?php if(!defined('_source')) die("Error");
$breadcrumb = '<ul class="breadcrumb">';
$breadcrumb .= ' <li id="home-breadcrumb"><a href="./" title="'._trangchu.'">'._trangchu.'</a></li>';
$breadcrumb .= ' <li>'._lienhe.'</li>';
$breadcrumb .= '</ul>';
$row_detail = _fetch_array("select * from #_company where type='lienhe' ");
if (isset($_GET['id'])) {
	$product_detail = _fetch_array("SELECT ten_$lang as ten,tenkhongdau,id,photo FROM table_product WHERE id='".$_GET['id']."' LIMIT 0,1");
}

 // Check if form was submitted:
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response_contact'])) {
	
    // Build POST request:
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = $secretkey;
    $recaptcha_response_contact = $_POST['recaptcha_response_contact'];
    // Make and decode POST request:
    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response_contact);
    $recaptcha = json_decode($recaptcha);
    // Take action based on the score returned:
	if ($recaptcha->score >= 0.5) {
		if(isset($_POST['contact-btn'])){
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
			<tr><th colspan="2">&nbsp;</th>	</tr>
			<tr><th colspan="2">Thư liên hệ từ website <a href="http://'.$config_url.'">www.'.$config_url.'</a></th></tr>
			<tr><th colspan="2">&nbsp;</th>	</tr>
			<tr><th>Họ tên :</th><td>'.$_POST['ten'].'</td></tr>
			<tr><th>Địa chỉ :</th><td>'.$_POST['diachi'].'</td>	</tr>
			<tr><th>Điện thoại :</th><td>'.$_POST['dienthoai'].'</td></tr>
			<tr><th>Email :</th><td>'.$_POST['email'].'</td></tr>
			<tr><th>Nội dung :</th><td>'.$_POST['noidung'].'</td></tr>';
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
	} else {
		transfer("Xin lỗi quý khách.<br>Hệ thống bị lỗi, Spam Mail.", "lien-he.html");
	}
}
?>