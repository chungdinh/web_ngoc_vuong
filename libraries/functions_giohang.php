<?php

	// function get_tong_tien($id=0){
	// 	global $d;
	// 	if($id>0){
	// 		$d->reset();
	// 		$sql="select gia,soluong from #_order_detail where id_order='".$id."'";
	// 		$d->query($sql);
	// 		$result=$d->result_array();
	// 		$tongtien=0;
	// 		for($i=0,$count=count($result);$i<$count;$i++) { 
	// 			$tongtien+=	$result[$i]['gia']*$result[$i]['soluong'];	
	// 		}
	// 		return $tongtien;
	// 	}else return 0;
	// }
function ten_thanhvien($id){
	$thanhvien = _fetch_array("SELECT email FROM table_member WHERE id=".$id);
	return $thanhvien['email'];
}
function get_thumb($pid){
	global $d, $row;
	$sql = "select photo from table_product where id='".$pid."' ";
	$d->query($sql);
	$row = $d->fetch_array();
	return $row['photo'];
}
function get_product_name($pid){
	global $d, $row,$lang;
	$sql = "select ten_$lang from #_product where id=$pid";
	$d->query($sql);
	$row = $d->fetch_array();
	return $row["ten_$lang"];
	
}
function get_tinh($id){
	global $d, $row,$lang;
	$sql = "select ten_$lang as ten from #_tinh where id='".$id."'";
	$d->query($sql);
	$row = $d->fetch_array();
	return $row['ten'];
}

function get_huyen($id){
	global $d, $row,$lang;
	$sql = "select ten_$lang as ten from #_quan where id='".$id."'";
	$d->query($sql);
	$row = $d->fetch_array();
	return $row['ten'];
}
function get_phuong($id){
	global $d, $row,$lang;
	$sql = "select ten_$lang as ten from #_phuong where id='".$id."'";
	$d->query($sql);
	$row = $d->fetch_array();
	return $row['ten'];
}
function get_product_img($pid){
	global $d, $row;
	$sql = "select photo from #_product where id=$pid";
	$d->query($sql);
	$row = $d->fetch_array();
	return $row['photo'];
}

function get_price($pid){
	global $d, $row;
	$sql = "select giacu,giaban from table_product where id=$pid";
	$d->query($sql);
	$row = $d->fetch_array();
	if($row['giaban']>0){
		
		return ($row['giaban']);
		
	}else{
		
		return ($row['giacu']);
		
	}
	
}
function get_price2($pid){
	global $d, $row;
	$sql = "select giacu,giaban from table_product where id=$pid";
	$d->query($sql);
	$row = $d->fetch_array();
	if($row['giaban']>0){
		return ($row['giaban']);
	}else{
		return $row['giacu'];
	}	
}
function remove_product($pid){
	$pid=intval($pid);
	$max=count($_SESSION['cart']);
	for($i=0;$i<$max;$i++){
		if($pid==$_SESSION['cart'][$i]['productid']){
			unset($_SESSION['cart'][$i]);
			break;
		}
	}
	$_SESSION['cart']=array_values($_SESSION['cart']);
}
function get_order_total(){
	$max=count($_SESSION['cart']);
	$sum=0;
	for($i=0;$i<$max;$i++){
		$pid=$_SESSION['cart'][$i]['productid'];
		$q=$_SESSION['cart'][$i]['qty'];
		
		$price=(get_price($pid));
		
		$sum+=$price*$q;
		
	}
	return $sum;
}

function get_total(){
	$max=count($_SESSION['cart']);
	$sum=0;
	for($i=0;$i<$max;$i++){				
		$sum++;
	}
	return $sum;
}
function addtocart($pid,$q,$size,$mau){
	if($pid<1 or $q<1) return;
	
	if(is_array($_SESSION['cart'])){
		
		$i=product_exists($pid,$size,$mau);
		
		if($i!=-1) {
			$_SESSION['cart'][$i]['qty']=$q+$_SESSION['cart'][$i]['qty'];
			
			return;
		}
		else{ 
			$max=count($_SESSION['cart']);
			$_SESSION['cart'][$max]['productid']=$pid;
			$_SESSION['cart'][$max]['qty']=$q;
			$_SESSION['cart'][$max]['size']=$size;
			$_SESSION['cart'][$max]['mau']=$mau;
		}
	}
	else{
		$_SESSION['cart']=array();
		$_SESSION['cart'][0]['productid']=$pid;
		$_SESSION['cart'][0]['qty']=$q;
		$_SESSION['cart'][0]['size']=$size;
		
	}
}
function product_exists($pid,$size){
	$pid=intval($pid);
	$max=count($_SESSION['cart']);
	$flag=-1;
	
	for($i=0;$i<$max;$i++){
		if($pid==$_SESSION['cart'][$i]['productid']&& $size==$_SESSION['cart'][$i]['size']){
			$flag=$i;
			break;
		}
	}
	return $flag;
}

function update_slmua($pid, $q){
	global $d, $row;
	$sql = "UPDATE #_product SET slmua=slmua+$q  WHERE id=$pid";
	$d->query($sql);
}

?>