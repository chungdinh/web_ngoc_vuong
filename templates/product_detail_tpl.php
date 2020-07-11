<link href="css/magiczoomplus/magiczoomplus.css" rel="stylesheet" type="text/css" media="screen" />
<script src="js/magiczoomplus/magiczoomplus.js" type="text/javascript"></script>
<section class="inBody" id="inProduct" style="<?= $bg_pagein?>">
    <div class=" container">
        <?php //echo $breadcrumb; ?>
        <div class="container-inProduct">
            <div class="inSanpham-box flexbox">
                <div class="inSanpham-col">
                    <div class="product_gallery">
                        <div class="large_img">
                            <a class="MagicZoom" id="Zoom-1" title="<?php echo $row_detail['ten_'.$lang.'']?>" href="thumb/875x820/2/<?php echo _upload_product_l.$row_detail['photo']?>">
                                <img class="img-center" src="thumb/875x820/2/<?php echo _upload_product_l.$row_detail['photo']?>" alt="<?php echo $row_detail['ten_'.$lang.'']?>">
                            </a>
                        </div>
                        <?php if(count($hinhanh) > 0){ ?>
                        <div class="gallery">
                            <div id="slick-gallery" class="opacity">
                                <div class="item-gallery">
                                    <a data-zoom-id="Zoom-1" data-image="thumb/875x820/2/<?php echo _upload_product_l.$row_detail['photo']?>" title="<?php echo $row_detail['ten_'.$lang.'']?>" href="thumb/875x820/2/<?php echo _upload_product_l.$row_detail['photo']?>">
                                        <img class="img-center" src="thumb/88x78/2/<?php echo _upload_product_l.$row_detail['photo']?>" alt="<?php echo $row_detail['ten_'.$lang.'']?>">
                                    </a>
                                </div>
                                <?php foreach ($hinhanh as $key => $value) { ?>
                                <div class="item-gallery">
                                    <a data-zoom-id="Zoom-1" data-image="thumb/875x820/2/<?php echo _upload_product_l.$value['photo']?>" title="<?php echo $row_detail['ten_'.$lang.'']?>" href="thumb/875x820/2/<?php echo _upload_product_l.$value['photo']?>">
                                        <img class="img-center" src="thumb/88x78/2/<?php echo _upload_product_l.$value['photo']?>" alt="<?php echo $row_detail['ten_'.$lang.'']?>">
                                    </a>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="inSanpham-col">
                    <ul class="product-detail">
                        <li class="inPro-ten">
                            <h1>
                                <?php echo $row_detail['ten_'.$lang.'']?>
                            </h1>
                        </li>
                        <?php if ($$row_detail['masp']){ ?>
                        <li class="inPro-masp">
                            <b>Mã Sản Phẩm:</b>
                            <?php echo $row_detail['masp'] ?>
                        </li>
                        <?php } if($row_detail['mota_'.$lang]){ ?>
                        <li class="inPro-mota">
                            <?php echo ($row_detail['mota_'.$lang.''])?>
                        </li>
                        <?php } ?>
                        <li class="inPro-gia">
                            <b>Giá: </b>
                            <?php echo format_money($row_detail['giacu'],'<u>đ</u>', '<a href="lien-he.html" title="Liên Hệ">Liên Hệ</a>') ?>
                        </li>
                        <li class="inPro-luotxem">
                            <b>Lượt Xem: </b>
                            <?php echo $row_detail['luotxem'] ?>
                        </li>
                        <li class="inPro-share">
                            <?php include _template."layout/share_social.php"; ?>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="">
                <div class="content-product">
                    <div class="title-content">
                        <h2>
                            <?php echo _thongtinsanpham ?>
                        </h2>
                    </div>
                    <div class="content">
                        <article class="noidung">
                            <?php echo $row_detail['noidung_'.$lang.'']?>
                        </article>
                    </div>
                </div>
                <div class="content-product">
                    <div class="title-content">
                        <h2>
                            <?php echo _binhluan ?>
                        </h2>
                    </div>
                    <div class="content">
                        <?php include _template."layout/facebook_comment.php";?>
                    </div>
                </div>
            </div>
            <?php if(count($product)>0): ?>
            <div class="content-product">
                <div class="title-content">
                    <h2>
                        <?php echo _sanphamlienquan ?>
                    </h2>
                </div>
                <div class="inProduct-box">
                    <div class="splienquan-slick">
                        <?php foreach($product as $key => $value) { 
                            echo product($value,'inProduct-col wow fadeInUp" data-wow-delay="'.$key*0.12.'s',$com,$thumb_product); 
                        } ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<script>
$(document).ready(function() {
    $("#slick-gallery").slick({
        infinite: false,
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        arrows: false,
        dots: false,
        responsive: [
            { breakpoint: 768, settings: { slidesToShow: 7, } },
            { breakpoint: 521, settings: { slidesToShow: 5, } },
        ]
    });
    $(".splienquan-slick").slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        arrows: false,
        dots: false,
        responsive: [
            { breakpoint: 768, settings: { slidesToShow: 3, } },
            { breakpoint: 521, settings: { slidesToShow: 2, } },
        ]
    });
});
</script>
<?php echo headingSeo($row_detail['ten_'.$lang]); ?>