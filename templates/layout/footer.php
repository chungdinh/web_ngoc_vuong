<!-- begin footer -->
<?php 
$bgfooter = _fetch_array("SELECT * FROM table_bgweb WHERE type like 'bgfooter' AND hienthi = 1");
if($bgfooter['photo'] == ''){
    $bg_footer = 'background-color:'.$bgfooter['mauneen'];
} else{
    $bg_footer = 'background:url(./'._upload_hinhanh_l.$bgfooter['photo'].') '.$bgfooter['mauneen'].' '.$bgfooter['trai'].' '.$bgfooter['tren'].' '.$bgfooter['re_peat'].' '.$bgfooter['fix_bg'].';background-size:cover';
}
 ?>
<section id="block-footer" style="<?= $bg_footer ?>">
    <div class="container">
        <div class="container-footer">
            <div class="footer-box flexbox">
                <article class="footer-cty wow fadeInLeft">
                    <div class="footer-title">
                        <span>Thông Tin Liên Hệ</span>
                    </div>
                    <div class="cty-box">
                        <div class="cty-title">
                            <span>
                                <?php echo $row_setting["ten_$lang"] ?>
                            </span>
                        </div>
                        <article class="cty-noidung">
                            <?php $info_footer = _fetch_array("SELECT noidung_$lang FROM table_info WHERE type like 'footer' LIMIT 0,1"); ?>
                            <?php //echo $info_footer['noidung'.$lang] ?>
                            <?php  ?>
                            <div class="cty-box">
                                <div class="cty-item">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <span>
                                        <?php echo $row_setting['diachi_'.$lang] ?>
                                    </span>
                                </div>
                                <div class="cty-item">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    <span>
                                        <?php echo $row_setting['hotline'] ?>
                                    </span>
                                </div>
                                <div class="cty-item">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    <span>
                                        <?php echo $row_setting['email'] ?>
                                    </span>
                                </div>
                                <div class="cty-item">
                                    <i class="fa fa-globe" aria-hidden="true"></i>
                                    <span>
                                        <?php echo $row_setting['website'] ?>
                                    </span>
                                </div>
                            </div>
                            <?php  ?>
                        </article>
                    </div>
                </article>
                <article class="footer-chinhsach wow fadeInDown">
                    <?php $chinhsach_footer = _result_array("SELECT ten_$lang,tenkhongdau,id FROM table_baiviet WHERE type like 'chinhsach' AND hienthi = 1 ORDER BY stt ASC LIMIT 0,6"); ?>
                    <div class="footer-title">
                        <span>chính sách</span>
                    </div>
                    <?php if (!empty($chinhsach_footer)): ?>
                    <ul class="chinhsach-list flexbox-col">
                        <?php foreach ($chinhsach_footer as $key => $value): ?>
                        <li>
                            <a href="chinh-sach/<?php echo $value['tenkhongdau'] ?>-<?php echo $value['id'] ?>.html" title="<?php echo $value['ten_'.$lang] ?>">
                                <?php echo $value['ten_'.$lang] ?>
                            </a>
                        </li>
                        <?php endforeach ?>
                    </ul>
                    <?php endif ?>
                </article>
                <article class="footer-facebook wow fadeInRight">
                    <div class="fb-page" data-href="<?=$row_setting['facebook']?>" data-tabs="timeline" data-width="500" data-height="250" data-small-header="true" data-adapt-container-width="true" data-show-posts="false" data-hide-cover="false" data-show-facepile="true">
                        <blockquote cite="<?=$row_setting['facebook']?>" class="fb-xfbml-parse-ignore">
                            <a href="<?=$row_setting['facebook']?>">Facebook</a>
                        </blockquote>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
<section class="block-copyright">
    <div class="container">
        <div class="container-copyright">
            <div class="copyright-box flexbox">
                <div class="copyright-text">
                    <?php echo 'Copyright © 2019 <span>'.$row_setting['copyright'].'</span>. All rights reserved | Designed by: NINA Co.,Ltd' ?>
                </div>
                <div class="counter flexbox">
                    <div>
                        <?php echo 'Đang online: <span>'.$count_online['dangxem'].'</span>' /*?>
                    </div>
                    <div>
                        <?php echo 'Truy cập ngày: <span>'.$today_visitors.'</span>' ?>
                    </div>
                    <div>
                        <?php echo 'Truy cập tuần: <span>'.$week_visitors.'</span>' ?>
                    </div>
                    <div>
                        <?php echo 'Truy cập tháng: <span>'.$month_visitors.'</span>' */?>
                    </div>
                    <div>
                        <?php echo 'Tổng truy cập: <span>'.$all_visitors.'</span>' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end footer -->