 <!-- begin menu -->
<?php 
$product_list = _result_array("SELECT ten_$lang as ten,tenkhongdau,id,photo FROM table_product_list WHERE type like 'product' AND hienthi = 1 ORDER BY stt ASC");
$array_show = array();
foreach ($product_list as $key_list => $value_list) {
    $product_cat = _result_array("SELECT ten_$lang as ten,tenkhongdau,id FROM table_product_cat WHERE type like 'product' AND hienthi = 1 AND id_list='".$value_list['id']."' ORDER BY stt ASC");
    $array_show[$key_list]['id'] = $value_list['id'];
    $array_show[$key_list]['ten'] = $value_list['ten'];
    $array_show[$key_list]['photo'] = $value_list['photo'];
    $array_show[$key_list]['link'] = 'san-pham/'.$value_list['tenkhongdau'].'-'.$value_list['id'];
    foreach ($product_cat as $key_cat => $value_cat) {
        $product_item = _result_array("SELECT ten_$lang as ten,tenkhongdau,id FROM table_product_item WHERE type like 'product' AND hienthi = 1 AND id_cat='".$value_cat['id']."' ORDER BY stt ASC");
        $array_show[$key_list]['cat'][$key_cat]['ten'] = $value_cat['ten'];
        $array_show[$key_list]['cat'][$key_cat]['id'] = $value_cat['id'];
        $array_show[$key_list]['cat'][$key_cat]['link'] = 'san-pham/'.$value_list['tenkhongdau'].'/'.$value_cat['tenkhongdau'].'-'.$value_cat['id'];
        foreach ($product_item as $key_item => $value_item) {
            $array_show[$key_list]['cat'][$key_cat]['item'][$key_item]['ten'] = $value_item['ten'];
            $array_show[$key_list]['cat'][$key_cat]['item'][$key_item]['id'] = $value_item['id'];
            $array_show[$key_list]['cat'][$key_cat]['item'][$key_item]['link'] = 'san-pham/'.$value_list['tenkhongdau'].'/'.$value_cat['tenkhongdau'].'/'.$value_item['tenkhongdau'].'-'.$value_item['id'];
        }
    }
}
?>
<section id="block-menu">
    <div class="container">
        <nav>
            <ul class="main-menu flexbox">
                 <li class="menu-sanpham"<?php if ($com=='san-pham'){ echo 'class="active"' ;}?>> <a href="san-pham.html" title="Sản Phẩm"><i class="fa fa-bars" aria-hidden="true"></i>
                 Danh Mục Sản Phẩm</a>
                    <?php if (!empty($array_show)): ?>
                        <ul class="menu-list">
                            <?php foreach ($array_show as $key_list => $value_list): ?>
                                <li><a href="<?php echo $value_list['link'] ?>" title="<?php echo $value_list['ten'] ?>"> <?php echo $value_list['ten'] ?> </a>
                                    <?php if (!empty($value_list['cat'])): ?>
                                        <ul class="menu-cat">
                                            <?php foreach ($value_list['cat'] as $key_cat => $value_cat): ?>
                                                <li>
                                                    <a href="<?php echo $value_cat['link'] ?>" title="<?php echo $value_cat['ten'] ?>">
                                                        <?php echo $value_cat['ten'] ?>
                                                    </a>
                                                    <?php if (!empty($value_cat['item'])): ?>
                                                        <ul class="menu-item">
                                                            <?php foreach ($value_cat['item'] as $key_item => $value_item): ?>
                                                                <li>
                                                                    <a href="<?php echo $value_item['link'] ?>" title="<?php echo $value_item['ten'] ?>">
                                                                        <?php echo $value_item['ten'] ?>
                                                                    </a>
                                                                </li>
                                                            <?php endforeach ?>
                                                        </ul>
                                                    <?php endif ?>
                                                </li>
                                            <?php endforeach ?>
                                        </ul>
                                    <?php endif ?>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    <?php endif ?>
                </li>
                <li id="home" <?php if($template=='index'){echo'class="active"';} ?>> <a href="<?php echo $url_web ?>" title="Trang Chủ">Trang Chủ</a> </li>
                <li <?php if($com=='gioi-thieu'){echo'class="active"' ;}?>> <a href="gioi-thieu.html" title="Giới Thiệu">Giới Thiệu</a> </li>
                <li <?php if($com=='dich-vu'){echo'class="active"';}?>> <a href="dich-vu.html" title="Dịch Vụ">Dịch Vụ</a> 
                <?php echo level_1('baiviet','dich-vu','dichvu','menu-list') ?>
                </li>
                <li <?php if($com=='giai-phap'){echo'class="active"';}?>> <a href="giai-phap.html" title="Giải Pháp">Giải Pháp</a> 
                 <?php echo level_2('baiviet_list','baiviet_cat','giai-phap','giaiphap','menu-list','menu-cat') ?></li>
                <li <?php if($com=='tin-tuc'){echo'class="active"';}?>> <a href="tin-tuc.html" title="Tin Tức">Tin Tức</a> </li>
                <li <?php if($com=='lien-he'){echo'class="active"';}?>> <a href="lien-he.html" title="Liên Hệ">Liên Hệ</a> </li>
                
            </ul>
        </nav>
    </div>
</section>
<script type="text/javascript">
    $(window).scroll(function() {
        widthbody = $('body').width();
        if (widthbody > 768) {
            if ($(window).scrollTop() >= $("#block-header").height()) {
                $("#block-menu").addClass('menu-fixed');
            } else {
                $("#block-menu").removeClass('menu-fixed');
            }
        }else{
            $(".header-bot").removeClass('menu-fixed  ');
        }
    });
</script>
 <!-- end menu -->