<!-- begin slider -->
<link rel="stylesheet" type="text/css" href="bonus/wowslider/wowslider.css" />
<?php $slider = _result_array("SELECT link,CONCAT(directory,'',photo_vi) as photo,ten_vi as ten,id FROM table_photo WHERE type = 'slider' AND hienthi = 1 ORDER BY stt ASC") ?>
<section id="block-slider">
    <div class="container">
        <div class="container-slider">
            <div class="slider-box flexbox">
                <div class="slider-danhmuc animated fadeInLeft">
                    <?php $danhmuc_list = _result_array("SELECT ten_$lang as ten,tenkhongdau,id FROM table_product_list WHERE type like 'product' AND hienthi = 1  AND noibat = 1 ORDER BY stt ASC"); ?>
                    <ul class="danhmuc-list">
                        <?php foreach ($danhmuc_list as $key_list => $value_list): 
                            $danhmuc_cat = _result_array("SELECT ten_$lang as ten,tenkhongdau,id FROM table_product_cat WHERE type like 'product' AND hienthi = 1  AND noibat = 1 AND id_list = '".$value_list['id']."'ORDER BY stt ASC");?>
                        <li>
                            <a href="san-pham/<?php echo $value_list['tenkhongdau'] ?>-<?php echo $value_list['id'] ?>" title="<?php echo $value_list['ten'] ?>">
                                <?php echo $value_list['ten'] ?>
                            </a>
                            <ul class="danhmuc-cat">
                                <?php foreach ($danhmuc_cat as $key_cat => $value_cat): ?>
                                <li>
                                    <a href="san-pham/<?php echo $value_list['tenkhongdau'] ?>/<?php echo $value_cat['tenkhongdau'] ?>-<?php echo $value_cat['id'] ?>" title="<?php echo $value_cat['ten'] ?>">
                                        <?php echo $value_cat['ten'] ?>
                                    </a>
                                </li>
                                <?php endforeach ?>
                            </ul>
                        </li>
                        <?php endforeach ?>
                    </ul>
                </div>
                <div class="slider-show animated fadeInRight">
                    <div id="wowslider-container1">
                        <div class="ws_images">
                            <ul>
                                <?php foreach($slider as $key =>$value){?>
                                <li>
                                    <a href="<?= $value['link'] ?>" target="_blank">
                                        <img src="thumb/910x425/1/<?=_upload_hinhanh_l.$value['photo']?>" alt="<?php echo $value['ten'] ?>" title="<?php echo $value['ten'] ?>" id="wows1_<?= $value['id'] ?>" onerror="this.src='thumb/910x425/1/images/noimg.jpg';" />
                                    </a>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="ws_bullets">
                            <div>
                                <?php foreach($slider as $key =>$value){?>
                                <a href="#" title="<?php echo $value['ten'] ?>">
                                    <span>
                                        <!-- <img src="<?=_upload_hinhanh_l.$value['photo']?>" alt="<?php echo $value['ten'] ?>" /> -->
                                        <?php echo $key+1 ?>
                                    </span>
                                </a>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="ws_shadow"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript" src="bonus/wowslider/wowslider.js"></script>
<script type="text/javascript" src="bonus/wowslider/wowslider_script.js"></script>
<!-- end slider -->