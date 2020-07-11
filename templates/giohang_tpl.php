<?php

if(@$_REQUEST['command']=='delete' && $_REQUEST['pid']>0){
	remove_product($_REQUEST['pid']);
}
else if(@$_REQUEST['command']=='clear'){
	unset($_SESSION['cart']);
}
else if(@$_REQUEST['command']=='update'){
	$max=count($_SESSION['cart']);
	for($i=0;$i<$max;$i++){
		$pid=$_SESSION['cart'][$i]['productid'];
		$q=intval($_REQUEST['product'.$pid]);
		if($q>0 && $q<=999){
			$_SESSION['cart'][$i]['qty']=$q;
		}
		else{
			$msg='Some proudcts not updated!, quantity must be a number between 1 and 999';
		}
	}
}

?>
<script type="text/javascript">
function del(pid) {
    if (confirm('Do you really mean to delete this item')) {
        document.form2.pid.value = pid;
        document.form2.command.value = 'delete';
        document.form2.submit();
    }
}

function clear_cart() {
    if (confirm('This will empty your shopping cart, continue?')) {
        document.form2.command.value = 'clear';
        document.form2.submit();
    }
}

function update_cart() {
    document.form2.command.value = 'update';
    document.form2.submit();
}

$(document).ready(function() {
    $('.soluong').change(function() {
        $('#loadding').fadeIn(400);
        var slg = $(this).val();
        var id = $(this).attr('rel');
        var vitri = $(this).attr('rev');
        $.ajax({
            url: 'ajax/soluong.php',
            type: "POST",
            dataType: "json",
            data: { id: id, sl: slg, vitri: vitri },
            success: function(res) {
                $('.result_gia[data-info=' + id + ']').html(res.gia);
                $('.tongdonhang').html(res.tonggia);
                $('#loadding').fadeOut(400);
            }
        });
    })
})
</script>
<div class="inBody" id="giohang">
    <div class="container">
        <div class="container-giohang">
            <div class="pagein-title">
                <?=' <span>'.$title_detail_frq.'</span>'?>
                <i class="fa fa-gg" aria-hidden="true"></i>
            </div>
            <!--END title_index-->
            <div class="giohang-box">
                <form name="form2" method="post">
                    <input type="hidden" name="pid" />
                    <input type="hidden" name="command" />
                    <table border="0" cellpadding="5px" cellspacing="1px" style="font-family:main; font-size: 11px;" width="100%">
                        <?
						if(!empty($_SESSION['cart'])){
							echo '<tr class="giohang-table-top" >
							<td>STT</td>
							<td>Tên Sản Phẩm</td>
							<td>Hình Ảnh</td>
							<td>Giá</td>
							<td>Số Lượng</td>
							<td>Thành Tiền</td>
							<td>Xóa</td>				
							</tr>';
							$max=count($_SESSION['cart']);
							for($i=0;$i<$max;$i++){								
								$pid=$_SESSION['cart'][$i]['productid'];
								$q=$_SESSION['cart'][$i]['qty'];				
								$pname=get_product_name($pid,$lang);
								$pimg=get_product_img($pid);
								$mau=$_SESSION['cart'][$i]['mau'];	
								$size=$_SESSION['cart'][$i]['size'];	
								$d->reset();
								$sql_news = "select id,ten_vi from #_product where hienthi=1 and id='".$pid."' and type='product'";
								$d->query($sql_news);
								$pro_gh = $d->fetch_array();
								if($q==0) continue;
								?>
                        <tr class="giohang-table-mid">
                            <td>
                                <?=$i+1?>
                            </td>
                            <td>
                                <?=$pname?>
                            </td>
                            <td>
                                <img src="<?=_upload_product_l.$pimg?>" alt="image" />
                            </td>
                            <td>
                                <?=number_format(get_price2($pid),0, ',', '.')?>&nbsp;đ
                            </td>
                            <td>
                                <input type="text" name="product<?=$pid?>" class="soluong" value="<?=$q?>" rel="<?=$pid?>" rev='<?=$i?>' maxlength="3" size="2" style="text-align:center; border:1px solid #F0F0F0" />
                                &nbsp;
                            </td>
                            <td>
                                <span class="result_gia" data-info='<?=$pid?>'>
                                    <?=number_format((get_price($pid)*$q),0, ',', '.') ?> đ
                                </span>
                            </td>
                            <td>
                                <a href="javascript:del(<?=$pid?>)">
                                    <img src="thumb/20x20/2/images/delete.png" />
                                </a>
                            </td>
                        </tr>
                        <?					
							}
							?>
                        <tr class="giohang-table-bot">
                            <td colspan="10" style="background:#E6E6E6; padding: 10px 10px; color: #666;font-size:15px;">
                                <b>Tổng đơn hàng:
                                    <span style="color: #F00;" class="tongdonhang">
                                        <?=number_format(get_order_total(),0, ',', '.').' đ'?></span>
                                </b>
                            </td>
                        </tr>
                        <tr class="giohang-btn">
                            <td colspan="10" align="right" class="right">
                                <input type="button" value="Tiếp tục" onclick="window.location='san-pham.html'">
                                <?php
								if(!empty($_SESSION['cart']) and count($_SESSION['cart'])>0){
									?>
                                <input type="button" value="Xóa Tất Cả" onclick="clear_cart()">
                                <input type="button" value="Cập Nhật" onclick="update_cart()">
                                <input type="button" value="Đặt Mua" onclick="window.location='thanh-toan.html'">
                                <?php
								}
								?>
                            </td>
                        </tr>
                        <?
					}
					else{
						echo "<tr><td>Bạn Chưa có sản phẩm nào trong giỏ hàng</td></tr>";
					}
					?>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end main_content_web-->