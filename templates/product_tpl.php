<section class="inBody" id="inProduct" style="<?= $bg_pagein?>">
    <div class="container">
        <?php //echo $breadcrumb ?>
        <article class="container-inProduct">
            <h1 class="pagein-title animated fadeInDownBig">
                <?php if($id!=''||$idl!=''||$idc!=''||$ids!=''||$idi!=''){ 
                    echo '<span>'.$row_detail['ten_'.$lang].'</span>'; 
                }else{ echo '<span>'.$title_detail_frq.'</span>'; } ?>
            </h1>
            <main class="inProduct-box flexbox">
                <?php foreach($product as $key => $value) { 
                echo product($value,'inProduct-col wow fadeInUp" data-wow-delay="'.$key*0.15.'s','san-pham',$thumb_product); 
                } ?>
            </main>
            <div class="text-center">
                <?php echo $paging ?>
            </div>
        </article>
    </div>
</section>