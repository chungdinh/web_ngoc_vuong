<section class="inBody" id="inSearch" style="<?= $bg_pagein?>">
    <div class="container">
        <?php// echo $breadcrumb ?>
        <article class="container-inProduct">
            <header class="pagein-title">
                <?=' <span>'.$title_detail_frq.'</span>'?>
            </header>
            <?php if (!empty($product)){ ?>
            <main class="inProduct-box flexbox">
                <?php foreach($product as $key => $value) { 
                echo product($value,'inProduct-col wow fadeInUp" data-wow-delay="'.$key*0.15.'s','san-pham',$thumb_product); 
                } ?>
            </main>
            <div class="text-center">
                <?php echo $paging ?>
            </div>
            <?php } else { ?>
            <h4 class="searchna">
                Không tìm thấy kết quả tìm kiếm
            </h4>
            <?php } ?>
        </article>
    </div>
</section>