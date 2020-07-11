<!-- begin contact -->
<?php 
$info_contact = _fetch_array("SELECT noidung_$lang as noidung FROM table_info WHERE type like 'lienhe' LIMIT 0,1");
 ?>
<section class="inBody" id="inContact">
    <div class="container">
        <?php //echo $breadcrumb ?>
        <div class="container-inContact">
            <header class="pagein-title-white animated fadeInDownBig">
                <?=' <span>'.$title_detail_frq.'</span>'?>
            </header>
            <main class="inContact-box flexbox">
                <div class="inContact-col animated bounceInRight">
                    <article class="inContact-noidung">
                        <div class="inContact-noidung-box">
                            <?=$info_contact['noidung']?>
                        </div>
                    </article>
                </div>
                <div class="inContact-col animated zoomInLeft">
                    <form action="lien-he.html" id="form-lienhe" method="post" autocomplete="off">
                        <div class="contact-group">
                            <input name="ten" placeholder="Họ và Tên" required="required" type="text" id="ten" />
                            <span class="fa fa-id-card" aria-hidden="true"></span>
                        </div>
                        <div class="contact-group">
                            <input name="diachi" type="text" id="diachi" placeholder="Địa Chỉ" />
                            <span class="fa fa-map-marker" aria-hidden="true"></span>
                        </div>
                        <div class="contact-group">
                            <input name="dienthoai" type="text" placeholder="Điện Thoại" id="dienthoai" />
                            <span class="fa fa-phone-square" aria-hidden="true"></span>
                        </div>
                        <div class="contact-group">
                            <input name="email" type="email" placeholder="Email" required="required" id="email" />
                            <span class="fa fa-envelope-o" aria-hidden="true"></span>
                        </div>
                        <div class="conact-group-noidung">
                            <textarea name="noidung" cols="50" rows="5" id="noidung" placeholder="Nội Dung"></textarea>
                            <span class="fa fa-edit" aria-hidden="true"></span>
                        </div>
                        <input type="hidden" name="type" value="lienhe">
                        <input type="hidden" name="recaptcha_response_contact" id="recaptchaResponse_contact">
                        <div class="contact-group-btn">
                            <button class="contact-btn" name="contact-btn" type="submit">Liên Hệ</button>
                        </div>
                    </form>
                </div>
                <div class="clearfix"></div>
            </main>
        </div>
        <div class="clearfix"></div>
    </div>
</section>
<section id="contact-map" class="wow fadeInUp">
    <?php echo $row_setting['iframe'] ?>
</section>
<!-- end contact -->