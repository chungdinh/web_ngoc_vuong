<!-- begin inAbout -->
<section class="inBody" id="inAbout" style="<?= $bg_pagein?>">
    <div class="container">
        <article class="container-inAbout">
            <?php //echo $breadcrumb ?>
            <h3 class="pagein-title wow fadeInDown">
                <?=' <span>'.$row_detail["ten_$lang"].'</span>'?>
            </h3>
            <div class="inAbout-box">
                <article class="inAbout-noidung wow fadeInUp">
                    <?php echo $row_detail['noidung_'.$lang]; ?>
                </article>
                <div class="clearfix">
                    <?php include _template."layout/share_social.php"; ?>
                </div>
            </div>
        </article>
    </div>
    <?php echo headingSeo($row_detail['ten_'.$lang]) ?>
</section>
<!-- end inAbout -->