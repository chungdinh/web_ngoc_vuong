<div class="inBody" style="<?= $bg_pagein?>">
    <div class="container">
        <?php echo $breadcrumb ?>
        <div class="container-inProduct">
            <div class="pagein-title">
                <?=' <span>'.$title_detail_frq.'</span>'?>
            </div>
            <?php if (!empty($product)){ ?>
            <div class="inProduct-box flexbox">
                <?php foreach($product as $key => $value) { 
                echo product($value,'sanpham-col',$com,$thumb_product); 
                } ?>
            </div>
            <div class="text-center">
                <?php echo $paging ?>
            </div>
            <?php } else { ?>
            <h4 class="searchna">
                Không có sản phẩm nào theo từ khóa
            </h4>
            <?php } ?>
        </div>
    </div>
</div>