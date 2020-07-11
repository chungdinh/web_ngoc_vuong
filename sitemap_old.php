<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<?php
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , './libraries/');

	if(!isset($_SESSION['lang']))
	{
	$_SESSION['lang']='vi';
	}
	$lang=$_SESSION['lang'];
	
	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."class.database.php";
	include_once _lib."file_requick.php";
	

$header_xml = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n<urlset xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\" xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">

";
$footer_xml = "</urlset>";
$file_topic = fopen("sitemap.xml", "w+");
fwrite($file_topic, $header_xml);

fwrite($file_topic, "<url><loc>".$url_web."</loc><lastmod>".date('c')."</lastmod><priority>0.1</priority></url>");
fwrite($file_topic, "<url><loc>".$url_web."/index.html</loc><lastmod>".date('c')."</lastmod><priority>0.1</priority></url>");
fwrite($file_topic, "<url><loc>".$url_web."/gioi-thieu.html</loc><lastmod>".date('c')."</lastmod><priority>0.1</priority></url>");
fwrite($file_topic, "<url><loc>".$url_web."/cong-trinh.html</loc><lastmod>".date('c')."</lastmod><priority>0.1</priority></url>");
fwrite($file_topic, "<url><loc>".$url_web."/bang-gia.html</loc><lastmod>".date('c')."</lastmod><priority>0.1</priority></url>");
fwrite($file_topic, "<url><loc>".$url_web."/tuyen-dai-ly.html</loc><lastmod>".date('c')."</lastmod><priority>0.1</priority></url>");
fwrite($file_topic, "<url><loc>".$url_web."/san-pham.html</loc><lastmod>".date('c')."</lastmod><priority>0.1</priority></url>");
fwrite($file_topic, "<url><loc>".$url_web."/tin-tuc.html</loc><lastmod>".date('c')."</lastmod><priority>0.1</priority></url>");
fwrite($file_topic, "<url><loc>".$url_web."/lien-he.html</loc><lastmod>".date('c')."</lastmod><priority>0.1</priority></url>");
fwrite($file_topic, "<url><loc>".$url_web."/tags.html</loc><lastmod>".date('c')."</lastmod><priority>0.1</priority></url>");
foreach(_result_array("SELECT tenkhongdau,ngaytao,id FROM table_baiviet WHERE type like 'tintuc'") as $value){
fwrite($file_topic, "<url><loc>".$url_web."/tin-tuc/".$value['tenkhongdau']."-".$value['id'].".html</loc><lastmod>".date('c',$value['ngaytao'])."</lastmod><priority>1</priority></url>");
} 
foreach(_result_array("SELECT tenkhongdau,ngaytao,id FROM table_product WHERE type like 'product'") as $value){
fwrite($file_topic, "<url><loc>".$url_web."/san-pham/".$value['tenkhongdau']."-".$value['id'].".html</loc><lastmod>".date('c',$value['ngaytao'])."</lastmod><priority>1</priority></url>");
}
foreach(_result_array("SELECT tenkhongdau,ngaytao,id FROM table_baiviet WHERE type like 'tuyendaily'") as $value){
fwrite($file_topic, "<url><loc>".$url_web."/tuyen-dai-ly/".$value['tenkhongdau']."-".$value['id'].".html</loc><lastmod>".date('c',$value['ngaytao'])."</lastmod><priority>1</priority></url>");
}
foreach(_result_array("SELECT tenkhongdau,ngaytao,id FROM table_baiviet WHERE type like 'congtrinh'") as $value){
fwrite($file_topic, "<url><loc>".$url_web."/cong-trinh/".$value['tenkhongdau']."-".$value['id'].".html</loc><lastmod>".date('c',$value['ngaytao'])."</lastmod><priority>1</priority></url>");
}
foreach(_result_array("SELECT tenkhongdau,ngaytao,id FROM table_tags WHERE type like 'product'") as $value){
fwrite($file_topic, "<url><loc>".$url_web."/tags/".$value['tenkhongdau']."-".$value['id']."</loc><lastmod>".date('c',$value['ngaytao'])."</lastmod><priority>1</priority></url>");
}
foreach(_result_array("SELECT tenkhongdau,ngaytao,id FROM table_product_list") as $value){
fwrite($file_topic, "<url><loc>".$url_web."/san-pham/".$value['tenkhongdau']."-".$value['id']."</loc><lastmod>".date('c',$value['ngaytao'])."</lastmod><priority>1</priority></url>");
foreach (_result_array("SELECT tenkhongdau,ngaytao,id FROM table_product_cat WHERE id_list='".$value['id']."'") as $value2) {
fwrite($file_topic, "<url><loc>".$url_web."/san-pham/".$value['tenkhongdau']."/".$value2['tenkhongdau']."-".$value2['id']."</loc><lastmod>".date('c',$value2['ngaytao'])."</lastmod><priority>1</priority></url>");

}
}
fwrite($file_topic, $footer_xml);
fclose($file_topic);

transfer("Đã tạo xong sitemap ! ", "sitemap.xml");


?>