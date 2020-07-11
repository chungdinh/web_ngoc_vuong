<?php
$type = (isset($_REQUEST['type'])) ? addslashes($_REQUEST['type']) : "";	
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$act = explode('_',$act);
if(count($act>1)){
	$act = $act[1];
} else {
	$act = $act[0];
}
$config_member = false;
switch($type){

	// setting
	case 'setting':
	$config_ten 			= true;
	$config_slogan 			= false;		$config_text_slogan = "Slogan";
	$config_diachi 			= true;
	$config_email 			= true;
	$config_hotline 		= true;
	$config_dienthoai 		= true;		$config_text_dienthoai 	= "Điện Thoại/Zalo: ";
	$config_timeopen 		= false;		$config_text_timeopen 	= "Mở Cửa";
	$config_timeclose 		= false;		$config_text_timeclose 	= "Đóng Cửa";
	$config_web 			= true;
	$config_fanpage 		= true;
	$config_map 			= true;
	$config_toado 			= false;
	$config_copyright 		= true;
	$config_bcthuong 		= false;
	$config_watermark_small = false;
	$config_watermark_big 	= false;
	// ---------------------------//
	@define ( _width_thumb , 200 );
	@define ( _height_thumb , 200 );
	@define ( _style_thumb , 1 );
	@define ( _width_thumb_2 , 40 );
	@define ( _height_thumb_2 , 40 );
	@define ( _style_thumb_2 , 1 );
	@define ( _width_thumb_bct , 100 );
	@define ( _height_thumb_bct , 50 );
	@define ( _style_thumb_bct , 1 );
	@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
	$ratio_ = 1;
	break;

	case 'email':
	$title_main 		= "Email"; 		
	$config_ten 		= false; 	$config_text_ten 		= "Tên"; //ten
	$config_dienthoai 	= false; 	$config_text_dienthoai 	= "Điện Thoại"; //dienthoai
	$config_email 		= true; 	$config_text_email 		= "Email"; //email
	$config_noidung 	= false; 	$config_text_noidung 	= "Nội Dung"; //noidung
	$config_diachi		= false;	$config_text_diachi 	= "Địa Chỉ"; //diachi
	$config_bonus 		= false;	$config_text_bonus 		= "bonus"; //bonus
	break;	

	case 'support':
	$title_main 		= "Hỗ Trợ"; 		
	$config_ten 		= true; 	$config_text_ten 		= "Tên";
	$config_dienthoai 	= true; 	$config_text_dienthoai 	= "Điện Thoại";
	$config_email 		= true; 	$config_text_email 		= "Email";
	$config_skype 		= true; 	$config_text_skype 		= "Skype";
	$config_yahoo		= true;	$config_text_yahoo		= "Yahoo";
	$config_viber		= false;	$config_text_viber		= "Viber";
	break;	

	case 'popup':
	$links_ 		= "true";
	$title_main 	= 'Popup';	
	$config_linhvuc = false;
	@define ( _width_thumb , 600 );
	@define ( _height_thumb , 450 );
	@define ( _style_thumb , 1 );
	@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
	$ratio_ = 1;
	break;
	
	// option
	case 'title':
	$title_main 	= 'Title';
	$config_title 	= false;
	$config_ten 	= true;
	$config_noidung = false;
	$config_setting = true;
	break;

	// bannerqc
	case 'favicon':
	$title_main 	= 'Favicon';
	$config_link 	= false;
	$config_hienthi = false;
	@define ( _width_thumb , 40 );
	@define ( _height_thumb , 40 );
	@define ( _style_thumb , 1 );
	@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
	$ratio_ = 1;
	break;

	// bannerqc
	case 'logo':
	$title_main 	= 'Logo';
	$config_link 	= false;
	$config_hienthi = true;
	@define ( _width_thumb , 255 );
	@define ( _height_thumb , 80 );
	@define ( _style_thumb , 1 );
	@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
	$ratio_ = 1;
	break;

	case 'banner':
	$title_main 	= 'Banner';
	$config_link 	= false;
	$config_hienthi = true;
	@define ( _width_thumb , 692 );
	@define ( _height_thumb , 83 );
	@define ( _style_thumb , 1 );
	@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
	$ratio_ = 1;
	break;

	//photo
	case 'slider':
	$title_main 	= 'Slider';	
	$config_linhvuc	= false;
	$config_ten 	= true;
	$config_images 	= true;
	$config_link 	= true;
	$config_mota 	= false;
	@define ( _width_thumb , 1366 );
	@define ( _height_thumb , 465 );
	@define ( _style_thumb , 1 );
	@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
	$ratio_ = 1;
	break;

	//info
	case 'gioithieu':
	$title_main 			= "Giới Thiệu";
	$config_images 			= false; 		
	$config_mul 			= false;
	$config_ten 			= true;
	$config_mota 			= false;
	$config_mota_ckeditor 	= false;
	$config_noidung 		= true;
	$config_links 			= false;
	@define ( _width_thumb , 255 );
	@define ( _height_thumb , 215 );
	@define ( _style_thumb , 1 );
	$ratio_ = 1;
	@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
	break;

	//info
	case 'lienhe':
	$title_main 			= "Liên Hệ";
	$config_images 			= false; 		
	$config_mul 			= false;
	$config_ten 			= false;
	$config_mota 			= false;
	$config_mota_ckeditor 	= false;
	$config_noidung 		= true;
	$config_links 			= false;
	@define ( _width_thumb , 255 );
	@define ( _height_thumb , 215 );
	@define ( _style_thumb , 1 );
	$ratio_ = 1;
	@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
	break;

	//info
	case 'footer':
	$title_main 			= "Footer";
	$config_images 			= false; 		
	$config_mul 			= false;
	$config_ten 			= false;
	$config_mota 			= false;
	$config_mota_ckeditor 	= false;
	$config_noidung 		= true;
	$config_links 			= false;
	@define ( _width_thumb , 255 );
	@define ( _height_thumb , 215 );
	@define ( _style_thumb , 1 );
	$ratio_ = 1;
	@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
	break;

	// baiviet
	case 'tintuc':
	$title_main 			= "Tin Tức";
	$config_linhvuc 		= false;
	$config_files 			= false;
	$config_icon 			= false;
	$config_color 			= false;
	$config_mul 			= false;
	$config_ten 			= true;
	$config_mota 			= true;
	$config_mota_ckeditor 	= false;
	$config_noidung 		= true;
	// =======================//
	$config_images 			= true; 	$config_text_images 	= 'Hình ảnh';
	$config_noibat 			= true;		$config_text_noibat 	= 'Nổi Bật';
	$config_banchay 		= false; 	$config_text_banchay 	= 'Bán Chạy';
	$config_footer 			= false; 	$config_text_footer 	= 'Footer';
	@define ( _width_thumb , 350 );
	@define ( _height_thumb , 250 );
	@define ( _style_thumb , 1 );
	@define ( _width_thumb_icon , 255 );
	@define ( _height_thumb_icon , 215 );
	@define ( _style_thumb_icon , 1 );
	$ratio_ = 1;
	@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
	break;

	// baiviet
	case 'dichvu':
	$title_main 			= "Dịch Vụ";
	$config_linhvuc 		= false;
	$config_files 			= false;
	$config_icon 			= false;
	$config_color 			= false;
	$config_mul 			= false;
	$config_ten 			= true;
	$config_mota 			= true;
	$config_mota_ckeditor 	= false;
	$config_noidung 		= true;
	// =======================//
	$config_images 			= true; 	$config_text_images 	= 'Hình ảnh';
	$config_noibat 			= true;		$config_text_noibat 	= 'Nổi Bật';
	$config_banchay 		= false; 	$config_text_banchay 	= 'Bán Chạy';
	$config_footer 			= false; 	$config_text_footer 	= 'Footer';
	@define ( _width_thumb , 250 );
	@define ( _height_thumb , 250 );
	@define ( _style_thumb , 1 );
	@define ( _width_thumb_icon , 255 );
	@define ( _height_thumb_icon , 215 );
	@define ( _style_thumb_icon , 1 );
	$ratio_ = 1;
	@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
	break;

	// baiviet
	case 'chinhsach':
	$title_main 			= "Chính Sách";
	$config_linhvuc 		= false;
	$config_files 			= false;
	$config_icon 			= false;
	$config_color 			= false;
	$config_mul 			= false;
	$config_ten 			= true;
	$config_mota 			= false;
	$config_mota_ckeditor 	= false;
	$config_noidung 		= true;
	// =======================//
	$config_images 			= false; 	$config_text_images 	= 'Hình ảnh';
	$config_noibat 			= false;		$config_text_noibat 	= 'Nổi Bật';
	$config_banchay 		= false; 	$config_text_banchay 	= 'Bán Chạy';
	$config_footer 			= false; 	$config_text_footer 	= 'Footer';
	@define ( _width_thumb , 255 );
	@define ( _height_thumb , 215 );
	@define ( _style_thumb , 1 );
	@define ( _width_thumb_icon , 255 );
	@define ( _height_thumb_icon , 215 );
	@define ( _style_thumb_icon , 1 );
	$ratio_ = 1;
	@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
	break;

	// product
	case 'product':
	switch($act){
		case 'list':
		$title_main 		= "Danh mục cấp 1";	
		$config_quangcao 	= false;
		$config_link		= false;
		$config_mota 		= false;
		$config_title 		= false;
		$config_ten 		= true;
		//========================//
		$config_images 		= false; 	$config_text_images 	= "Hình ảnh";
		$config_color 		= false;	$config_text_color 		= "Màu Sắc";
		$config_noibat 		= true; 	$config_text_noibat 	= "Nổi Bật";		
		$config_special 	= false; 	$config_text_special 	= "Đặc Biệt";	
		@define ( _width_thumb , 300 );
		@define ( _height_thumb , 238 );
		@define ( _style_thumb , 1 );
		@define ( _width_thumb_qc , 1200 );
		@define ( _height_thumb_qc , 210 );
		@define ( _style_thumb_qc , 1 );
		$ratio_ = 1;
		break;

		case 'cat':
		$title_main 	= "Danh mục cấp 2";
		$config_ten 	= true;
		$config_mota 	= false;
		//================== //
		$config_images 	= false; 	$config_text_images = "Hình ảnh";
		$config_noibat 	= true; 	$config_text_noibat = "Nổi Bật";
		@define ( _width_thumb , 450 );
		@define ( _height_thumb , 245 );
		@define ( _style_thumb , 1 );
		$ratio_ = 1;
		break;

		case 'item':
		$title_main 	= "Danh mục cấp 3";
		$config_ten 	= true;
		//===================//
		$config_images 	= false; $config_text_images = "Hình ảnh";
		@define ( _width_thumb , 300 );
		@define ( _height_thumb , 245 );
		@define ( _style_thumb , 1 );
		$ratio_ = 1;
		break;

		case 'sub':
		$title_main 	= "Danh mục cấp 4";
		$config_ten 	= true;
		//===================//
		$config_images 	= true; $config_text_images = "Hình ảnh";
		@define ( _width_thumb , 400 );
		@define ( _height_thumb , 300 );
		@define ( _style_thumb , 1 );
		$ratio_ = 1;
		break;

		default:
		$title_main 			= "Sản phẩm";
		$config_list 			= true; // danh muc cap 1
		$config_cat 			= true; // danh muc cap 2
		$config_item 			= true; // danh muc cap 3
		$config_sub 			= false; // danh muc cap 4
		$config_nhasanxuat 		= false;
		$config_bds 			= false;
		$config_mul 			= true;
		$config_motangan 		= false;
		$config_tags 			= true;
		$config_masp 			= false; // Mã sảnphẩm
		$config_diachi			= false;	$config_text_diachi 	= 'Địa Chỉ';
		$config_chudautu		= false;	$config_text_chudautu	= 'Chủ Đầu Tư: ';
		$config_tiendo			= false;	$config_text_tiendo 	= 'Tiến Độ: ';
		$config_dientich		= false;	$config_text_dientich 	= 'Diện Tích: ';
		$config_giacu 			= true;
		$config_giaban 			= true;
		$config_size 			= false;
		$config_mausac 			= false;
		$config_ten 			= true;
		$config_mota 			= true;
		$config_mota_ckeditor 	= false;
		$config_noidung 		= true;
		$config_thongso 		= false;
		// ================== //
		$config_images 			= true; 	$config_text_images = 'Hình ảnh';
		$config_sale 			= false; 	$config_text_sale 	= 'Sale'; 			//sp_uudai
		$config_km 				= false; 	$config_text_km 	= 'SP khuyến mãi';	//sp_khuyenmai
		$config_new				= true; 	$config_text_new 	= 'SP Mới';			// sp_moi
		$config_bc 				= true; 	$config_text_bc 	= 'SP Bán Chạy'; 	// sp_banchay
		$config_noibat 			= true;		$config_text_noibat = 'Nổi Bật';
		@define ( _width_thumb , 255 );
		@define ( _height_thumb , 215 );
		@define ( _style_thumb , 1 );
		$ratio_ = 2;
		break;
	}
	@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
	break;

	// baiviet
	case 'giaiphap':
	switch($act){
		case 'list':
		$title_main 			= "Danh mục";
		$config_linhvuc 		= false;
		$config_ten 			= true;
		$config_title 			= false;
		$config_mota 			= false;
		$config_mota_ckeditor 	= false;
		// =============//
		$config_images			= false; 	
		$config_text_images		= "Hình";
		$config_noibat 			= true; 	
		$config_text_noibat 	="Nổi Bật"; 
		$config_footer 			= false; 	
		$config_text_footer 	= "Footer";
		@define ( _width_thumb , 1366 );
		@define ( _height_thumb , 238 );
		@define ( _style_thumb , 2 );
		$ratio_ = 1;
		break;

		case 'cat':
		$title_main 			= "Danh mục cấp 2";
		$config_linhvuc 		= false;
		$config_images 			= false;
		$config_ten 			= true;
		$config_mota 			= false;
		$config_mota_ckeditor 	= false;
		// ================== //
		$config_noibat 			= false; 
		$config_text_noibat = "Nổi Bật";
		@define ( _width_thumb , 1200 );
		@define ( _height_thumb , 245 );
		@define ( _style_thumb , 1 );
		$ratio_ = 1;
		break;

		case 'item':
		$title_main 	= "Danh mục cấp 3";
		$config_linhvuc = false;
		break;

		case 'sub':
		$title_main = "Danh mục cấp 4";
		break;

		default:
		$title_main 			= "Giải Pháp";
		$config_linhvuc 		= false;
		$config_list 			= true;	//danh muc cap 1
		$config_cat 			= true;	//danh muc cap 2
		$config_item 			= false;	//danh muc cap 3
		$config_sub 			= false;	//danh muc cap 4
		$config_files 			= false;
		$config_icon 			= false;
		$config_color 			= false;
		$config_mul 			= false;
		$config_ten 			= true;
		$config_mota 			= true;
		$config_mota_ckeditor 	= false;
		$config_noidung 		= true;
		// ================//
		$config_images 			= true; 	
		$config_text_images 	= 'Hình';
		$config_noibat 			= false;		
		$config_text_noibat 	= 'Nổi Bật';
		$config_banchay 		= false; 	
		$config_text_banchay 	= 'Bán Chạy';
		$config_footer 			= false; 	
		$config_text_footer 	= 'Footer';
		@define ( _width_thumb , 380 );
		@define ( _height_thumb , 250 );
		@define ( _style_thumb , 1 );
		$ratio_ = 1;
		break;
	}
	@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
	break;


	// album
	case 'duan':
	switch($act){
		case 'list':
		$title_main 	= "Danh mục";
		$config_files 	= false;
		$config_mota 	= false;
		$config_mul 	= false;
		$config_noidung = false;
		$config_en 		= false;
		$config_ten 	= true;
		$config_images 	= true; $config_text_images = "Hình";
		// ================= //
		$config_noibat 	= false; $config_text_noibat = "Nổi Bật";
		@define ( _width_thumb , 275 );
		@define ( _height_thumb , 300 );
		@define ( _style_thumb , 1 );
		@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
		$ratio_ = 1;
		break;

		default:
		$title_main 	= "Album";
		$config_list 	= false;	//danh muc cap 1
		$config_files 	= false;
		$config_ten 	= true;
		$config_mota 	= false;
		$config_mul 	= true;
		$config_noidung = false;
		$config_en 		= false;
		// ================ //	
		$config_images 	= true; 	$config_text_images = "Hình ảnh";
		$config_noibat 	= true; 	$config_text_noibat = "Nổi Bật";
		@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
		@define ( _width_thumb , 275);
		@define ( _height_thumb , 300 );
		@define ( _style_thumb , 2 );
		$ratio_ = 1;
		break;
	}
	@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
	break;

	//photo
	case 'doitac':
	$title_main 	= 'Đối tác';	
	$config_linhvuc	= false;
	$config_ten 	= true;
	$config_images 	= true;
	$config_link 	= true;
	$config_mota 	= false;
	@define ( _width_thumb , 116 );
	@define ( _height_thumb , 68 );
	@define ( _style_thumb , 1 );
	@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
	$ratio_ = 1;
	break;

	//photo
	case 'quangcao':
	$title_main 	= 'Đối tác';	
	$config_linhvuc	= false;
	$config_ten 	= true;
	$config_images 	= true;
	$config_link 	= true;
	$config_mota 	= false;
	@define ( _width_thumb , 116 );
	@define ( _height_thumb , 68 );
	@define ( _style_thumb , 1 );
	@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
	$ratio_ = 1;
	break;

	//video
	case 'video':
	$title_main 	= 'Video';
	$config_ten 	= true; 
	$config_images 	= true; 
	$config_noibat 	= false; $config_text_noibat = 'Nổi Bật';
	break;
	
	//lkweb
	case 'socialheader':
	$title_main 	= "Liên kết web header";
	$config_ten 	= true;
	$config_images 	= true;
	$config_link 	= true;
	@define ( _width_thumb , 35 );
	@define ( _height_thumb , 35 );
	@define ( _style_thumb , 1 );
	@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
	$ratio_ = 1;
	break;	

	//lkweb
	case 'socialbody':
	$title_main 	= "Liên kết web body";
	$config_ten 	= true;
	$config_images 	= true;
	$config_link 	= true;
	@define ( _width_thumb , 35 );
	@define ( _height_thumb , 35 );
	@define ( _style_thumb , 1 );
	@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
	$ratio_ = 1;		
	break;	
	
	//lkweb
	case 'socialfooter':
	$title_main 	= "Liên kết web footer";
	$config_ten 	= true;
	$config_images 	= true;
	$config_link 	= true;
	@define ( _width_thumb , 35 );
	@define ( _height_thumb , 35 );
	@define ( _style_thumb , 1 );
	@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
	$ratio_ = 1;			
	break;

	//background
	case 'bgheader':
	$title_main 	= "Background Header";
	$config_option 	= true;
	$links_ 		= true;			
	@define ( _width_thumb , 1366 );
	@define ( _height_thumb , 110 );
	@define ( _style_thumb , 1 );
	@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
	$ratio_ = 1;
	break;	

	//background
	case 'bgbody':
	$title_main 	= "Background Body";
	$config_option 	= true;
	$links_ 		= true;			
	@define ( _width_thumb , 1366 );
	@define ( _height_thumb , 370 );
	@define ( _style_thumb , 1 );
	@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
	$ratio_ = 1;
	break;	

	//background
	case 'bgfooter':
	$title_main 	= "Background footer";
	$config_option 	= true;
	$links_ 		= true;			
	@define ( _width_thumb , 1366 );
	@define ( _height_thumb , 370 );
	@define ( _style_thumb , 1 );
	@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
	$ratio_ = 1;
	break;	

	//background
	case 'bgpagein':
	$title_main 	= "Background Trang Trong";
	$config_option 	= true;
	$links_ 		= true;			
	@define ( _width_thumb , 1366 );
	@define ( _height_thumb , 700 );
	@define ( _style_thumb , 1 );
	@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
	$ratio_ = 1;
	break;	

	//--------------defaut---------------//
	
	default: 
	$source = "";
	$template = "index";
	break;
}
?>