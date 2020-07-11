<section class="inBody" id="inNews-detail" style="<?= $bg_pagein?>">
    <div class="container">
        <?php //echo $breadcrumb ?>
        <article class="container-inNews">
            <h1 class="pagein-title">
                <?=' <span>'.$row_detail['ten_'.$lang].'</span>'?>
            </h1>
            <div class="inNews-noidung" style="margin-bottom: 15px;">
                <article>
                    <?php echo $row_detail['noidung_'.$lang]; ?>
                </article>
            </div>
            <div class="clearfix">
                <?php include _template."layout/share_social.php"; ?>
            </div>
            <?php if (count($tintuc) > 0): ?>
            <article>
                <div class="pagein-title">
                    <span>Tin Liên Quan</span>
                </div>
                <div class="newsmore">
                    <div class="newsmore-box">
                        <div class="newsmore-slick">
                            <?php foreach ($tintuc as $key => $value){
                            echo news($value,'inNews-col',$com,'280x200/1'); 
                        } ?>
                        </div>
                    </div>
                    <?php endif ?>
                    <?php echo headingSeo($row_detail['ten_'.$lang])?>
                </div>
            </article>
        </article>
    </div>
</section>
<script type="text/javascript">
$(document).ready(function() {
    $(".newsmore-slick").slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 3000,
        speed: 300,
        arrows: false,
        dots: false,
        vertical: false,
        verticalSwiping: false,
        responsive: [
            { breakpoint: 993, settings: { slidesToShow: 3 } },
            { breakpoint: 768, settings: { slidesToShow: 2 } },
            { breakpoint: 450, settings: { slidesToShow: 1 } },
        ]
    });
});
</script>