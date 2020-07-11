<!--START MENU MOBILE -->
<link type="text/css" rel="stylesheet" href="bonus/mmenu/jquery.mmenu.all.css" />
<script type="text/javascript" src="bonus/mmenu/jquery.mmenu.min.all.js"></script>
<script type="text/javascript">
$(function() {
    $('nav#menu').mmenu({
        extensions: ['effect-slide-menu', 'pageshadow'],
        searchfield: false,
        counters: true,
        navbar: {},
    });
});
</script>
<div class="menu_responsive">
    <div class="menuResponsive-box">
        <div class="menuResponsive-show">
            <div class="menuResponsive-icon">
                <a class="fa fa-bars" aria-hidden="true" href="#menu"> </a>
                <span>Menu</span>
            </div>
            <div class="box_search" style="display:block !important;">
                <form action="" method="get" name="frm_search_rp" id="frm_search_rp" onsubmit="return false;">
                    <input type="text" id="search_input" name="keyword_rp" onkeypress="doEnter_rp(event)" value="Nhập từ khóa..." onblur="if(this.value=='') this.value='Nhập từ khóa...'" onfocus="if(this.value =='Nhập từ khóa...') this.value=''" />
                    <div class="img_search">
                        <a href="javascript:void(0);" id="tnSearch_rp" name="searchAct">
                            <img src="thumb/20x20/1/images/icon-search.png" name="searchAct" alt="Nhập từ khóa..." id="tnSearch_rp" onerror="this.src='thumb/20x20/1/images/noimg.jpg';" /></a>
                    </div>
                    <!--end img_search-->
                </form>
                <script type="text/javascript">
                $(function() {
                    $('#tnSearch_rp').click(function(evt) {
                        onSearch_rp(evt);
                    });
                });

                function onSearch_rp(evt) {
                    var keyword_rp = document.frm_search_rp.keyword_rp;
                    if (keyword_rp.value == '' || keyword_rp.value === 'Nhập từ khóa...') {
                        alert('Bạn chưa nhập từ khóa');
                        keyword_rp.focus();
                        return false;
                    }
                    location.href = 'tim-kiem.html&keywords=' + keyword_rp.value;
                }

                function doEnter_rp(evt) {
                    // IE         // Netscape/Firefox/Opera
                    var key;
                    if (evt.keyCode == 13 || evt.which == 13) {
                        onSearch_rp(evt);
                    } else {
                        return false;
                    }
                }
                </script>
            </div>
            <!--end box_search-->
        </div>
        <nav id="menu">
            <ul class="main-menu-m">
                <li> <a href="<?php echo $url_web ?>" title="Trang Chủ">Trang Chủ</a> </li>
                <li> <a href="gioi-thieu.html" title="Giới Thiệu">Giới Thiệu</a> </li>
                <li> <a href="san-pham.html" title="Sản Phẩm"><i class="fa fa-bars" aria-hidden="true"></i>
                        Sản Phẩm</a>
                    <?php if (!empty($array_show)): ?>
                    <ul>
                        <?php foreach ($array_show as $key_list => $value_list): ?>
                        <li><a href="<?php echo $value_list['link'] ?>" title="<?php echo $value_list['ten'] ?>">
                                <?php echo $value_list['ten'] ?> </a>
                            <?php if (!empty($value_list['cat'])): ?>
                            <ul>
                                <?php foreach ($value_list['cat'] as $key_cat => $value_cat): ?>
                                <li>
                                    <a href="<?php echo $value_cat['link'] ?>" title="<?php echo $value_cat['ten'] ?>">
                                        <?php echo $value_cat['ten'] ?>
                                    </a>
                                    <?php if (!empty($value_cat['item'])): ?>
                                    <ul>
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
                <li> <a href="dich-vu.html" title="Dịch Vụ">Dịch Vụ</a> </li>
                <li> <a href="giai-phap.html" title="Giải Pháp">Giải Pháp</a> </li>
                <li> <a href="tin-tuc.html" title="Tin Tức">Tin Tức</a> </li>
                <li> <a href="lien-he.html" title="Liên Hệ">Liên Hệ</a> </li>
            </ul>
        </nav>
    </div>
</div>
<!--end menu_responsive-->
<!--END MENU MOBILE -->