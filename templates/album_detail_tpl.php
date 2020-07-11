<!-- begin inAlbum -->
<section class="inBody" id="inAlbum" style="<?= $bg_pagein?>">
    <link rel="stylesheet" type="text/css" href="bonus/unitegallery/unite-gallery.css" />
    <script src="bonus/unitegallery/unitegallery.min.js"></script>
    <script src="bonus/unitegallery/ug-theme-tiles.js"></script>
    <div class="container">
        <article class="container-inAlbum">
            <h3 class="pagein-title">
                <?=' <span>'.$row_detail['ten_'.$lang].'</span>'?>
            </h3>
            <div class="inAlbum-box">
                <?php  foreach($album_images as $key => $value){?>
                <a href="<?php echo _upload_album_l.$value['photo'] ?>" target="_self">
                    <img src="<?php echo _upload_album_l.$value['photo'] ?>" alt="<?php echo $value['ten'] ?>" onerror="this.src='thumb/200x200/1/images/noimg.jpg';" data-image="<?php echo _upload_album_l.$value['photo'] ?>">
                </a>
                <?php } ?>
            </div>
        </article>
    </div>
    <div class="clearfix"></div>
    <script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery(".inAlbum-box").unitegallery({
            tile_enable_textpanel: false,
            tile_textpanel_bg_color: "#a4ce3c",
            tile_textpanel_bg_opacity: 0.8,
            tiles_justified_space_between: 5,
            tile_textpanel_title_color: "white",
            tile_textpanel_title_text_align: "center",
            gallery_min_width: 500,
            tile_as_link: false,
            tiles_type: "justified",
            lightbox_hide_arrows_onvideoplay: true,
            lightbox_arrows_position: "sides",
            lightbox_arrows_offset: 10,
            lightbox_arrows_inside_offset: 10,
            lightbox_arrows_inside_alwayson: true,
        });
    });
    </script>
</section>
<?php echo headingSeo($row_detail['ten_'.$lang]); ?>
<!-- end inAlbum -->