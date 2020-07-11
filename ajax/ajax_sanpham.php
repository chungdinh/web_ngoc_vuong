<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE & ~8192);

if(!isset($_SESSION['lang']))
{
	$_SESSION['lang']='vi';
}
$lang=$_SESSION['lang'];

@define ( '_lib' , '../libraries/');
@define ( '_source' , '../sources/');

include_once _lib."config.php";
include_once _lib."constant.php";;
include_once _lib."functions.php";
include_once _lib."functions_giohang.php";
include_once _lib."class.database.php";
include_once _source."lang_$lang.php";

$d = new database($config['database']);

?>
<?php
$id = $_GET['id'];
$d->reset();
$sql="SELECT tenkhongdau,id,ten_$lang,mota_$lang,giaban,masp,photo,thumb,tags FROM #_product WHERE id = ".$id." and hienthi = 1";
$d->query($sql);
$sp = $d->fetch_array();

$d->reset();
$sql="SELECT ten_$lang FROM #_tags WHERE id = ".$sp['tags']." order by id desc";
$d->query($sql);
$option_sp = $d->fetch_array();
?>
<div class="box_quickview">
	<div class="quickview_top">
		<div class="row">
			<div class="col-4">
				<div class="quickview_img">
					<div class="_option">
						<?=$option_sp['ten_'.$lang.'']?>
					</div>
					<a href="san-pham/<?=$sp['tenkhongdau']?>-<?=$sp['id']?>.html" title="<?=$sp['ten_'.$lang.'']?>">
						<img class="w_100" src="thumb/300x320/2/<?=_upload_product_l.$sp['photo']?>" alt="<?=$sp['ten_'.$lang.'']?>">
					</a>
				</div>
			</div>
			<div class="col-8">
				<div class="quickview_content">
					<h4 class="quickview_tensp">
						<a href="san-pham/<?=$sp['tenkhongdau']?>-<?=$sp['id']?>.html" title="<?=$sp['ten_'.$lang.'']?>">
							<?=$sp['ten_'.$lang.'']?>
						</a>
					</h4>
					<p class="quickview_masp">
						<?=$sp['masp']?>
					</p>
					<div class="quickview_summary">
						<?=$sp['mota_'.$lang.'']?>
					</div>
					<p class="text-right">
						<ins><a href="san-pham/<?=$sp['tenkhongdau']?>-<?=$sp['id']?>.html" title="<?=_chitiet.' '.$sp['ten_'.$lang.'']?>">Chi tiết sản phẩm</a>
						</ins>
					</p>
				</div>
			</div>
		</div>
	</div>
	<div class="quickview_bottom">
		<div class="group_add_to_cart flex flex_j">
			<div>
				
			</div>
			<div class="quickview_price">
				<?=/*format_money($sp['giaban'],' VND',' Liên hệ');*/ number_format($sp['giaban'],0, ',', '.') ?> VND
			</div>
			<div>
				<label class="label_qty">Số lượng</label>
				<input type="number" min='1' name="_qty" class="_qty" value="1">
				<div class="add-to-cart" data-id="<?=$sp['id']?>">
					Thêm vào giỏ hàng
				</div>
			</div>
		</div>
	</div>
</div>