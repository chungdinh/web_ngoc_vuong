<section class="inBody" id="inNews" style="<?= $bg_pagein?>">
    <div class="container">
        <?php //echo $breadcrumb ?>
        <article class="container-inNews">
            <h1 class="pagein-title animated fadeInDownBig">
                <?php if($id!=''||$idl!=''||$idc!=''||$ids!=''||$idi!=''){ 
                    echo '<span>'.$row_detail['ten_'.$lang].'</span>'; 
                }else{ echo '<span>'.$title_detail_frq.'</span>'; } ?>
            </h1>
            <div class="inNews-box flexbox">
                <?php foreach ($tintuc as $key => $value){
                    echo news($value,'inNews-col wow fadeInUpBig" data-wow-delay="'.$key*0.15.'s',$com,'280x200/1'); 
            } ?>
            </div>
            <div class="text-center">
                <?php echo $paging ?>
            </div>
        </article>
    </div>
</section>