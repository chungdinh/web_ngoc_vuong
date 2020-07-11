<script type="text/javascript">
$(document).ready(function() {
    $('.chonngonngu li a').click(function(event) {
        var lang = $(this).attr('href');
        $('.chonngonngu li a').removeClass('active');
        $(this).addClass('active');
        $('.lang_hidden').removeClass('active');
        $('.lang_' + lang).addClass('active');
        return false;
    });
});
</script>
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
            <li><a href="index.php?com=setting&act=capnhat"><span>Thiết lập hệ thống</span></a></li>
            <li class="current"><a href="#" onclick="return false;">Cấu hình website</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">
function TreeFilterChanged2() {
    $('#validate').submit();
}
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=setting&act=save&curPage=<?=$_REQUEST['curPage']?>" method="post" enctype="multipart/form-data">
    <div class="widget">
        <div class="title chonngonngu">
            <ul>
                <?php foreach ($ar_lang as $key => $value){ ?>
                <li><a href="<?php echo $value['slug'] ?>" class="<?php echo $value['active'] ?> tipS validate[required]" title="Chọn <?php echo $value['ten'] ?>"><img src="./images/<?php echo $value['slug'] ?>.png" alt="" class="tiengviet" />
                        <?php echo $value['ten'] ?></a></li>
                <?php } ?>
            </ul>
        </div>
        <?php foreach ($ar_lang as $key => $value){ 
            if ($config_ten){ ?>
        <div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
            <label>Tên Công Ty: </label>
            <div class="formRight">
                <input type="text" name="ten_<?php echo $value['slug'] ?>" title="Nhập tên công ty <?php echo $value['ten'] ?>" id="ten_<?php echo $value['slug'] ?>" class="tipS validate[required]" value="<?=@$item['ten_'.$value['slug']]?>" />
            </div>
            <div class="clear"></div>
        </div>
        <?php } if ($config_slogan) {?>
        <div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
            <label>
                <?php echo $config_text_slogan ?>
            </label>
            <div class="formRight">
                <input type="text" name="slogan_<?php echo $value['slug'] ?>" title="Nhập nội dung" id="slogan_<?php echo $value['slug'] ?>" class="tipS" value="<?=@$item['slogan_'.$value['slug']]?>" />
            </div>
            <div class="clear"></div>
        </div>
        <?php } if ($config_diachi) {?>
        <div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
            <label>Địa chỉ: </label>
            <div class="formRight">
                <input type="text" name="diachi_<?php echo $value['slug'] ?>" title="Nhập địa chỉ công ty" id="diachi_<?php echo $value['slug'] ?>" class="tipS" value="<?=@$item['diachi_'.$value['slug']]?>" />
            </div>
            <div class="clear"></div>
        </div>
        <?php }  
        } if ($config_email) {?>
        <div class="formRow">
            <label>Email:</label>
            <div class="formRight">
                <input type="text" value="<?=@$item['email']?>" name="email" title="Nhập địa chỉ email" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>
        <?php } if ($config_hotline) {?>
        <div class="formRow">
            <label>Hotline:</label>
            <div class="formRight">
                <input type="text" value="<?=@$item['hotline']?>" name="hotline" title="Nhập hotline" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>
        <?php } if ($config_dienthoai) {?>
        <div class="formRow">
            <label>
                <?=$config_text_dienthoai?>:</label>
            <div class="formRight">
                <input type="text" value="<?=@$item['dienthoai']?>" name="dienthoai" title="Nhập nội dung" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>
        <?php } if ($config_timeopen) {?>
        <div class="formRow">
            <label>
                <?=$config_text_timeopen?>:</label>
            <div class="formRight">
                <input type="text" value="<?=@$item['timeopen']?>" name="timeopen" title="Nhập nội dung" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>
        <?php } if ($config_timeclose) {?>
        <div class="formRow">
            <label>
                <?=$config_text_timeclose?>:</label>
            <div class="formRight">
                <input type="text" value="<?=@$item['timeclose']?>" name="timeclose" title="Nhập nội dung" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>
        <?php } if ($config_web) {?>
        <div class="formRow">
            <label>Website:</label>
            <div class="formRight">
                <input type="text" value="<?=@$item['website']?>" name="website" title="Nhập địa chỉ website" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>
        <?php } if ($config_fanpage) {?>
        <div class="formRow">
            <label>FanPage Facebook: </label>
            <div class="formRight">
                <input type="text" value="<?=@$item['facebook']?>" name="facebook" title="Nhập link fanpage facebook" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>
        <?php } if ($config_toado) {?>
        <div class="formRow">
            <label>Tọa độ:</label>
            <div class="formRight">
                <input type="text" value="<?=@$item['toado']?>" name="toado" title="Nhập tọa độ" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>
        <?php } if ($config_copyright) {?>
        <div class="formRow">
            <label>Copyright:</label>
            <div class="formRight">
                <input type="text" value="<?=@$item['copyright']?>" name="copyright" title="Nhập copyright" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>
        <?php } if ($config_bcthuong) {?>
        <div class="formRow">
            <label for="diachi">Logo bộ công thương:</label>
            <div class="formRight">
                <input type="file" name="file_bocongthuong">
                <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="File hình">
                <div class="note">Chỉ file hình *.PNG(
                    <?php echo ' Width :'._width_thumb_bct*$ratio_,'px - Height :'._height_thumb_bct*$ratio_.'px';?>)
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="formRow">
            <label for="diachi">Hình hiện tại:</label>
            <div class="formRight">
                <img style="background-color: #cccccc" src="../thumb/235x90/2/<?php echo _upload_l.$item['bocongthuong'] ?>" alt="">
            </div>
            <div class="clear"></div>
        </div>
        <div class="formRow">
            <label for="diachi">Link bộ công thương</label>
            <div class="formRight">
                <input id="link_bocongthuong" name="link_bocongthuong" type="text" value="<?=$item['link_bocongthuong']?>" />
            </div>
            <div class="clear"></div>
        </div>
        <?php } if ($config_watermark_small) {?>
        <div class="formRow">
            <label for="diachi">Đóng dấu sản phẩm</label>
            <div class="formRight">
                <input type="file" name="watermark">
                <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Chỉ file hình png">
                <div class="note">Chỉ file hình *.PNG (
                    <?php echo ' Width :'._width_thumb*$ratio_,'px - Height :'._height_thumb*$ratio_.'px';?>)
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="formRow">
            <label for="diachi">Hình đóng dấu</label>
            <div class="formRight">
                <img style="background-color: #cccccc;max-width: 100%" src="../thumb/255x215/2/<?php echo _upload_l.$item['watermark'] ?>" alt="">
            </div>
            <div class="clear"></div>
        </div>
        <?php } if ($config_watermark_big) {?>
        <div class="formRow">
            <label for="diachi">Đóng dấu lớn</label>
            <div class="formRight">
                <input type="file" name="watermark2">
                <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Chỉ file hình png">
                <div class="note">Chỉ file hình *.PNG (
                    <?php echo ' Width :'._width_thumb*$ratio_,'px - Height :'._height_thumb*$ratio_.'px';?>)
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="formRow">
            <label for="diachi">Hình đóng dấu</label>
            <div class="formRight">
                <img style="background-color: #cccccc;max-width: 100%" src="../thumb/<?php echo _width_thumb_2.'x'._height_thumb_2.'/1/'._upload_l.$item['watermark2'] ?>" alt="">
            </div>
            <div class="clear"></div>
        </div>
        <?php }  if ($config_map) {?>
        <div class="formRow">
            <label>Link iframe bản đồ:</label>
            <div class="formRight">
                <textarea rows="4" cols="" title="iframe" class="tipS" name="iframe"><?=@$item['iframe']?></textarea>
            </div>
            <div class="clear"></div>
        </div>
        <div class="formRow setting-map">
            <label>Show bản đồ:</label>
            <div class="formRight">
                <?=$item['iframe']?>
            </div>
            <div class="clear"></div>
        </div>
        <?php }?>
    </div>
    <div class="widget">
        <div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
            <h6>Nội dung seo</h6>
        </div>
        <div class="title chonngonngu">
            <ul>
                <?php foreach ($ar_lang as $key => $value): ?>
                <li><a href="<?php echo $value['slug'] ?>" class="<?php echo $value['active'] ?> tipS validate[required]" title="Chọn <?php echo $value['ten'] ?>"><img src="./images/<?php echo $value['slug'] ?>.png" alt="" class="tiengviet" />
                        <?php echo $value['ten'] ?></a></li>
                <?php endforeach ?>
            </ul>
        </div>
        <?php foreach ($ar_lang as $key => $value){ ?>
        <div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
            <label>Title <br>
                <?php echo $value['ten'] ?></label>
            <div class="formRight lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
                <input type="text" value="<?=@$item['title_'.$value['slug']]?>" name="title_<?php echo $value['slug'] ?>" title="Nội dung thẻ meta Title dùng để SEO" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>
        <div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
            <label>Từ khóa <br>
                <?php echo $value['ten'] ?></label>
            <div class="formRight lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
                <input type="text" value="<?=@$item['keywords_'.$value['slug']]?>" name="keywords_<?php echo $value['slug'] ?>" title="Từ khóa chính cho danh mục" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>
        <div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
            <label>Description <br>
                <?php echo $value['ten'] ?></label>
            <div class="formRight lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
                <textarea rows="4" class="description" cols="<?php echo $value['slug']?>" title="Nội dung thẻ meta Description dùng để SEO" class="tipS" name="description_<?php echo $value['slug'] ?>"><?=@$item['description_'.$value['slug']]?></textarea>
                <input readonly="readonly" type="text" name="des_char" class="des_char_<?php echo $value['slug']?>" value="<?=@$item['des_char_'.$value['slug']]?>" /> ký tự <b>(Tốt nhất là 68 - 170 ký tự)</b>
            </div>
            <div class="clear"></div>
        </div>
        <?php } ?>
        <div class="formRow">
            <label>Analyrics:</label>
            <div class="formRight">
                <textarea rows="8" cols="" title="Code Analytics" class="tipS" name="analytics"><?=@$item['analytics']?></textarea>
            </div>
            <div class="clear"></div>
        </div>
        <div class="formRow">
            <label>V chat :</label>
            <div class="formRight">
                <textarea rows="8" cols="" title="Code vchat" class="tipS" name="vchat"><?=@$item['vchat']?></textarea>
            </div>
            <div class="clear"></div>
        </div>
        <div class="formRow">
            <label>Meta:</label>
            <div class="formRight">
                <textarea rows="8" cols="" title="meta" class="tipS" name="meta"><?=@$item['meta']?></textarea>
            </div>
            <div class="clear"></div>
        </div>
        <div class="formRow">
            <label>Script top :</label>
            <div class="formRight">
                <textarea rows="8" cols="" title="script top" class="tipS" name="scripttop"><?=@$item['scripttop']?></textarea>
            </div>
            <div class="clear"></div>
        </div>
        <div class="formRow">
            <label>Script bottom :</label>
            <div class="formRight">
                <textarea rows="8" cols="" title="script bottom" class="tipS" name="scriptbottom"><?=@$item['scriptbottom']?></textarea>
            </div>
            <div class="clear"></div>
        </div>
        <div class="formRow">
            <div class="formRight">
                <input type="hidden" name="id" id="id_this_setting" value="<?=@$item['id']?>" />
                <input type="submit" class="blueB" value="Hoàn tất" />
            </div>
            <div class="clear"></div>
        </div>
    </div>
</form>