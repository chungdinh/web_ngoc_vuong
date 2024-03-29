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
<div class="wrapper">
    <div class="control_frm" style="margin-top:25px;">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li>
                    <a href="index.php?com=product&act=add_list<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>">
                        <span>Thêm Danh mục cấp 1</span>
                    </a>
                </li>
                <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
    <form name="supplier" id="validate" class="form" action="index.php?com=product&act=save_list<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
        <div class="widget">
            <div class="title chonngonngu">
                <ul>
                    <?php foreach ($ar_lang as $key => $value): ?>
                    <li><a href="<?php echo $value['slug'] ?>" class="<?php echo $value['active'] ?> tipS validate[required]" title="Chọn <?php echo $value['ten'] ?>"><img src="./images/<?php echo $value['img'] ?>" alt="" class="tiengviet" />
                            <?php echo $value['ten'] ?></a></li>
                    <?php endforeach ?>
                </ul>
            </div>
            <?php if($config_images){ ?>
            <div class="formRow">
                <label>Ảnh đại diện :</label>
                <div class="formRight">
                    <input type="file" id="file" name="file" />
                    <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
                    <div class="note">
                        <?php echo 'Width :'._width_thumb*$ratio_.'px - Height :'._height_thumb*$ratio_.'px'?>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <?php if($_GET['act']=='edit_list'){ ?>
            <div class="formRow">
                <label>Hình Hiện Tại :</label>
                <div class="formRight">
                    <div class="note">
                        <img class="max-widht" src="../thumb/<?php echo _width_thumb.'x'._height_thumb.'/'._style_thumb.'/'._upload_product_l.$item['photo']?>" alt="NO PHOTO" />
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <?php }
            } if ($config_quangcao){ ?>
            <div class="formRow">
                <label> Hình Quảng Cáo :</label>
                <div class="formRight">
                    <input type="file" id="file" name="quangcao" />
                    <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
                    <div class="note">
                        <?php echo 'Width :'._width_thumb_qc*$ratio_.'px - Height :'._height_thumb_qc*$ratio_.'px'?>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <?php if($_GET['act']=='edit_list'){?>
            <div class="formRow">
                <label>Hình QC Hiện Tại :</label>
                <div class="formRight">
                    <div class="note">
                        <img class="max-widht" src="../thumb/<?php echo _width_thumb_qc.'x'._height_thumb_qc.'/'._style_thumb_qc.'/'._upload_product_l.$item['quangcao']?>" alt="NO PHOTO" />
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <?php } } if($config_link){ ?>
            <div class="formRow lang_hidden lang_vi active">
                <label>Link: </label>
                <div class="formRight">
                    <input type="text" name="links" title="Nhập link" id="links" class="tipS" value="<?=@$item['links']?>" />
                </div>
                <div class="clear"></div>
            </div>
            <?php } if($config_color){ ?>
            <div class="formRow">
                <label>
                    <?= $config_text_color ?>:
                </label>
                <div class="formRight">
                    <input type="text" class="color" name="color" title="Nhập màu" class="tipS validate[required]" value="<?=@$item['color']?>" size="15" />
                </div>
                <div class="clear"></div>
            </div>
            <?php } foreach ($ar_lang as $key => $value){
                if($config_ten){ ?>
            <div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
                <label>Tiêu đề: </label>
                <div class="formRight">
                    <input type="text" name="ten_<?php echo $value['slug'] ?>" title="Nhập tên danh mục <?php echo $value['ten'] ?>" id="ten_<?php echo $value['slug'] ?>" class="tipS validate[required]" value="<?=@$item['ten_'.$value['slug']]?>" />
                </div>
                <div class="clear"></div>
            </div>
            <?php } if ($config_title){ ?>
            <div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
                <label>Title </label>
                <div class="formRight">
                    <input type="text" name="name_<?php echo $value['slug'] ?>" title="Nhập tên danh mục <?php echo $value['ten'] ?>" id="name_<?php echo $value['slug'] ?>" class="tipS validate[required]" value="<?=@$item['name_'.$value['slug']]?>" />
                </div>
                <div class="clear"></div>
            </div>
            <?php } if($config_mota){ ?>
            <div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
                <label>Mô tả: </label>
                <div class="formRight">
                    <textarea rows="4" cols="" title="Nhập mô tả <?php echo $value['ten'] ?> " class="tipS" name="mota_<?php echo $value['slug'] ?>"><?=@$item['mota_'.$value['slug']]?>
                    </textarea>
                </div>
                <div class="clear"></div>
            </div>
            <?php }  
            } ?>
            <div class="formRow">
                <label>Hiển thị : <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>
                <div class="formRight">
                    <input type="checkbox" name="hienthi" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
                    <label>Số thứ tự: </label>
                    <input type="text" class="tipS" value="<?=isset($item[' stt'])?$item['stt']:1?>" name="stt" style="width:40px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="widget">
            <div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
                <h6>Nội dung seo</h6>
            </div>
            <div class="title chonngonngu">
                <ul>
                    <?php foreach ($ar_lang as $key => $value): ?>
                    <li><a href="<?php echo $value['slug'] ?>" class="<?php echo $value['active'] ?> tipS validate[required]" title="Chọn <?php echo $value['ten'] ?>"><img src="./images/<?php echo $value['img'] ?>" alt="" class="tiengviet" />
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
                <div class="formRight">
                    <input type="hidden" name="type" id="id_this_type" value="<?=$_REQUEST['type']?>" />
                    <input type="hidden" name="id" id="id_this_post" value="<?=@$item['id']?>" />
                    <input type="submit" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
                    <a href="index.php?com=product&act=man_list<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS" original-title="Thoát">Thoát</a>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </form>
</div>