<?php  if(!defined('_source')) die("Error");
// Check if form was submitted:
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response_mail'])) {
	// Build POST request:
	$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
	$recaptcha_secret = $secretkey;
	$recaptcha_response_mail = $_POST['recaptcha_response_mail'];
	// Make and decode POST request:
	$recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response_mail);
	$recaptcha = json_decode($recaptcha);
	// Take action based on the score returned:
	if ($recaptcha->score >= 0.5) {
		if(isset($_POST['txt_email']) )
		{
			$photo = _upload_hinhanh_l.$logo['photo'];
			$thongbao ='Đăng Ký Nhận Tin Thành Công';
			$data_['ten'] = $_POST['txt_ten'];
			$data_['email'] = $_POST['txt_email'];
			$data_['dienthoai'] = $_POST['txt_dienthoai'];
			$data_['noidung'] = $_POST['txt_noidung'];
			$data_['diachi'] = $_POST['txt_diachi'];
			$data_['ngaytao'] = time();
			$data_['type'] = $_POST['type'];
			$d->reset();
			$d->setTable("newsletter");
			$message = '<html><body>';
			$message .= "<div style='width:98%;margin:auto;box-shadow: 0 1px 1px 0 rgba(0,0,0,0.05), 0 1px 3px 0 rgba(0,0,0,0.25);border:1px solid rgba(0,0,0,0.25)'>";
			$message .= "<div style='width:99%;background:#183444; padding:5px 5px;margin-bottom:20px;'>";
			$message .= "<img src='http://".$config_url."/".$photo."' alt='logo'> </div>";
			$message .= '<h2 style="text-align:center;">Thông Tin Đăng Ký</h2>';
			$message .= '<table rules="all" style="border-color: #ccc;border:1px solid #ccc;width:90%;margin:auto" cellpadding="10">';
			$message.="<tr style='background: #232F3E; text-align: center;text-transform: capitalize;font-size: 12pt;color: white;'><td colspan=7><div><strong>Thông Tin Khách Hàng</strong></div></td></tr>";
			if (!empty($data_['ten'])) {$message.="<tr ><td>Tên: </td><td>".strip_tags($data_['ten'])."</td></tr>";}
			if (!empty($data_['email'])) {$message.="<tr ><td>Email: </td><td>".strip_tags($data_['email'])."</td></tr>";}
			if (!empty($data_['dienthoai'])) {$message.="<tr ><td>Điện Thoại: </td><td>".strip_tags($data_['dienthoai'])."</td></tr>";}
			if (!empty($data_['noidung'])) {$message.="<tr ><td>Nội Dung: </td><td>".strip_tags($data_['noidung'])."</td></tr>";}
			if (!empty($data_['diachi'])) {$message.="<tr ><td>Địa Chỉ: </td><td>".strip_tags($data_['diachi'])."</td></tr>";}
			$message .= "</table>";
			/*----------------SEND MAIL CHO KHÁCH HÀNG  VÀ  CHỦ CỬA HÀNG--------------------*/
			$subject ='Thông Tin Từ '.$row_setting["ten_$lang"];
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
			$mail->AddAddress($data_['email'],$row_setting['ten_'.$lang]);
			/*=====================================
			* THIET LAP NOI DUNG EMAIL
			*=====================================*/
			//Thiết lập tiêu đề
			$mail->Subject    = 'Thông tin đăng ký từ web'.$row_setting["ten_$lang"];
			//Thiết lập định dạng font chữ
			$mail->CharSet = "utf-8";
			$mail->AltBody = "To view the message, please use an HTML compatible email viewer!";
			//Thiết lập nội dung chính của email
			$mail->MsgHTML($message);
			if($d->insert($data_)){
				if(!$mail->Send()) {
					transfer( "Có lỗi xảy ra!","index.html");
				} 
				transfer($thongbao."</br>".'Cảm ơn bạn đã sử dụng dịch vụ', $_SERVER['HTTP_REFERER']);
			}else{
				transfer("Đã có lỗi xảy ra !", $_SERVER['HTTP_REFERER']);
			}
		}
	} else {
		transfer("Sorry, is Spam mail !", $_SERVER['HTTP_REFERER']);
	}
}
?>