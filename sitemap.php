<?php 
session_start();
@define ( '_lib' , './libraries/');
include_once _lib."config.php";
@define ( '_source' , './sources/');
include_once _lib."class.database.php";
$d = new database($config['database']);
header("Content-Type: application/xml; charset=utf-8"); 
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
function get_com_by_type($type){
    $string_com="";
    switch ($type) {
        case 'gioithieu':
        $string_com="gioi-thieu";
        break;
        case 'product':
        $string_com="san-pham";
        break;
        case 'spkhac':
        $string_com="san-pham-khac";
        break;
        case 'dichvu':
        $string_com="dich-vu";
        break;
        case 'tintuc':
        $string_com="tin-tuc";
        break;
        case 'tuyendung':
        $string_com="tuyen-dung";
        break;
        case 'chinhsach':
        $string_com="chinh-sach";
        break;
        case 'lienhe':
        $string_com="lien-he";
        break;
        default:
        $string_com=false;
        break;
    }
    return $string_com;
}
echo $config['url'];
function urlElement($url, $pri) {
    global $config;
    echo '<url>';
    echo '<loc>'.$config['url'].'/'.$url.'</loc>';
    echo '<priority>'.$pri.'</priority>';
    echo '</url>';
}
urlElement('','1.0');
urlElement('gioi-thieu.html','0.8');
urlElement('san-pham.html','0.8');
urlElement('san-pham-khac.html','0.8');
urlElement('dich-vu.html','0.8');
urlElement('tin-tuc.html','0.8');
urlElement('tuyen-dung.html','0.8');
urlElement('chinh-sach.html','0.8');
urlElement('lien-he.html','0.8');
$d->reset();
$sql="select DISTINCT type from #_product_list";
$d->query($sql);
$type_product_list=$d->result_array();
    ///////////Danh mục cấp 1//////////////////////
for ($i=0; $i <count($type_product_list) ; $i++) { 
    $d->reset();
    $sql = "select id,ten_vi as ten,tenkhongdau,type from #_product_list where hienthi=1 and type='".$type_product_list[$i]['type']."' order by stt asc";
    $d->query($sql);
    $product_list_left = $d->result_array();
    foreach($product_list_left as $v){
        urlElement(get_com_by_type($v['type'])."/".$v['tenkhongdau']."-".$v['id'],'0.8');
    }
}
$d->reset();
$sql="select DISTINCT type from #_product_cat";
$d->query($sql);
$type_product_cat=$d->result_array();
        ///////////Danh mục cấp 2//////////////////////
for ($i=0; $i <count($type_product_list) ; $i++) { 
    $d->reset();
    $sql = "select id,ten_vi as ten,tenkhongdau,id_list,type from #_product_cat where hienthi=1 and type='".$type_product_cat[$i]['type']."' order by stt asc";
    $d->query($sql);
    $product_cat_left = $d->result_array();
    foreach($product_cat_left as $v){
        urlElement(get_com_by_type($v['type'])."/".$v['tenkhongdau']."-".$v['id'],'0.8');
    }
}
$d->reset();
$sql="select DISTINCT type from #_product";
$d->query($sql);
$type_product=$d->result_array();
            ///////////Sản phẩm//////////////////////
for ($i=0; $i <count($type_product) ; $i++) { 
    $d->reset();
    $sql = "select id,ten_vi as ten,tenkhongdau,type from #_product where hienthi=1 and type='".$type_product[$i]['type']."' order by stt asc";
    $d->query($sql);
    $product = $d->result_array();
    foreach($product as $v){
        urlElement(get_com_by_type($v['type'])."/".$v['tenkhongdau']."-".$v['id'].'.html','0.8');
    }
}
$d->reset();
$sql="select DISTINCT type from #_baiviet";
$d->query($sql);
$type_baiviet=$d->result_array();
for ($i=0; $i <count($type_baiviet) ; $i++) { 
    if(get_com_by_type($type_baiviet[$i]['type'])){ 
        $d->reset();
        $sql = "select id,ten_vi as ten,tenkhongdau,type from #_baiviet where type='".$type_baiviet[$i]['type']."' and hienthi=1 order by stt asc";
        $d->query($sql);
        $baiviet = $d->result_array();
        foreach($baiviet as $v){
            urlElement(get_com_by_type($v['type'])."/".$v['tenkhongdau']."-".$v['id'].".html",'0.8');
        }
    }
}
echo '</urlset>';
?>