<?php /*
$range = array('Đá Gạch - Đá Cây','Đá cắt theo yêu cầu','Đá ốp tường','Đá mỹ nghệ','Đá lát sân - vỉa hè','Đá lát sân vườn','ĐÁ MARBLE','Đá hoa cương');
$range2 = range('1','4');
foreach ($range as $key => $value) {
	$data['ten_vi'] = mb_strtolower($value,'UTF-8');
	$data['ten_en'] = mb_strtolower($value.'-E','UTF-8');
	// $data['name_en'] = $value;
	// $data['name_vi'] = $value;
	$data['ngaytao'] = time();
	$data['ngaysua'] = time();
	$data['tenkhongdau'] = changeTitle($data['ten_vi']);
	$data['type'] = 'product';
	//$data['id_linhvuc'] = 0;
	$data['hienthi'] = 1;
	$data['stt'] = $key + 1;
	$d->setTable("product_list");
	if($d->insert($data)){
		$idl = mysql_insert_id();
		foreach ($range2 as $key2 => $value2) {
			$data1['ten_vi'] = mb_strtolower($value.'-'.$value2,'UTF-8');
			$data1['ten_en'] = mb_strtolower($value.'-'.$value2.'-E','UTF-8');
			$data1['tenkhongdau'] = changeTitle($data1['ten_vi']);
			$data1['type'] = 'product';
			$data1['id_list'] = $idl;
			$data1['hienthi'] = 1;
			//$data1['id_linhvuc'] = 0;
			$data1['stt'] = $key2 + 1;
			$d->setTable("product_cat");
			if($d->insert($data1)){
				$idc = mysql_insert_id();
				foreach ($range2 as $key3 => $value3) {
					$data2['ten_vi'] = $value.'-'.$value2.'-'.$value3;
					$data2['ten_en'] = $value.'-'.$value2.'-'.$value3.'-E';
					$data2['tenkhongdau'] = changeTitle($data2['ten_vi']);
					$data2['type'] = 'product';
					$data2['id_list'] = $idl;
					$data2['id_cat'] = $idc;
					$data2['hienthi'] = 1;
					$data2['id_linhvuc'] = 1;
					$data2['stt'] = $key3 + 1;
					$d->setTable("product_item");
					if($d->insert($data2)){
						
						$idi = mysql_insert_id();
						foreach ($range2 as $key4 => $value4) {
							$data3['ten_vi'] = $value.'-'.$value2.'-'.$value3.'-'.$value4;
							$data3['ten_en'] = $value.'-'.$value2.'-'.$value3.'-'.$value4.'-E';
							$data3['type'] = 'linhvuc';
							$data3['tenkhongdau'] = changeTitle($data3['ten_vi']);
							$data3['id_list'] = $idl;
							$data3['id_cat'] = $idc;
							$data3['id_item'] = $idi;
							$data3['hienthi'] = 1;
							$data3['id_linhvuc'] = 1;
							$data3['stt'] = $key4 + 1;
							$d->setTable("product_sub");
							$d->insert($data3);
						}
						
					}
				}
				
			}
		}
	}
}*/
/*
foreach (range(1,52) as $key => $value) {
	for ($i=0; $i < 5; $i++) { 
		$data4['id_product'] = $value;
		$data4['type'] = 'product';
		$data4['stt'] = $value;
		$data4['hienthi'] = 1;
		$data4['photo'] = 'gallery-'.$i.'.jpg';
		$data4['thumb'] = 'gallery-'.$i.'.jpg';
		$data4['ngaytao'] = time();
		$data4['ngaysua'] = time();
		$d->setTable("product_photo");
		$d->insert($data4);
	}
}
/*
foreach (range(1,10) as $key => $value) {
	$data['ten'] = 'Diện tích '.$value;
	$data['type'] = 'dientich';
	$data['hienthi'] = 1;
	$data['ngaytao'] = time();
	$data['ngaysua'] = time();
	$d->setTable('option');
	$d->insert($data);
}
header('Location:http://localhost:81/bdshungphat_19_07_2018/admin/index.php?com=option&act=man&type=dientich');