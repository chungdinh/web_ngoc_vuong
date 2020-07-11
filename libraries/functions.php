<?php if(!defined('_lib')) die("Error");

// Mã hóa passwords
function encrypt_password($str,$salt1,$salt2){
	return md5($salt1.$str.$salt2);
} 
function check_login(){
	return true;
}
// Màu ngẫu nhiên
function rand_color() {
	return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
}
// Kiểm tra url
function checkValidUrl($url)
{
	$regex = "|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i";
	return preg_match($regex, $url);
}
function level_1($table,$com,$type,$class_list){
    global $d,$lang,$str;
    $d->reset();
    $sql = "select id,ten_$lang as ten,tenkhongdau from #_$table where hienthi=1 and type='$type' order by stt,id desc";
    $d->query($sql);
    $baiviet = $d->result_array();
    
    $str='';
    $str.='<ul class="'.$class_list.'">';
    foreach ($baiviet as $key => $value) {
        $str.=
        '<li>
        	<a href="'.$com.'/'.$value["tenkhongdau"].'-'.$value["id"].'.html'.'">'.$value["ten"].'</a>
        </li>';
    }
    $str.='</ul>';      
    return $str;
}
function level_2($table_list,$table_cat,$com,$type,$class_list,$class_cat){
	global $d,$lang,$str;

	$d->reset();
	$sql = "select id,ten_$lang as ten,tenkhongdau from #_$table_list where hienthi=1 and type='$type' order by stt,id desc";
	$d->query($sql);
	$sql_list = $d->result_array();
	$str='';
	$str.='<ul class="'.$class_list.'">';
	foreach ($sql_list as $key_list => $value_list) {
		$str.='<li><a href="'.$com.'/'.$value_list["tenkhongdau"].'-'.$value_list["id"].'">'.$value_list["ten"].'</a>';
		$d->reset();
		$sql="select id,ten_$lang as ten,tenkhongdau from #_$table_cat where hienthi=1 and type='$type' and id_list='".$value_list["id"]."' order by stt,id asc";
		$d->query($sql);
		$sql_cat=$d->result_array();
		if(count($sql_cat)>0){
			$str.='<ul class="'.$class_cat.'">';
			 foreach ($sql_cat as $key_cat => $value_cat) {
					$str.='<li><a href="'.$com.'/'.$value_list["tenkhongdau"].'/'.$value_cat["tenkhongdau"].'-'.$value_cat["id"].'">'.$value_cat["ten"].'</a></li>';				
				}
			$str.='</ul>';
		}
		$str.='</li>';
	}
	$str.='</ul>';		
	return $str;
}
// Thứ theo tiếng Việt
function pofday($str){
	$temp = date('l',$str);
	switch ($temp) {
		case 'Monday':
		$day = 'Thứ Hai';
		break;

		case 'Tuesday':
		$day = 'Thứ Ba';
		break;

		case 'Wednesday':
		$day = 'Thứ Tư';
		break;

		case 'Thursday':
		$day = 'Thứ Năm';
		break;

		case 'Friday':
		$day = 'Thứ Sáu';
		break;

		case 'Saturday':
		$day = 'Thứ Bảy';
		break;
		
		default:
		$day = 'Chủ Nhật';
		break;
	}
	return $day;
}
//Tháng theo tiếng Việt
function change_month($str){
	$temp = date('M',$str);
	switch ($temp) {
		case 'Jan':
		$month = 'Tháng Một';
		break;

		case 'Feb':
		$month = 'Tháng Hai';
		break;

		case 'Mar':
		$month = 'Tháng Ba';
		break;

		case 'Apr':
		$month = 'Tháng Tư';
		break;

		case 'May':
		$month = 'Tháng Năm';
		break;

		case 'Jun':
		$month = 'Tháng Sáu';
		break;

		case 'Jul':
		$month = 'Tháng Bảy';
		break;

		case 'Aug':
		$month = 'Tháng Tám';
		break;
		case 'Sep':
		$month = 'Tháng Chín';
		break;

		case 'Oct':
		$month = 'Tháng Mười';
		break;

		case 'Nov':
		$month = 'Tháng Mười Một';
		break;

		default:
		$month = 'Tháng Mười Hai';
		break;
	}
	return $month;
}
// Tạo thư mục theo ngày tháng Dir trong config.php. Lưu ý chỉ sử dụng cho các trong web dữ liệu nhiều như bất động sản
function makedir($dir){
	global $config_dir;
	$directory = $dir.$config_dir;
	if(!is_dir($directory)){
		mkdir($directory, 777, true);
	}
	return $directory;
}

function get_diachi($id){
	$thanhvien = _fetch_array("SELECT diachi FROM table_member WHERE id=".$id);
	return $thanhvien['diachi'];
}

function get_ten($id){
	$thanhvien = _fetch_array("SELECT ten FROM table_member WHERE id=".$id);
	return $thanhvien['ten'];
}

function get_dienthoai($id){
	$thanhvien = _fetch_array("SELECT dienthoai FROM table_member WHERE id=".$id);
	return $thanhvien['dienthoai'];
}

function get_email($id){
	$thanhvien = _fetch_array("SELECT email FROM table_member WHERE id=".$id);
	return $thanhvien['email'];
}

function get_avatar($id){
	$thanhvien = _fetch_array("SELECT photo FROM table_member WHERE id=".$id);
	return $thanhvien['photo'];
}

function get_sluglist($id){
	global $d;
	$item = _fetch_array("SELECT tenkhongdau FROM table_baiviet_list WHERE id=".$id);
	return $item['tenkhongdau'];
}

function searchForId($id, $array) {
	foreach ($array as $key => $val) {
		if ($val['id'] === $id) {
			return $key;
		}
	}
	return null;
}

// Kiểm tra có sesstion member không
function isMember(){
	if(empty($_SESSION['member'])){
		return false;
	}
	return true;
}
// Mã hóa theo key riêng mình tự tạo cấu hình trong config.php
function encrypt_decrypt($action, $string) {
	$output = false;
	$encrypt_method = "AES-256-CBC";
	$secret_key = ENCRYPTION_KEY;
	$secret_iv = IV_KEY;
    // hash
	$key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	$iv = substr(hash('sha256', $secret_iv), 0, 16);
	if ( $action == 'encrypt' ) {
		$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
		$output = base64_encode($output);
	} else if( $action == 'decrypt' ) {
		$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	}
	return $output;
    //encrypt_decrypt('encrypt', $plain_txt)
    //encrypt_decrypt('decrypt', $encrypted_txt);
}
// Nén source html chỉ gọi function pt_html_minify_start() ra trang index.php lưu ý script dễ bị lỗi, không nên dùng
function pt_html_minify_start()  {
	ob_start( 'pt_html_minyfy_finish' );
}
function pt_html_minyfy_finish( $html )  {
	$html = preg_replace('/<!--(?!s*(?:[if [^]]+]|!|>))(?:(?!-->).)*-->/s', '', $html);
	$html = str_replace(array("\r\n", "\r", "\n", "\t"), '', $html);
	while ( stristr($html, '  '))
		$html = str_replace('  ', ' ', $html);
	return $html;
}
//Truy vấn nhanh bằng function
function _fetch_array($sql){
	global $d;
	$d->reset();
	$d->query($sql);
	$fetch = $d->fetch_array();
	return $fetch;
}

function _result_array($sql){
	global $d;
	$d->reset();
	$d->query($sql);
	$result = $d->result_array();
	return $result;
}

function _get_info_member($column,$except){
	$member = _result_array("SELECT `{$column}` FROM table_member WHERE `{$column}` like `{$except}`");
	return $member;
}
// Chặn google speed
function isGoogleSpeed(){
	if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Speed Insights') === false){ 
		return false;
	}
	return true;
}
// Function get ID video của youtube 
function getIDyoutube($urlYoutube){
	parse_str( parse_url( $urlYoutube, PHP_URL_QUERY ), $ar );
	return $ar['v'];
}

function getImgYoutube($urlYoutube){
	return $ImgYoutube="https://img.youtube.com/vi/".getIDyoutube($urlYoutube)."/0.jpg";
}

function checkphantram($giacu,$giamoi){
	$phantramgiam= (100-$phantram=($giamoi/$giacu)*100);
	if($phantramgiam>0){
		return $phantramgiam;
	}
}

function check_array($array){
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}

function format_money($gia,$donvi)
{
	$lienhe = '<a href="lien-he.html" title="Liên Hệ">Liên Hệ</a>';
	if($gia>0){
		$str= number_format($gia,0,",",".");
		$str.=$donvi;
	}else{$str =$lienhe;}
	return $str;
}
function format_money1($gia,$donvi)
{
	if($gia>0){
		$str= number_format($gia,0,",",".");
		$str.=$donvi;
	}
	return $str;
}

function format_money2($gia,$lienhe){
	if(!empty($gia) || $gia > 0){
		$str = $gia;
	} else {
		$str = $lienhe;
	}
	return $str;
}
function getRealIPAddress(){  
	if(!empty($_SERVER['HTTP_CLIENT_IP'])){
//check ip from share internet
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	}else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
//to check ip is pass from proxy
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}else{
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}
// Get tỷ giá online từ USD -> VNĐ
function getTigia(){
	$data = file_get_contents("http://free.currencyconverterapi.com/api/v5/convert?q=USD_VND&compact=ultra");
	$x = json_encode($data);
	return $x;
}

function magic_quote($str, $id_connect=false)	
{	
	if (is_array($str))
	{
		foreach($str as $key => $val)
		{
			$str[$key] = escape_str($val);
		}
		return $str;
	}
	if (is_numeric($str)) {
		return $str;
	}
	if(get_magic_quotes_gpc()){
		$str = stripslashes($str);
	}
	if (function_exists('mysql_real_escape_string') AND is_resource($id_connect))
	{
		return mysql_real_escape_string($str, $id_connect);
	}
	elseif (function_exists('mysql_escape_string'))
	{
		return mysql_escape_string($str);
	}
	else
	{
		return addslashes($str);
	}
}

function madonhang($matv,$table){
	global $d;
	$sql = "select id from table_$table order by id desc limit 0,1";
	$d->query($sql);
	$result = $d->result_array();
	if(count($result)==0){
		$kq = $matv."_000001";
	} else {
		$id = $result[0]['id']+1;
		$leng = strlen($id);
		if($leng==1){
			$kq = $matv."_00000".$id;
		} else if($leng==2){
			$kq = $matv."_0000".$id;
		} else if($leng==3){
			$kq = $matv."_000".$id;
		} else if($leng==4){
			$kq = $matv."_00".$id;
		} else if($leng==5){
			$kq = $matv."_0".$id;
		} else{
			$kq = $matv."_".$id;
		}
	}
	return $kq;
}
function dongdauanh($newname,$folder,$wm)	
{

	$uploadimage=$folder.$newname;
	$actual = $folder.$newname;
	
	$file_type = explode('.',$newname);
	  // Load the mian image
	switch(strtoupper($file_type[1])) {
		case 'GIF':
		       # GIF image
		$source = imageCreateFromGIF($uploadimage);
		break;
		case 'JPG':
		       # JPEG image

		$source = imagecreatefromjpeg($uploadimage);
		break;
		case 'PNG':
		       # PNG image
		$source = imageCreateFromPNG($uploadimage);
		break;
		default :
		       # JPEG image
		$source = imageCreateFromJPEG($uploadimage);
		break;
	}

	  // load the image you want to you want to be watermarked
	$watermark = imagecreatefrompng(_upload.$wm);
	$size = getimagesize($uploadimage);  

	  // get the width and height of the watermark image
	$water_width = imagesx($watermark);
	$water_height = imagesy($watermark);

	  // get the width and height of the main image image
	$main_width = imagesx($source);
	$main_height = imagesy($source);

	  // Set the dimension of the area you want to place your watermark we use 0
	  // from x-axis and 0 from y-axis 
	$dime_x = ($size[0] - $water_width)/2;  
	$dime_y = ($size[1] - $water_height)/2;

	  // copy both the images
	imagecopy($source, $watermark, $dime_x, $dime_y, 0, 0, $water_width, $water_height);

	  // Final processing Creating The Image
	  //header('Content-type: image/png');
	switch(strtoupper($file_type[1])) {
		case 'GIF':
		    # GIF image
		        //header("Content-type: image/gif");
		imageGIF($source,$actual, 100);
		break;
		case 'JPG':
		    # JPEG image
		        //header("Content-type: image/jpeg");
		imagejpeg($source,$actual, 100); 
		break;
		case 'PNG':
		    # PNG image
		        // header("Content-type: image/png");
		        // imagePNG($source);
		imagePNG($source,$actual, 0, NULL);
		break;
	}
	imagesavealpha($source, true);
	   //imagepng($source, $actual, 100);
}

function phanquyen_tv($com,$quyen,$act,$type){
	global $d;


	$text_act = explode('_',$act);
	$text_act = $text_act[1];
	
	$d->reset();
	$sql = "select * from #_phanquyen where id='".$quyen."' ";
	$d->query($sql);
	$phanquyen = $d->fetch_array();

	$d->reset();
	$sql = "select * from #_com where ten_com='".$com."' and act ='".$text_act."' and type ='".$type."' ";
	$d->query($sql);
	$com_manager = $d->fetch_array();

	$xem_s = json_decode($phanquyen['xem']);
	$them_s = json_decode($phanquyen['them']);
	$xoa_s = json_decode($phanquyen['xoa']);
	$sua_s = json_decode($phanquyen['sua']);

	$xem_arr = explode('|',"capnhat|man|man_list|man_cat|man_item|man_sub");
	$them_arr = explode('|',"add|add_cat|add_list|add_item|add_sub|save|save_list|save_cat|save_item|save_sub");
	$xoa_arr = explode('|',"delete|delete_list|delete_cat|delete_item,delete_sub");
	$sua_arr = explode('|',"edit|edit_list|edit_cat|edit_item|edit_sub|save|save_list|save_cat|save_item|save_sub");

	if(in_array($act,$xem_arr)){
		if(in_array($com_manager['id'].'|1',$xem_s)){
			return 1;
		} else {
			return 0;
		}
	} elseif(in_array($act,$them_arr)) {
		if(in_array($com_manager['id'].'|1',$them_s)){
			return 1;
		} else {
			return 0;
		}
	} elseif(in_array($act,$xoa_arr)){
		if(in_array($com_manager['id'].'|1',$xoa_s)){
			return 1;
		} else {
			return 0;
		}
	} elseif(in_array($act,$sua_arr)){
		if(in_array($com_manager['id'].'|1',$sua_s)){
			return 1;
		} else {
			return 0;
		}
	} else {
		return 0;
	}


}
function phanquyen_edit($quyen,$role,$vitri){
	global $d,$kiemtra;
	
	$d->reset();
	$sql = "select * from #_phanquyen where id='".$quyen."' ";
	$d->query($sql);
	$phanquyen = $d->fetch_array();
	
	$com_s = json_decode($phanquyen['com']);
	$vitri_s = json_decode($phanquyen['table_vitri']);
	$sua_s = json_decode($phanquyen['sua']);
	
	if($role==3){
		$kiemtra = 1;	
	} else {
		for($i=0;$i<count($vitri_s);$i++){
			if($vitri_s[$i] == $vitri ){
				if(in_array($i.'|1',$sua_s)){
					$kiemtra = 1;
				}
			} 
		}
	}
	return $kiemtra;

}
function fns_Rand_digit($min,$max,$num)
{
	$result='';
	for($i=0;$i<$num;$i++){
		$result.=rand($min,$max);
	}
	return $result;	
}
function get_tong_tien($id=0){
	global $d;
	if($id>0){
		$d->reset();
		$sql="select tonggia from #_order where id='".$id."'";
		$d->query($sql);
		$tongtien = $d->fetch_array();
		return $tongtien['tonggia'];
	}else return 0;
}
function get_phi_fnc($pid){
	global $d, $row,$lang;
	$sql="SELECT phi_khac FROM #_product WHERE id='".$pid."'";
	$d->query($sql);
	$row = $d->fetch_array();
	return $row['phi_khac'];
}
function daxem($pid){
	if($pid<1) return;

	if(is_array($_SESSION['daxem'])){
		if(daxem_exists($pid)) return;
		$max=count($_SESSION['daxem']);
		$_SESSION['daxem'][$max]['productid']=$pid;
	}
	else{
		$_SESSION['daxem']=array();
		$_SESSION['daxem'][0]['productid']=$pid;
	}
}

function _substr($str,$n)
{
	if(strlen($str)<$n) return $str;
	$html = substr($str,0,$n);
	$html = substr($html,0,strrpos($html,' '));
	return $html.'..';
}
function giamgia($giacu,$giaban){
	$ketqua = ($giacu - $giaban)/($giacu);
	if ($ketqua>0) {
		$phantram = round($ketqua*100);
		return $phantram;	
	}else{
		return 0;
	}
}
function upload_photos($file, $extension, $folder, $newname=''){
	$folder = makedir($folder);
	if(isset($file) && !$file['error']){
		
		$ext = end(explode('.',$file['name']));
		$name = basename($file['name'], '.'.$ext);
		//alert('Chỉ hỗ trợ upload file dạng '.$ext);
		if(strpos($extension, $ext)===false){
			alert('Chỉ hỗ trợ upload file dạng '.$ext.'-////-'.$extension);
			return false; // không hỗ trợ
		}
		
		if($newname=='' && file_exists($folder.$file['name']))
			for($i=0; $i<100; $i++){
				if(!file_exists($folder.$name.$i.'.'.$ext)){
					$file['name'] = $name.$i.'.'.$ext;
					break;
				}
			}
			else{
				$file['name'] = $newname.'.'.$ext;
			}

			if (!copy($file["tmp_name"], $folder.$file['name']))	{
				if ( !move_uploaded_file($file["tmp_name"], $folder.$file['name']))	{
					return false;
				}
			}
			return $file['name'];
		}
		return false;
	}
	function escape_str($str, $id_connect=false)	
	{	
		if (is_array($str))
		{
			foreach($str as $key => $val)
			{
				$str[$key] = escape_str($val);
			}

			return $str;
		}

		if (is_numeric($str)) {
			return $str;
		}

		if(get_magic_quotes_gpc()){
			$str = stripslashes($str);
		}

		if (function_exists('mysql_real_escape_string') AND is_resource($id_connect))
		{
			return "'".mysql_real_escape_string($str, $id_connect)."'";
		}
		elseif (function_exists('mysql_escape_string'))
		{
			return "'".mysql_escape_string($str)."'";
		}
		else
		{
			return "'".addslashes($str)."'";
		}
	}

	function make_date($time,$dot='.',$lang='vi',$f=false){

		$str = ($lang == 'vi') ? date("d{$dot}m{$dot}Y",$time) : date("m{$dot}d{$dot}Y",$time);
		if($f){
			$thu['vi'] = array('Chủ nhật','Thứ 2','Thứ 3','Thứ 4','Thứ 5','Thứ 6','Thứ 7');
			$thu['en'] = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
			$str = $thu[$lang][date('w',$time)].', '.$str;
		}
		return $str;
	}
	function count_online(){
/*
CREATE TABLE `camranh_online` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `session_id` varchar(255) NOT NULL,
  `time` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;
*/
global $d;
	$time = 600; // 10 phut
	$ssid = session_id();

	// xoa het han
	$sql = "delete from #_online where time<".(time()-$time);
	$d->query($sql);
	//
	$sql = "select id,session_id from #_online order by id desc";
	$d->query($sql);
	$result['dangxem'] = $d->num_rows();
	$rows = $d->result_array();
	$i = 0;
	while(($rows[$i]['session_id'] != $ssid) && $i++<$result['dangxem']);
	
	if($i<$result['dangxem']){
		$sql = "update #_online set time='".time()."' where session_id='".$ssid."'";
		$d->query($sql);
		$result['daxem'] = $rows[0]['id'];
	}
	else{
		$sql = "insert into #_online (session_id, time) values ('".$ssid."', '".time()."')";
		$d->query($sql);
		$result['daxem'] = mysql_insert_id();
		$result['dangxem']++;
	}
	
	return $result; // array('dangxem'=>'', 'daxem'=>'')
}

function delete_file($file){
	return @unlink($file);
}


function upload_image($file, $extension, $folder, $newname=''){
	if(isset($_FILES[$file]) && !$_FILES[$file]['error']){
		
		$ext = end(explode('.',$_FILES[$file]['name']));
		$name = basename($_FILES[$file]['name'], '.'.$ext);
		
		if(strpos($extension, $ext)===false){
			alert('Chỉ hỗ trợ upload file dạng '.$extension);
			return false; // không hỗ trợ
		}
		
		if($newname=='' && file_exists($folder.$_FILES[$file]['name']))
			for($i=0; $i<100; $i++){
				if(!file_exists($folder.$name.$i.'.'.$ext)){
					$_FILES[$file]['name'] = $name.$i.'.'.$ext;
					break;
				}
			}
			else{
				$_FILES[$file]['name'] = $newname.'.'.$ext;
			}

			if (!copy($_FILES[$file]["tmp_name"], $folder.$_FILES[$file]['name']))	{
				if ( !move_uploaded_file($_FILES[$file]["tmp_name"], $folder.$_FILES[$file]['name']))	{
					//die("iok");
					return false;
				}
			}
			return $_FILES[$file]['name'];
		}
		return false;
	}

	function chuanhoa($s){
		$s = str_replace("←", '&larr;', $s);
		return $s;
	}

	function themdau($s){
		$s = addslashes($s);
		return $s;
	}

	function bodau($s){
		$s = stripslashes($s);
		return $s;
	}


	function transfer($msg,$page="index.php",$stt=true)
	{
		$showtext = $msg;
		$page_transfer = $page;
		include("./templates/transfer_tpl.php");
		exit();
	}

	function redirect($url=''){
		echo '<script language="javascript">window.location = "'.$url.'" </script>';
		exit();
	}

	function back($n=1){
		echo '<script language="javascript">history.go = "'.-intval($n).'" </script>';
		exit();
	}

	function dump($arr, $exit=1){
		echo "<pre>";	
		var_dump($arr);
		echo "<pre>";	
		if($exit)	exit();
	}
	function paging_home($r, $url='', $curPg=1, $mxR=5, $mxP=5, $class_paging='')
	{
		if($curPg<1) $curPg=1;
		if($mxR<1) $mxR=5;
		if($mxP<1) $mxP=5;
		$totalRows=count($r);
		if($totalRows==0)	
			return array('source'=>NULL, 'paging'=>NULL);
		$totalPages=ceil($totalRows/$mxR);

		
		
		
		if($curPg > $totalPages) $curPg=$totalPages;
		
		$_SESSION['maxRow']=$mxR;
		$_SESSION['curPage']=$curPg;

		$r2=array();
		$paging="";
		
		//-------------tao array------------------
		$start=($curPg-1)*$mxR;		
		$end=($start+$mxR)<$totalRows?($start+$mxR):$totalRows;
		#echo $start;
		#echo $end;
		
		$j=0;
		for($i=$start;$i<$end;$i++)
			$r2[$j++]=$r[$i];

		//-------------tao chuoi------------------
		$curRow = ($curPg-1)*$mxR+1;	
		if($totalRows>$mxR)
		{
			
			$from = $curPg - $mxP;	
			$to = $curPg + $mxP;
			if ($from <=0) { $from = 1;   $to = $mxP*2; }
			if ($to > $totalPages) { $to = $totalPages; }
			for($j = $from; $j <= $to; $j++) {
				if ($j == $curPg) $links = $links . "<a class=\"paginate_active\" href=\"#\">{$j}</a>";		
				else{				
					$qt = $url. "&p={$j}";
					$links= $links . "<a class=\"paginate_button\" href = '{$qt}'>{$j}</a>";
				} 	   
			} //for

			//$paging.= "Go to page :&nbsp;&nbsp;" ;
			if($curPg>$mxP)
			{
				$paging .=" <a href='".$url."' class=\"first paginate_button\" >&laquo;</a> "; //ve dau				
				$paging .=" <a href='".$url."&p=".($curPg-1)."' class=\"previous paginate_button\" >&#8249;</a> "; //ve truoc
			}else{
				$paging .=" <a href='".$url."' class=\"first paginate_button paginate_button_disabled\" >&laquo;</a> "; //ve dau				
				$paging .=" <a href='".$url."&p=".($curPg-1)."' class=\"previous paginate_button paginate_button_disabled\" >&#8249;</a> "; //ve truoc
			}
			$paging.=$links; 
			if(((int)(($curPg-1)/$mxP+1)*$mxP) < $totalPages)  
			{
				$paging .=" <a href='".$url."&p=".($curPg+1)."' class=\"next paginate_button\" >&#8250;</a> "; //ke				
				$paging .=" <a href='".$url."&p=".($totalPages)."' class=\"last paginate_button\" >&raquo;</a> "; //ve cuoi
			}else{
				$paging .=" <a href='".$url."&p=".($curPg+1)."' class=\"next paginate_button paginate_button_disabled\" >&#8250;</a> "; //ke				
				$paging .=" <a href='".$url."&p=".($totalPages)."' class=\"last paginate_button paginate_button_disabled\" >&raquo;</a> "; //ve cuoi
			}
		}		
		$r3['curPage']=$curPg;
		$r3['source']=$r2;
		$r3['paging']=$paging;			
		$r3['totalRows']=$totalRows;		
		#echo '<pre>';var_dump($r3);echo '</pre>';
		return $r3;
	}
	function catchuoi($chuoi,$gioihan){
// nếu độ dài chuỗi nhỏ hơn hay bằng vị trí cắt
// thì không thay đổi chuỗi ban đầu
		if(strlen($chuoi)<=$gioihan)
		{
			return $chuoi;
		}
		else{
/*
so sánh vị trí cắt
với kí tự khoảng trắng đầu tiên trong chuỗi ban đầu tính từ vị trí cắt
nếu vị trí khoảng trắng lớn hơn
thì cắt chuỗi tại vị trí khoảng trắng đó
*/
if(strpos($chuoi," ",$gioihan) > $gioihan){
	$new_gioihan=strpos($chuoi," ",$gioihan);
	$new_chuoi = substr($chuoi,0,$new_gioihan)."...";
	return $new_chuoi;
}
// trường hợp còn lại không ảnh hưởng tới kết quả
$new_chuoi = substr($chuoi,0,$gioihan)."...";
return $new_chuoi;
}
}

function stripUnicode($str){
	if(!$str) return false;
	$unicode = array(
		'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
		'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
		'd'=>'đ',
		'D'=>'Đ',
		'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
		'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
		'i'=>'í|ì|ỉ|ĩ|ị',	  
		'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
		'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
		'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
		'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
		'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
		'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
		'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
	);
	foreach($unicode as $khongdau=>$codau) {
		$arr=explode("|",$codau);
		$str = str_replace($arr,$khongdau,$str);
	}
	return $str;
}// Doi tu co dau => khong dau

function pagination($query,$per_page=10,$page=1,$url='?',$class='pagination-sm'){   
	global $d; 

	$sql = "SELECT COUNT(*) as `num` FROM {$query}";
	$d->query($sql);
	$row = $d->fetch_array();
	$total = $row['num'];
	$adjacents = "1"; 

	$prevlabel = "‹";
	$nextlabel = "›";
	$lastlabel = "»";

	$page = ($page == 0 ? 1 : $page);  
	$start = ($page - 1) * $per_page;                               

	$prev = $page - 1;                          
	$next = $page + 1;

	$lastpage = ceil($total/$per_page);

    $lpm1 = $lastpage - 1; // //last page minus 1

    $pagination = "";
    if($lastpage > 1){   
    	$pagination .= "<ul class='pagination $class'>";
        // $pagination .= "<li class='page_info'>Trang {$page} of {$lastpage}</li>";

    	if ($page > 1) $pagination.= "<li class='prev'><a href='{$url}&page={$prev}'>{$prevlabel}</a></li>";

    	if ($lastpage < 7 + ($adjacents * 2)){   
    		for ($counter = 1; $counter <= $lastpage; $counter++){
    			if ($counter == $page)
    				$pagination.= "<li class='active'><a>{$counter}</a></li>";
    			else
    				$pagination.= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";                    
    		}

    	} elseif($lastpage > 5 + ($adjacents * 2)){

    		if($page < 1 + ($adjacents * 2)) {

    			for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
    				if ($counter == $page)
    					$pagination.= "<li class='active'><a>{$counter}</a></li>";
    				else
    					$pagination.= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";                    
    			}
    			$pagination.= "<li class='dot'>...</li>";
    			$pagination.= "<li><a href='{$url}&page={$lpm1}'>{$lpm1}</a></li>";
    			$pagination.= "<li><a href='{$url}&page={$lastpage}'>{$lastpage}</a></li>";  

    		} elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {

    			$pagination.= "<li><a href='{$url}&page=1'>1</a></li>";
    			$pagination.= "<li><a href='{$url}&page=2'>2</a></li>";
    			$pagination.= "<li class='dot'>...</li>";
    			for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
    				if ($counter == $page)
    					$pagination.= "<li class='active'><a>{$counter}</a></li>";
    				else
    					$pagination.= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";                    
    			}
    			$pagination.= "<li class='dot'>..</li>";
    			$pagination.= "<li><a href='{$url}&page={$lpm1}'>{$lpm1}</a></li>";
    			$pagination.= "<li><a href='{$url}&page={$lastpage}'>{$lastpage}</a></li>";      

    		} else {

    			$pagination.= "<li><a href='{$url}&page=1'>1</a></li>";
    			$pagination.= "<li><a href='{$url}&page=2'>2</a></li>";
    			$pagination.= "<li class='dot'>..</li>";
    			for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
    				if ($counter == $page)
    					$pagination.= "<li class='active'><a>{$counter}</a></li>";
    				else
    					$pagination.= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";                    
    			}
    		}
    	}
    	if ($page < $counter - 1) {
    		$pagination.= "<li class='next'><a href='{$url}&page={$next}'>{$nextlabel}</a></li>";
    		$pagination.= "<li class='last'><a href='{$url}&page=$lastpage'>{$lastlabel}</a></li>";
    	}

    	$pagination.= "</ul>";        
    }

    return $pagination;
}

function changeTitle($str)
{
	$str = stripUnicode($str);
	$str = mb_convert_case($str,MB_CASE_LOWER,'utf-8');
	$str = trim($str);
	$str = preg_replace('/[^a-zA-Z0-9\ ]/','',$str); 
	$str = str_replace("  "," ",$str);
	$str = str_replace(" ","-",$str);
	return $str;
}
function images_name($tenhinh)
{
	$rand=rand(10,9999);
	$ten_anh=explode(".",$tenhinh);
	$result = changeTitle($ten_anh[0])."-".$rand;
	return $result; 
}
function getCurrentPageURL() {
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	$pageURL = explode("&page=", $pageURL);
	return $pageURL[0];
}
function getCurrentPage() {
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}
function create_thumb($file, $width, $height, $folder,$file_name,$zoom_crop='1'){

// ACQUIRE THE ARGUMENTS - MAY NEED SOME SANITY TESTS?
	$new_width   = $width;
	$new_height   = $height;

	if ($new_width && !$new_height) {
		$new_height = floor ($height * ($new_width / $width));
	} else if ($new_height && !$new_width) {
		$new_width = floor ($width * ($new_height / $height));
	}
	
	$image_url = $folder.$file;
	$origin_x = 0;
	$origin_y = 0;
// GET ORIGINAL IMAGE DIMENSIONS
	$array = getimagesize($image_url);
	if ($array)
	{
		list($image_w, $image_h) = $array;
	}
	else
	{
		die("NO IMAGE $image_url");
	}
	$width=$image_w;
	$height=$image_h;

// ACQUIRE THE ORIGINAL IMAGE
	$image_ext = trim(strtolower(end(explode('.', $image_url))));
	switch(strtoupper($image_ext))
	{
		case 'JPG' :
		case 'JPEG' :
		$image = imagecreatefromjpeg($image_url);
		$func='imagejpeg';
		break;
		case 'PNG' :
		$image = imagecreatefrompng($image_url);
		$func='imagepng';
		break;
		case 'GIF' :
		$image = imagecreatefromgif($image_url);
		$func='imagegif';
		break;

		default : die("UNKNOWN IMAGE TYPE: $image_url");
	}

// scale down and add borders
	if ($zoom_crop == 3) {

		$final_height = $height * ($new_width / $width);

		if ($final_height > $new_height) {
			$new_width = $width * ($new_height / $height);
		} else {
			$new_height = $final_height;
		}

	}

	// create a new true color image
	$canvas = imagecreatetruecolor ($new_width, $new_height);
	imagealphablending ($canvas, false);

	// Create a new transparent color for image
	$color = imagecolorallocatealpha ($canvas, 255, 255, 255, 127);

	// Completely fill the background of the new image with allocated color.
	imagefill ($canvas, 0, 0, $color);

	// scale down and add borders
	if ($zoom_crop == 2) {

		$final_height = $height * ($new_width / $width);
		
		if ($final_height > $new_height) {
			
			$origin_x = $new_width / 2;
			$new_width = $width * ($new_height / $height);
			$origin_x = round ($origin_x - ($new_width / 2));

		} else {

			$origin_y = $new_height / 2;
			$new_height = $final_height;
			$origin_y = round ($origin_y - ($new_height / 2));

		}

	}

	// Restore transparency blending
	imagesavealpha ($canvas, true);

	if ($zoom_crop > 0) {

		$src_x = $src_y = 0;
		$src_w = $width;
		$src_h = $height;

		$cmp_x = $width / $new_width;
		$cmp_y = $height / $new_height;

		// calculate x or y coordinate and width or height of source
		if ($cmp_x > $cmp_y) {

			$src_w = round ($width / $cmp_x * $cmp_y);
			$src_x = round (($width - ($width / $cmp_x * $cmp_y)) / 2);

		} else if ($cmp_y > $cmp_x) {

			$src_h = round ($height / $cmp_y * $cmp_x);
			$src_y = round (($height - ($height / $cmp_y * $cmp_x)) / 2);

		}

		// positional cropping!
		if ($align) {
			if (strpos ($align, 't') !== false) {
				$src_y = 0;
			}
			if (strpos ($align, 'b') !== false) {
				$src_y = $height - $src_h;
			}
			if (strpos ($align, 'l') !== false) {
				$src_x = 0;
			}
			if (strpos ($align, 'r') !== false) {
				$src_x = $width - $src_w;
			}
		}

		imagecopyresampled ($canvas, $image, $origin_x, $origin_y, $src_x, $src_y, $new_width, $new_height, $src_w, $src_h);

	} else {

        // copy and resize part of an image with resampling
		imagecopyresampled ($canvas, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

	}
	


	$new_file=$file_name.'_'.$new_width.'x'.$new_height.'.'.$image_ext;
// SHOW THE NEW THUMB IMAGE
	if($func=='imagejpeg') $func($canvas, $folder.$new_file,100);
	else $func($canvas, $folder.$new_file,floor ($quality * 0.09));

	return $new_file;

}
function ChuoiNgauNhien($sokytu){
	$chuoi="ABCDEFGHIJKLMNOPQRSTUVWXYZWabcdefghijklmnopqrstuvwxyzw0123456789";
	for ($i=0; $i < $sokytu; $i++){
		$vitri = mt_rand( 0 ,strlen($chuoi) );
		$giatri= $giatri . substr($chuoi,$vitri,1 );
	}
	return $giatri;
} 

function check_yahoo($nick_yahoo='nthaih'){
	$file = @fopen("http://opi.yahoo.com/online?u=".$nick_yahoo."&m=t&t=1","r");
	$read = @fread($file,200);
	
	if($read==false || strstr($read,"00"))
		$img = '<img src="images/yahoo_offline.png" border="0" align="absmiddle" />';
	else
		$img = '<img src="images/yahoo_online.png" border="0" align="absmiddle"/>';
	return '<a href="ymsgr:sendIM?'.$nick_yahoo.'">'.$img.'</a>';
}
function limitWord($string, $maxOut){

	$string2Array = explode(' ', $string, ($maxOut + 1));

	if( count($string2Array) > $maxOut ){
		array_pop($string2Array);
		$output = implode(' ', $string2Array)."...";
	}else{
		$output = $string;
	}
	return $output;
}

function pagesListLimitadmin($url , $totalRows , $pageSize = 5, $offset = 5){
	if ($totalRows<=0) return "";
	$totalPages = ceil($totalRows/$pageSize);
	if ($totalPages<=1) return "";		
	if( isset($_GET["p"]) == true)  $currentPage = $_GET["p"];
	else $currentPage = 1;
	settype($currentPage,"int");	
	if ($currentPage <=0) $currentPage = 1;	
	$firstLink = "<li><a href=\"{$url}\" class=\"left\">First</a><li>";
	$lastLink="<li><a href=\"{$url}&p={$totalPages}\" class=\"right\">End</a></li>";
	$from = $currentPage - $offset;	
	$to = $currentPage + $offset;
	if ($from <=0) { $from = 1;   $to = $offset*2; }
	if ($to > $totalPages) { $to = $totalPages; }
	for($j = $from; $j <= $to; $j++) {
		if ($j == $currentPage) $links = $links . "<li><a href='#' class='active'>{$j}</a></li>";		
		else{				
			$qt = $url. "&p={$j}";
			$links= $links . "<li><a href = '{$qt}'>{$j}</a></li>";
		} 	   
	} //for
	return '<ul class="pages">'.$firstLink.$links.$lastLink.'</ul>';
} // function pagesListLimit
function format_size ($rawSize)
{
	if ($rawSize / 1048576 > 1) return round($rawSize / 1048576, 1) . ' MB';
	else 
		if ($rawSize / 1024 > 1) return round($rawSize / 1024, 1) . ' KB';
	else
		return round($rawSize, 1) . ' Bytes';
}
function youtobi($id)
{
	$ext = explode('=',$id);
	$vaich = $ext[1];
	return $vaich;
}
function convert_number_to_words($number) {
	$hyphen      = ' ';
	$conjunction = '  ';
	$separator   = ' ';
	$negative    = 'âm ';
	$decimal     = ' phẩy ';
	$dictionary  = array(
		0                   => '0',
		1                   => '1',
		2                   => '2',
		3                   => '3',
		4                   => '4',
		5                   => '5',
		6                   => '6',
		7                   => '7',
		8                   => '8',
		9                   => '9',
		10                  => 'Mười',
		11                  => 'Mười Một',
		12                  => 'Mười Hai',
		13                  => 'Mười Ba',
		14                  => 'Mười Bốn',
		15                  => 'Mười Lăm',
		16                  => 'Mười Sáu',
		17                  => 'Mười Bảy',
		18                  => 'Mười Tám',
		19                  => 'Mười Chín',
		20                  => 'Hai Mươi',
		30                  => 'Ba Mươi',
		40                  => 'Bốn Mươi',
		50                  => 'Năm Mươi',
		60                  => 'Sáu Mươi',
		70                  => 'Bảy Mươi',
		80                  => 'Tám Mươi',
		90                  => 'Chín Mươi',
		100                 => 'Trăm',
		1000                => 'Ngàn',
		1000000             => 'Triệu',
		1000000000          => 'Tỷ',
		1000000000000       => 'Nghìn Tỷ',
		1000000000000000    => 'Ngàn Triệu Triệu',
		1000000000000000000 => 'Tỷ Tỷ'
	);

	if (!is_numeric($number)) {
		return false;
	}

	if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
		// overflow
		trigger_error(
			'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
			E_USER_WARNING
		);
		return false;
	}

	if ($number < 0) {
		return $negative . convert_number_to_words(abs($number));
	}

	$string = $fraction = null;

	if (strpos($number, '.') !== false) {
		list($number, $fraction) = explode('.', $number);
	}

	switch (true) {
		case $number < 21:
		$string = $dictionary[$number];
		break;
		case $number < 100:
		$tens   = ((int) ($number / 10)) * 10;
		$units  = $number % 10;
		$string = $dictionary[$tens];
		if ($units) {
			$string .= $hyphen . $dictionary[$units];
		}
		break;
		case $number < 1000:
		$hundreds  = $number / 100;
		$remainder = $number % 100;
		$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
		if ($remainder) {
			$string .= $conjunction . convert_number_to_words($remainder);
		}
		break;
		default:
		$baseUnit = pow(1000, floor(log($number, 1000)));
		$numBaseUnits = (int) ($number / $baseUnit);
		$remainder = $number % $baseUnit;
		$string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
		if ($remainder) {
			$string .= $remainder < 100 ? $conjunction : $separator;
			$string .= convert_number_to_words($remainder);
		}
		break;
	}

	if (null !== $fraction && is_numeric($fraction)) {
		$string .= $decimal;
		$words = array();
		foreach (str_split((string) $fraction) as $number) {
			$words[] = $dictionary[$number];
		}
		$string .= implode(' ', $words);
	}

	return $string;
}

function news($value, $class_,$com_,$thumb_){
	global $lang,$d,$com;
	$link = $com_.'/'.$value['tenkhongdau'].'-'.$value['id'].'.html';
	if (!empty($value['mota'])) {$mota = catchuoi($value['mota'],200);	} else{ $mota = 'Nội dung đang cập nhật...';}
	return $news = '
	<div class="'.$class_.'">
		<div class="inNews-item">
			<article class="inNews-img">
				<div class="effect-scale img-full">
					<a href="'.$link.'" title="'.$value['ten'].'">
						<img src="thumb/'.$thumb_.'/'._upload_baiviet_l.$value['photo'].'" alt="'.$value['ten'].'" onerror="this.src=&apos;thumb/'.$thumb_.'/images/noimg.jpg&apos;">
					</a>
				</div>
			</article>
			<article class="inNews-text flexbox">
				<h3>
					<a href="'.$link.'" title="'.$value['ten'].'">'.catchuoi($value['ten'],80).'</a>
				</h3>
				<div class="inNews-date">
				'.date('d',$value['ngaytao']).'
				<span>'.date('m - Y',$value['ngaytao']).'</span>
				</div>
			</article>
		</div>	
	</div>';
}
function news_more($value, $class_,$com_,$thumb_){
	global $lang,$d,$com;
	$link = $com_.'/'.$value['tenkhongdau'].'-'.$value['id'].'.html';
	if (!empty($value['mota'])) {$mota = catchuoi($value['mota'],200);	} else{ $mota = 'Nội dung đang cập nhật...';}
	return $news = '
	<div class="'.$class_.'">
		<div class="inNews-more-item flexbox">
			<article class="inNews-more-img">
				<div class="effect-scale img-full">
					<a href="'.$link.'" title="'.$value['ten'].'">
						<img src="thumb/'.$thumb_.'/'._upload_baiviet_l.$value['photo'].'" alt="'.$value['ten'].'" onerror="this.src=&apos;thumb/'.$thumb_.'/images/noimg.jpg&apos;">
					</a>
				</div>
			</article>
			<article class="inNews-more-text flexbox-col">
				<h3>
					<a href="'.$link.'" title="'.$value['ten'].'">'.catchuoi($value['ten'],80).'</a>
				</h3>
				<p>'.$mota.'</p>
				<span>
					<a href="'.$link.'" title="'.$value['ten'].'">Xem Thêm</a>
				</span>
			</article>
		</div>	
	</div>';
}
function product($value, $class_,$com_,$thumb_){
	global $lang,$d,$com;
	$link = $com_.'/'.$value['tenkhongdau'].'-'.$value['id'].'.html';
	if (!empty($value['mota'])) {$mota = catchuoi($value['mota'],200);	} else{ $mota = 'Nội dung đang cập nhật...';}
	$giamgia = giamgia($value['giacu'],$value['giaban']);
	return $news = 
	'<div class="'.$class_.'">
		<div class="sanpham-item itemhover">
			<article class="sanpham-img effect-scale img-full">
				<a href="'.$link.'" title="'.$value['ten'].'">
					<img src="thumb/'.$thumb_.'/'._upload_product_l.$value['photo'].'" alt="'.$value['ten'].'" onerror="this.src=&apos;thumb/'.$thumb_.'/images/noimg.jpg&apos;">
				</a>
			</article>
			<article class="sanpham-text">
					<h3>
						<a href="'.$link.'" title="'.$value['ten'].'">'.catchuoi($value['ten'],80).'</a>
					</h3>
					<p class="flexbox">'.return_price($value['giacu'],$value['giaban']).'</p>
			</article>
		</div>
	</div>';
}
function product_default($value, $class_,$com_,$thumb_){
	global $lang,$d,$com;
	$link = $com_.'/'.$value['tenkhongdau'].'-'.$value['id'].'.html';
	if (!empty($value['mota'])) {$mota = catchuoi($value['mota'],200);	} else{ $mota = 'Nội dung đang cập nhật...';}
	$giamgia = giamgia($value['giacu'],$value['giaban']);
	return $news = 
	'<div class="'.$class_.'">
		<div class="sanpham-item itemhover">
			<article class="sanpham-img effect-scale img-full">
				<a href="'.$link.'" title="'.$value['ten'].'">
					<img src="thumb/'.$thumb_.'/'._upload_product_l.$value['photo'].'" alt="'.$value['ten'].'" onerror="this.src=&apos;thumb/'.$thumb_.'/images/noimg.jpg&apos;">
				</a>
			</article>
			<article class="sanpham-text">
				<div class="sanpham-name hover">
					<h3>
						<a href="'.$link.'" title="'.$value['ten'].'">'.catchuoi($value['ten'],80).'</a>
					</h3>
				</div>
				<div class="sanpham-mota">
					<p>'.$mota.'</p>
					<b>Giá: '.return_price($value['giacu'],$value['giaban']).'</b>
				</div>
				<div class="sanpham-plus">
					<a href="'.$link.'" title="'.$value['ten'].'">Xem Thêm</a>
		            <button type="text" onclick="addtocart('.$value['id'].')"> mua hàng</button>
				</div>
			</article>
			<div class="item-top"></div>
        	<div class="item-right"></div>
        	<div class="item-bot"></div>
        	<div class="item-left"></div>
		</div>
	</div>';
}
function return_price($giacu,$giaban){
	$price_old = format_money1($giacu,'<u>đ</u>');
	$price_new = format_money1($giaban,'<u>đ</u>');
	if ($giaban>0 && $giacu >0 && $giacu>$giaban) {
		return $price = '
		<span class="price-new">'.$price_new.'</span>
		<span class="price-old"><del>'.$price_old.'</del></span>
		';
	} 
	elseif($giaban==0 && $giacu>0){ return $price = '<span class="price-new">'.$price_old.'</span>';	}
	elseif($giaban==0 && $giacu==0){ return $price = '<a href="lien-he.html">Liên Hệ</a>';}
	else{ return $price='Nhập giá lỗi';}
}

function _download($value,$class_=''){
global $lang,$d,$com;
$link = _upload_files_l.$value['file_baogia'];
return $download = '
<div class="'.$class_.'">
    <div class="box_download">
        <h4>
            <a target="_blank" href="'.$link.'" title="'.$value['ten_'.$lang].'">
                '.$value['ten_'.$lang].'
            </a>
        </h4>
        <a target="_blank" href="'.$link.'" title="'.$value['ten_'.$lang].'">
            <img src="thumb/370x400/2/'._upload_baiviet_l.$value['photo'].'" alt="'.$value['ten_'.$lang].'">
        </a>
    </div>
</div>
';
}
function headingSeo($title_){
return $str = '<h1 class="visit_hidden">'.$title_.'</h1>
<h2 class="visit_hidden">'.$title_.'</h2>
<h3 class="visit_hidden">'.$title_.'</h3>
<h4 class="visit_hidden">'.$title_.'</h4>
<h5 class="visit_hidden">'.$title_.'</h5>
<h6 class="visit_hidden">'.$title_.'</h6>';
}
function isAjaxRequest(){
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
return true;
return false;
}
?>