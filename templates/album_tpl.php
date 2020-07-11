<!-- begin inAlbum -->
<section class="inBody" id="inAlbum" style="<?= $bg_pagein?>">
    <div class="container">
        <?php //$breadcrumb ?>
        <article class="container-inAlbum">
            <h1 class="pagein-title">
                <?=' <span>'.$title_detail_frq.'</span>'?>
            </h1>
            <?php if(count($album)!=0){?>
            <div class="inAlbum-box flexbox">
                <?php foreach ($album as $key => $value) {?>
                <div class="inAlbum-col">
                    <div class="inAlbum-item">
                        <div class="inAlbum-img img-full">
                            <a href="album/<?php echo $value['tenkhongdau'] ?>-<?php echo $value['id'] ?>.html" title="<?php echo $value['ten'] ?>">
                                <img src="thumb/340x270/1/<?php echo _upload_album_l.$value['photo'] ?>" alt="<?php echo $value['ten'] ?>" onerror="this.src='thumb/340x270 /1/images/noimg.jpg';">
                            </a>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
            <?php }?>
            <div class="text-center">
                <?php echo $paging?>
            </div>
        </article>
    </div>
    <?php echo headingSeo($row_detail['ten_'.$lang]); ?>
</section>
<!-- end inAlbum -->