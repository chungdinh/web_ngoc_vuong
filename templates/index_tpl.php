<!-- begin dichvu -->
<?php $dichvu_ind = _result_array("SELECT photo,ten_$lang as ten,id,tenkhongdau,mota_$lang as mota FROM table_baiviet WHERE type = 'dichvu' AND hienthi = 1 AND noibat = 1 ORDER BY stt ASC"); 
?>
<section id="block-dichvu">
    <div class="container">
        <div class="container-dichvu">
            <div class="title-main wow fadeInDown">
                <span>Dịch Vụ Nổi Bật</span>
            </div>
            <div class="dichvu-box">
                <div class="dichvu-slick">
                    <?php foreach ($dichvu_ind as $key => $value): ?>
                    <div class="dichvu-col wow fadeInUp" data-wow-delay="<?= $key*0.15?>s">
                        <div class="dichvu-item">
                            <article class="dichvu-img effect-scale img-full">
                                <a href="dich-vu/<?php echo $value['tenkhongdau'] ?>-<?php echo $value['id'] ?>.html" title="<?php echo $value['ten'] ?>">
                                    <img src="thumb/250x250/1/<?php echo _upload_baiviet_l.$value['photo'] ?>" alt="<?php echo $value['ten'] ?>">
                                </a>
                            </article>
                            <article class="dichvu-text hover">
                                <h3>
                                    <a href="dich-vu/<?php echo $value['tenkhongdau'] ?>-<?php echo $value['id'] ?>.html" title="<?php echo $value['ten'] ?>">
                                        <?php echo catchuoi($value['ten'],30) ?>
                                    </a>
                                </h3>
                                <p>
                                    <?php if(!empty($value['mota'])){echo catchuoi($value['mota'],130);} else {echo 'Nội dung đang cập nhật...';}?>
                                </p>
                            </article>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function() {
        $(".dichvu-slick").slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            vertical: false,
            infinite: true,
            verticalSwiping: false,
            autoplay: true,
            autoplaySpeed: 3000,
            speed: 1000,
            arrows: false,
            dots: false,
            responsive: [
                { breakpoint: 993, settings: { slidesToShow: 3 } },
                { breakpoint: 768, settings: { slidesToShow: 2 } },
            ]
        });
    });
    </script>
</section>
<!-- end dichvu -->
<!-- begin sanpham -->
<?php $product_list = _result_array("SELECT ten_$lang as ten, tenkhongdau, id FROM table_product_list WHERE type = 'product' AND hienthi = 1  AND noibat = 1 ORDER BY stt ASC"); ?>
<section id="block-sanpham">
    <div class="container">
        <?php foreach ($product_list as $key_list => $value_list): 
            $product_ind = _result_array("SELECT ten_$lang as ten, tenkhongdau, id, photo, giacu, giaban FROM table_product WHERE type = 'product' AND hienthi = 1 AND noibat = 1 AND id_list = '".$value_list['id']."' ORDER BY stt ASC");?>
        <div class="container-sanpham">
            <div class="sanpham-title wow fadeInDown">
                <span class="sanpham-name">
                    <?php echo $value_list['ten'] ?>
                </span>
                <span class="sanpham-banchay">
                    <a href="ban-chay/<?php echo $value_list['tenkhongdau'] ?>-<?php echo $value_list['id'] ?>" title="Sản Phẩm Bán Chạy">Sản Phẩm Bán Chạy</a>
                </span>
                <span class="sanpham-banchay">
                    <a href="san-pham-moi/<?php echo $value_list['tenkhongdau'] ?>-<?php echo $value_list['id'] ?>" title="Sản Phẩm Mới">Sản Phẩm Mới</a>
                </span>
                <span class="sanpham-xemthem">
                    <a href="san-pham/<?php echo $value_list['tenkhongdau'] ?>-<?php echo $value_list['id'] ?>" title="<?php echo $value_list['ten'] ?>">Xem Thêm</a>
                </span>
            </div>
            <div class="sanpham-box">
                <div class="<?php if ($key%2==0){echo'sanpham-slick-chan';}else{echo 'sanpham-slick-le';} ?>">
                    <?php foreach ($product_ind as $key => $value){
                    echo product($value,'sanpham-col wow fadeInUp" data-wow-delay="'.$key*0.15.'s','san-pham', $thumb_product); 
                }?>
                </div>
            </div>
        </div>
        <?php endforeach ?>
    </div>
    <script type="text/javascript">
    $(document).ready(function() {
        $(".sanpham-slick-le").slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            vertical: false,
            infinite: true,
            verticalSwiping: false,
            autoplay: true,
            autoplaySpeed: 3000,
            speed: 500,
            arrows: false,
            dots: false,
            responsive: [
                { breakpoint: 993, settings: { slidesToShow: 3 } },
                { breakpoint: 768, settings: { slidesToShow: 2 } },
            ]
        });
    });
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        $(".sanpham-slick-chan").slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            vertical: false,
            infinite: true,
            verticalSwiping: false,
            autoplay: true,
            autoplaySpeed: 3000,
            speed: 800,
            arrows: false,
            dots: false,
            responsive: [
                { breakpoint: 993, settings: { slidesToShow: 5 } },
                { breakpoint: 768, settings: { slidesToShow: 3 } },
                { breakpoint: 580, settings: { slidesToShow: 1 } },
            ]
        });
    });
    </script>
</section>
<!-- end sanpham -->
<!-- begin duan -->
<?php $duan_ind = _result_array("SELECT photo,ten_$lang as ten,id,tenkhongdau FROM table_album WHERE type = 'duan' AND hienthi = 1 AND noibat = 1 ORDER BY stt ASC"); ?>
<section id="block-duan">
    <div class="container">
        <div class="container-duan">
            <div class="title-main wow fadeInDown">
                <span>Dự Án Tiêu BIểu </span>
            </div>
            <div class="duan-box">
                <div class="duan-slick">
                    <?php foreach ($duan_ind as $key => $value): ?>
                    <div class="duan-col wow fadeInUp" data-wow-delay="<?= $key*0.15?>s">
                        <div class="duan-item flexbox">
                            <article class="duan-img effect-scale img-full">
                                <a href="du-an/<?php echo $value['tenkhongdau'] ?>-<?php echo $value['id'] ?>.html" title="<?php echo $value['ten'] ?>">
                                    <img src="thumb/275x300/1/<?php echo _upload_album_l.$value['photo'] ?>" alt="<?php echo $value['ten'] ?>">
                                </a>
                            </article>
                            <article class="duan-text hover">
                                <h3>
                                    <a href="du-an/<?php echo $value['tenkhongdau'] ?>-<?php echo $value['id'] ?>.html" title="<?php echo $value['ten'] ?>">
                                        <?php echo $value['ten'] ?>
                                    </a>
                                </h3>
                            </article>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function() {
        $(".duan-slick").slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            vertical: false,
            infinite: true,
            verticalSwiping: false,
            autoplay: true,
            autoplaySpeed: 4000,
            speed: 1000,
            arrows: false,
            dots: false,
            responsive: [
                { breakpoint: 993, settings: { slidesToShow: 3 } },
                { breakpoint: 768, settings: { slidesToShow: 2 } },
            ]
        });
    });
    </script>
</section>
<!-- end duan -->
<!-- widget -->
<section id="block-widget">
    <div class="container">
        <article class="container-widget">
            <div class="widget-box flexbox">
                <article class="widget-news wow fadeInLeft">
                    <?php $news_ind = _result_array("SELECT ten_$lang as ten,tenkhongdau,id,photo,mota_$lang as mota,ngaytao FROM table_baiviet WHERE type = 'tintuc' AND hienthi = 1 AND noibat = 1 ORDER BY stt ASC"); ?>
                    <div class="widget-title">
                        <span> tin tức - sự kiện </span>
                    </div>
                    <div class="news-box">
                        <div id="<?php if (count($news_ind)>3){echo'news-scroller';}?>">
                            <?php foreach ($news_ind as $key => $value): ?>
                            <div class="news-item flexbox">
                                <article class="news-date flexbox-col">
                                    <p>
                                        <?php echo pofday($value['ngaytao']) ?>
                                    </p>
                                    <span>
                                        <?php echo date('d/m/Y',$value['ngaytao']) ?>
                                    </span>
                                    <img src="images/tintuc-cycle.png" alt="cycle">
                                </article>
                                <div class="news-wrap flexbox">
                                    <article class="news-img img-full effect-scale">
                                        <a href="tin-tuc/<?php echo $value['tenkhongdau'] ?>-<?php echo $value['id'] ?>.html" title="<?php echo $value['ten'] ?>">
                                            <img src="thumb/105x90/1/<?php echo _upload_baiviet_l.$value['photo'] ?>" alt="<?php echo $value['ten'] ?>" onerror="this.src='thumb/105x90/1/images/noimg.jpg';">
                                        </a>
                                    </article>
                                    <article class="news-text hover">
                                        <h3>
                                            <a href="tin-tuc/<?php echo $value['tenkhongdau'] ?>-<?php echo $value['id'] ?>.html" title="<?php echo $value['ten'] ?>">
                                                <?php echo catchuoi($value['ten'],100); ?>
                                            </a>
                                        </h3>
                                        <p>
                                            <?php if(!empty($value['mota'])){echo catchuoi($value['mota'],120);} else {echo 'Nội dung đang cập nhật...';}?>
                                        </p>
                                    </article>
                                </div>
                            </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </article>
                <article class="widget-video wow fadeInRight">
                    <?php $video_ind = _result_array("SELECT ten_$lang as ten,id,links FROM table_video WHERE type = 'video' AND hienthi = 1 ORDER BY stt ASC");
                    $video_first = $video_ind[0]; ?>
                    <div class="widget-title">
                        <span>video - clip</span>
                    </div>
                    <div class="video-box flexbox">
                        <div class="video-play">
                            <iframe id="video-player" width="100%" height="410" src="https://www.youtube.com/embed/<?php echo getIDyoutube($video_first['links']) ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        </div>
                        <div class="video-list">
                            <div class="video-slick">
                                <?php foreach ($video_ind as $key => $value): ?>
                                <div class="video-item img-full">
                                    <a href="javascript:void(0);" title="<?php echo $value['ten'] ?>" data-id="<?php echo getIDyoutube($value['links']) ?>">
                                        <img src="<?php echo getImgYoutube($value['links']) ?>" title="<?php echo $value['ten'] ?>">
                                    </a>
                                </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </article>
    </div>
</section>
<script type="text/javascript">
$(document).ready(function() {
    $(".video-slick").slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        vertical: true,
        infinite: true,
        verticalSwiping: true,
        autoplay: false,
        autoplaySpeed: 3000,
        speed: 300,
        arrows: false,
        dots: false,
        responsive: [
            { breakpoint: 993, settings: { slidesToShow: 5, verticalSwiping: false, vertical: false, } },
            { breakpoint: 768, settings: { slidesToShow: 3, verticalSwiping: false, vertical: false, } },
            { breakpoint: 580, settings: { slidesToShow: 2, verticalSwiping: false, vertical: false, } },
        ]
    });
});
</script>
<script type="text/javascript">
(function($) {
    $(function() { //on DOM ready 
        $("#news-scroller").simplyScroll({ orientation: 'vertical' });
    });
})(jQuery);
$(document).ready(function() {
    $(".video-item a").click(function(event) {
        $("#video-player").attr('src', 'https://www.youtube.com/embed/' + $(this).attr('data-id'));
    });
});
</script>
<!-- end widget -->
<!-- begin dkmail -->
<section id="block-dkmail">
    <div class="container">
        <div class="container-dkmail wow fadeInDown">
            <div class="dkmail-box flexbox">
                <div class="dkmail-title flexbox">
                    <img src="images/icon-email.png" alt="mail">
                    <div>
                        <p>Đăng ký tư vấn</p>
                        <span>Nhập số điện thoại để nhận thông tin tư vấn</span>
                    </div>
                </div>
                <form method="POST" class="dkmail-form" autocomplete="off" action="mail.html">
                    <div class="dkmail-wrap">
                        <input type="email" name="txt_email" class="txt_email" placeholder="Nhập email của bạn">
                        <input type="hidden" name="recaptcha_response_mail" id="recaptchaResponse_mail">
                        <button type="submit" class="dkmail-btn">Gửi</button>
                    </div>
                </form>
                <article class="dkmail-social">
                    <?php $social_body = _result_array("SELECT ten,photo,url FROM table_lkweb WHERE type = 'socialbody' AND hienthi = 1 ORDER BY stt ASC"); ?>
                    <?php foreach ($social_body as $key => $value): ?>
                    <a href="<?php echo $value['url'] ?>" title="<?php echo $value['ten'] ?>">
                        <img src="thumb/42x42/1/<?php echo _upload_hinhanh_l.$value['photo'] ?>" alt="<?=$value['ten']?>" onerror="this.src='thumb/42x42/1/images/noimg.jpg';">
                    </a>
                    <?php endforeach ?>
                </article>
            </div>
        </div>
    </div>
</section>
<!-- end dkmail -->