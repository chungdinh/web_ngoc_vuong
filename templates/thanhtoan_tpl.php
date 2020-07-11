<script type="text/javascript">
function check() {
    var frm = document.frm_order;

    if (frm.ten.value == '') {
        alert("<?=_nameError?>");
        frm.ten.focus();
        return false;
    }
    if (frm.dienthoai.value == '') {
        alert("<?=_phoneError?>");
        frm.dienthoai.focus();
        return false;
    }
    if (frm.diachi.value == '') {
        alert("<?=_addressError?>");
        frm.diachi.focus();
        return false;
    }

    if (frm.email.value == '') {
        alert("<?=_emailError?>");
        frm.email.focus();
        return false;
    }
    if (!validEmail(frm.email)) {
        alert('<?=_emailError1?>');
        frm.email.focus();
        return false;
    }


    frm.submit();
}

function validEmail(obj) {
    var s = obj.value;
    for (var i = 0; i < s.length; i++)
        if (s.charAt(i) == " ") {
            return false;
        }
    var elem, elem1;
    elem = s.split("@");
    if (elem.length != 2) return false;

    if (elem[0].length == 0 || elem[1].length == 0) return false;

    if (elem[1].indexOf(".") == -1) return false;

    elem1 = elem[1].split(".");
    for (var i = 0; i < elem1.length; i++)
        if (elem1[i].length == 0) return false;
    return true;
} //Kiem tra dang email
function IsNumeric(sText) {
    var ValidChars = "0123456789";
    var IsNumber = true;
    var Char;

    for (i = 0; i < sText.length && IsNumber == true; i++) {
        Char = sText.charAt(i);
        if (ValidChars.indexOf(Char) == -1) {
            IsNumber = false;
        }
    }
    return IsNumber;
} //Kiem tra dang so
</script>
<script language='javascript'>
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
</script>
<script type="text/javascript">
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
<div id="thanhtoan" class="inBody" style="<?= $bg_pagein?>">
    <div class="container">
        <div class="container-thanhtoan">
            <div class="pagein-title">
                <?=' <span>'.$title_detail_frq.'</span>'?>
                <i class="fa fa-gg" aria-hidden="true"></i>
            </div>
            <!--END title_index-->
            <div class="thanhtoan-box flexbox">
                <div class="thanhtoan-text">
                    <div class="thanhtoan-text-title">
                        <h4>Thông tin giao hàng</h4>
                    </div>
                    <form method="post" name="frm_order" action="" enctype="multipart/form-data" onsubmit="return check();" class="frm_order">
                        <div class="thanhtoan-form">
                            <div>
                                <span>Họ Tên:</span>
                                <input name="ten" id="ten" class="form-control" value="<?= $_SESSION['login_member']['hoten'] ?>" />
                            </div>
                            <div>
                                <span>Điện Thoại:</span>
                                <input name="dienthoai" id="dienthoai" class="form-control" value="<?= $_SESSION['login_member']['dienthoai'] ?>" onKeyPress="return isNumberKey(event)" />
                            </div>
                            <div>
                                <span>Địa Chỉ:</span>
                                <input name="diachi" id="diachi" class="form-control" value="<?= $_SESSION['login_member']['diachi'] ?>" />
                            </div>
                            <div>
                                <span>Email:</span>
                                <input name="email" id="email" class="form-control" value="<?= $_SESSION['login_member']['email'] ?>" />
                            </div>
                            <div>
                                <span>Nội Dung:</span>
                                <textarea name="noidung" class="form-control"></textarea>
                            </div>
                        </div>
                        <div>
                            <input title='Làm Lại' class="button" type="reset" name="next" value="Làm Lại" style="cursor:pointer;" />
                            <input title='Gửi' class="button" type="submit" name="next" value="Gửi" style="cursor:pointer;" />
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </div>
                <div class="thanhtoan-info">
                    <?
                    if(is_array($_SESSION['cart'])){
                        $max=count($_SESSION['cart']);
                        for($i=0;$i<$max;$i++){
                            $pid=$_SESSION['cart'][$i]['productid'];
                            $q=$_SESSION['cart'][$i]['qty'];            
                            $pname=get_product_name($pid,$lang);
                            $pimg=get_product_img($pid);
                            $d->reset();
                            $sql_news = "select id,ten_vi from #_product where hienthi=1 and id='".$pid."' and type='product'";
                            $d->query($sql_news);
                            $pro_gh = $d->fetch_array();
                            if($q==0) continue;
                            ?>
                    <div class="thanhtoan-item">
                        <div class="inThanhtoan-img">
                            <img src="thumb/100x100/2/<?=_upload_product_l.$pimg?>" alt="<?=$pname?>" />
                            <span>
                                <?=$q?>
                            </span>
                        </div>
                        <div class="inThanhtoan-text">
                            <div class="inThanhtoan-name">
                                <b>
                                    <?=$pname?>
                                </b>
                            </div>
                            <div class="inThanhtoan-price">
                                <strong>
                                    <?=number_format((get_price($pid)*$q),0, ',', '.') ?> đ
                                </strong>
                            </div>
                        </div>
                    </div>
                    <?php } } ?>
                    <div class="inThanhtoan-tong">
                        <span>Tổng cộng:</span>
                        <b>
                            <?=number_format(get_order_total(),0, ',', '.').' đ'?>
                        </b>
                    </div>
                </div>
            </div>
        </div>
        <!--end left_formtt-->
        <div class="clearfix"></div>
    </div>
</div>
</div>
<!--end main_content_web-->