<div class="inBody" style="<?= $bg_pagein?>">
    <div class="container">
        <?php// echo $breadcrumb ?>
        <div class="container-inVideo">
            <div class="pagein-title">
                <?=' <span>'.$title_detail_frq.'</span>'?>
            </div>
            <div class="inVideo-box flexbox">
                <?php foreach ($video as $key => $value): ?>
                <div class="inVideo-col">
                    <div class="inVideo-item">
                        <div class="inVideo-img img-full">
                            <a href="<?php echo $value['links'] ?>" data-fancybox title="<?php echo $value['ten'] ?>">
                                <img class="w_100" src="<?php echo getImgYoutube($value['links']) ?>" alt="<?php echo $value['ten_'.$lang] ?>">
                            </a>
                        </div>
                        <div class="inVideo-text">
                            <h3>
                                <a href="<?php echo $value['links'] ?>" data-fancybox title="<?php echo $value['ten'] ?>">
                                    <?php echo $value["ten_$lang"] ?>
                                </a>
                            </h3>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
            <div class="text-center">
                <?php echo $paging ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/fancybox3/jquery.fancybox.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('[data-fancybox]').fancybox();
});
</script>