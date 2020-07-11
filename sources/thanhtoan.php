<?php  if(!defined('_source')) die("Error");		
	// thanh tieu de
	$title_bar= _thanhtoan;
	if(!empty($_POST)){
		$hoten=$_POST['ten'];
		$dienthoai=$_POST['dienthoai'];
		$diachi=$_POST['diachi'];
		$email=$_POST['email'];
		$noidung=$_POST['noidung'];
		
		
		//validate dữ liệu
		
		
		
		$hoten = trim(strip_tags($hoten));
		$dienthoai = trim(strip_tags($dienthoai));	
		$diachi = trim(strip_tags($diachi));	
		$email = trim(strip_tags($email));	
		$noidung = trim(strip_tags($noidung));	
		
		
		if (get_magic_quotes_gpc()==false) {
			$hoten = mysql_real_escape_string($hoten);
			$dienthoai = mysql_real_escape_string($dienthoai);
			$diachi = mysql_real_escape_string($diachi);
			$email = mysql_real_escape_string($email);
			$noidung = mysql_real_escape_string($noidung);						
			
		}
		$coloi=false;		
		if ($hoten == NULL) { 
			$coloi=true; $error_hoten = "Bạn chưa nhập họ tên<br>";
		} 
		if ($dienthoai == NULL) { 
			$coloi=true; $error_dienthoai = "Bạn chưa nhập điện thoại<br>";
		}
		if ($diachi == NULL) { 
			$coloi=true; $error_diachi = "Bạn chưa nhập địa chỉ<br>";
		}	
		
		if ($email == NULL) { 
			$coloi=true; $error_email = "Bạn chưa nhập email<br>";
			}elseif (filter_var($email,FILTER_VALIDATE_EMAIL)==FALSE) { 
			$coloi=true; $error_email="Bạn nhập email không đúng<br>";
		}
		
		
		if ($coloi==FALSE) {
			
			$body='<table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; background-color:#E1E1E1; padding:5px;" width="100%">';
			if(is_array($_SESSION['cart']))
			{
            	$body.='<tr bgcolor="#075992">
				<td align="center" style="font-weight:bold;color:#FFF">STT</td>
				<td style="font-weight:bold;color:#FFF">Tên</td>
				<td style="font-weight:bold;color:#FFF">Hình ảnh</td>
				<td align="center" style="font-weight:bold;color:#FFF">Giá</td>
				<td align="center" style="font-weight:bold;color:#FFF">Số lượng</td>
				<td align="center" style="font-weight:bold;color:#FFF">Tổng giá</td></tr>';
				$max=count($_SESSION['cart']);
				for($i=0;$i<$max;$i++){
					$pid=$_SESSION['cart'][$i]['productid'];
					$q=$_SESSION['cart'][$i]['qty'];
					
					$pname=get_product_name($pid,'vi');
					$pimg=get_product_img($pid);
					$d->reset();
					$sql_news = "select id,ten_vi from #_product where hienthi=1 and id='".$pid."' and type='product'";
					$d->query($sql_news);
					$pro_gh = $d->fetch_array();
					// dump($pro_gh);
					$mau=$_SESSION['cart'][$i]['mau'];
					$size=$_SESSION['cart'][$i]['size'];
					if($q==0) continue;
					
            		$body.='<tr bgcolor="#FFFFFF"><td width="10%" align="center">'.($i+1).'</td>';
            		$body.='<td width="29%">'.$pname;				
					$body.='</td>';
					$body.='<td width="25%"><img src="http://'.$config_url.'/'._upload_product_l.$pimg;				
					$body.='" width="150"/></td>';
					//$body.='<td class="image">'.$size;	
					//$body.='<td class="image">'.$mau;	
					$body.='<td width="20%">'.number_format(get_price2($pid),0, ',', '.').'&nbsp;đ</td>';
                    $body.='<td width="14%" align="center">'.$q.'</td>';                 
				    //$body.='<td width="14%" align="center">'.$q.'</td>'; 
					
					$body.='<td>'.number_format((get_price($pid)*$q),0, ',', '.') .'&nbsp;đ</td>';
					
					$body.='</tr>
					<br/>';
				}
				$body.='<tr><td colspan="5">
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
				<td style="text-align:left;"> '; 
				$body.=' <strong>Tổng giá bán: '. number_format(get_order_total(),0, ',', '.') .' &nbsp;đ</strong></td>
				<td colspan="5" align="right">&nbsp;</td>
				</tr>
				</table>   
				</td></tr>';
			}
			
			else{
				$body.='<tr bgColor="#FFFFFF"><td>There are no items in your shopping cart!</td>';
			}
			$body.='</table><br />';
			// print_r($body);
			//die();
			
			$mahoadon=strtoupper (ChuoiNgauNhien(6));
			$ngaydangky=time();
			$tonggia=get_order_total();
			
			$body1='<b>Mã đơn hàng:</b> <strong>'.$mahoadon.'</strong><br />		    
			<b>Họ tên: </b><strong>'.$hoten.'</strong><br />		  
			<b>Điện thoại: </b><strong>'.$dienthoai.'</strong><br />		  
			<b>Email: </b><strong>'.$email.'</strong><br />		  
			<b>Địa chỉ: </b><strong>'.$diachi.'</strong><br />
			<b>Ghi chú: </b><strong>'.$noidung.'</strong><br />
			';
			$data_send=$body.$body1;		 
			//dump($data_send);
			//die();
			// lấy địa chỉ IP

			$ip_address=getRealIPAddress();
			$id_thanhvien=$_SESSION['login_member']['id'];
			
			
			
			$sql_order = "INSERT INTO  table_order (madonhang,hoten,dienthoai,diachi,email,tonggia,noidung,ngaytao,trangthai,ip_address,id_thanhvien ) 
			VALUES ('$mahoadon','$hoten','$dienthoai','$diachi','$email','$tonggia','$noidung','$ngaydangky','1','$ip_address','$id_thanhvien')";
			
			// Thêm đơn hàng vào Database
			mysql_query($sql_order) or die(mysql_error());
			$id_order_inserted = mysql_insert_id(); //lấy id của đơn hàng vừa lưu thành công
			
			for($i=0;$i<$max;$i++){
				$pid=$_SESSION['cart'][$i]['productid'];
				$q=$_SESSION['cart'][$i]['qty'];
				
				$pname=get_product_name($pid,'vi');
				$pimg=get_product_img($pid);
				$price_item=get_price2($pid);
				$price_item_tong=get_price2($pid)*$q;
				
				$sql_order_detail = "INSERT INTO  table_order_detail (id_order,id_product,gia,soluong,tonggia) 
				VALUES ('$id_order_inserted','$pid','$price_item','$q','$price_item_tong')"; 
				mysql_query($sql_order_detail) or die(mysql_error());
				//dump($sql_order_detail);
				
			}
			
			/*----------------SEND MAIL CHO KHÁCH HÀNG  VÀ  CHỦ CỬA HÀNG--------------------*/
			$subject = "Thông tin đơn hàng từ ".$row_setting["ten_$lang"];
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
			$mail->Subject    = "Thông tin đặt hàng từ website ".$row_setting["ten_$lang"];
			
			//Thiết lập định dạng font chữ
			$mail->CharSet = "utf-8";
			
			$mail->AltBody = "To view the message, please use an HTML compatible email viewer!";
			
			//Thiết lập nội dung chính của email
			$mail->MsgHTML($data_send);
			
			if(!$mail->Send()) {
				transfer( "Có lỗi xảy ra!","index.html");
				} else {
				unset($_SESSION['cart']); 
				transfer("Gửi đơn hàng thành công!<br/>", "index.html");	
			}	
			
			
			$iduser = mysql_insert_id();
			if($httt==2){
				require_once("nganluong.php");
				//Tài khoản nhận tiền
				$receiver="ntanh1203@gmail.com";
				//Khai báo url trả về 
				$return_url="http://localhost/tich-hop-nang-cao/complete.php";
				//Giá của cả giỏ hàng 
				$price=$tonggia;
				//Mã giỏ hàng 
				$order_code=$mahoadon;
				//Thông tin giao dịch
				$transaction_info="Hãy lập trình thông tin giao dịch của bạn vào đây";
				//Khai báo đối tượng của lớp NL_Checkout
				$nl= new NL_Checkout();
				//Tạo link thanh toán đến nganluong.vn
				$url= $nl->buildCheckoutUrl($return_url, $receiver, $transaction_info,  $order_code, $price);
				redirect($url);	
				}else{
				unset($_SESSION['cart']);
				transfer("Đơn hàng của bạn đã được gửi", "trang-chu.html");
				
			}
			
		}
		
	}
?>