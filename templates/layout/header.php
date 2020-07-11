<!-- begin header -->
<?php 
$bgheader = _fetch_array("SELECT * FROM table_bgweb WHERE type = 'bgheader' AND hienthi = 1");
if($bgheader['photo'] == ''){
    $bg_header = 'background-color:'.$bgheader['mauneen'];
} else{
    $bg_header = 'background:url(./'._upload_hinhanh_l.$bgheader['photo'].') '.$bgheader['mauneen'].' '.$bgheader['trai'].' '.$bgheader['tren'].' '.$bgheader['re_peat'].' '.$bgheader['fix_bg'].';background-size:cover';
}

$bgpagein = _fetch_array("SELECT * FROM table_bgweb WHERE type = 'bgpagein' AND hienthi = 1");
if($bgpagein['photo'] == ''){
    $bg_pagein = 'background-color:'.$bgpagein['mauneen'];
} else{
    $bg_pagein = 'background:url(./'._upload_hinhanh_l.$bgpagein['photo'].') '.$bgpagein['mauneen'].' '.$bgpagein['trai'].' '.$bgpagein['tren'].' '.$bgpagein['re_peat'].' '.$bgpagein['fix_bg'].';background-size:cover';
}
?>
<section id="block-header" style="<?= $bg_header ?>">
    <div class="container">
        <div class="container-header">
            <article class="header-box flexbox">
                <div class="header-logo img-full animated fadeInLeft">
                    <?php $header_logo = _fetch_array("SELECT photo_$lang,hienthi FROM table_photo WHERE type = 'logo' LIMIT 0,1"); ?>
                    <?php if ($header_logo['hienthi']){ ?>
                    <a href="<?php echo $url_web ?>" title="<?php echo $row_setting['ten_'.$lang] ?>">
                        <img src="thumb/255x80/1/<?php echo _upload_hinhanh_l.$header_logo['photo_'.$lang] ?>" alt="Logo" onerror="this.src='thumb/255x80/1/images/noimg.jpg';">
                    </a>
                    <?php } ?>
                </div>
                <?php include _template."layout/search.php"; ?>
                <article class="header-info flexbox-col animated fadeInRight">
                    <article class="header-social">
                        <?php $header_social = _result_array("SELECT ten,photo,url FROM table_lkweb WHERE type = 'socialheader' AND hienthi = 1 ORDER BY stt,id ASC"); ?>
                        <?php foreach ($header_social as $key => $value): ?>
                        <a href="<?php echo $value['url'] ?>" title="<?php echo $value['ten'] ?>">
                            <img src="thumb/30x30/1/<?php echo _upload_hinhanh_l.$value['photo'] ?>" alt="<?=$value['ten']?>" onerror="this.src='thumb/30x30/1/images/noimg.jpg';">
                        </a>
                        <?php endforeach ?>
                    </article>
                    <div class="header-hotline flexbox">
                        <i class="fa fa-phone flexbox-center" aria-hidden="true"></i>
                        <div class="flexbox-col">
                            <?php echo '<span> Hotline tư vấn: </span> <b>'.$row_setting['hotline'].'</b>' ?>
                        </div>
                    </div>
                </article>
            </article>
        </div>
    </div>
</section>
<!-- end header -->