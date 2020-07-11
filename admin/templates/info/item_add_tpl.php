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
    $('.delete_images').click(function() {
        if (confirm('Bạn có muốn xóa hình này ko ? ')) {
            var id = $(this).attr('title');
            var table = 'baiviet_photo';
            var links = "../upload/baiviet/";
            $.ajax({
                type: "POST",
                url: "ajax/delete_images.php",
                data: { id: id, table: table, links: links },
                success: function(result) {}
            });
            $(this).parent().slideUp();
        }
        return false;
    });
    $('.update_stt').keyup(function(event) {
        var id = $(this).attr('rel');
        var table = 'baiviet_photo';
        var value = $(this).val();
        $.ajax({
            type: "POST",
            url: "ajax/update_stt.php",
            data: { id: id, table: table, value: value },
            success: function(result) {}
        });
    });
});
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=info&act=save<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
    <div class="control_frm" style="margin-top:25px;">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li>
                    <a href="index.php?com=info&act=capnhat<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>">
                        <span>
                            <?='Cập nhật '.$title_main?>
                        </span>
                    </a>
                </li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
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
            <label>Tải hình ảnh:</label>
            <div class="formRight">
                <input type="file" id="file" name="file" />
                <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
                <div class="note"> Kích thước:
                    <?php echo ' Width :'._width_thumb*$ratio_,'px - Height :'._height_thumb*$ratio_.'px';?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="formRow">
            <label>Hình Hiện Tại :</label>
            <div class="formRight">
                <div class="mt10">
                    <img src="<?=_upload_hinhanh.$item['photo']?>" alt="Image" width="<?php echo _width_thumb;?>" />
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <?php } if($config_mul){ ?>
        <div class="formRow">
            <label>Hình ảnh kèm theo: </label>
            <div class="formRight">
                <a class="file_input" data-jfiler-name="files" data-jfiler-extensions="jpg, jpeg, png, gif"><img src="images/image_add.png" alt="" width="100"></a>
                <?php if(count($ds_photo)!=0){?>
                <div class="clear_gal">
                    <?php for($i=0;$i<count($ds_photo);$i++){ $size = getimagesize(_upload_baiviet.$ds_photo[$i]['photo']); ?>
                    <div class="item_trich">
                        <div class="border-box">
                            <div>
                                <img class="img_trich" src="../thumb/148x135/2/<?=_upload_baiviet_l.$ds_photo[$i]['photo']?>" />
                                <a class="delete_images icon-jfi-trash jFiler-item-trash-action" title="<?=$ds_photo[$i]['id']?>" style="color:#FF0000"></a>
                                <input type="text" rel="<?=$ds_photo[$i]['id']?>" value="<?=$ds_photo[$i]['stt']?>" class="update_stt tipS" />
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <?php }?>
                <div class="note">Kích thước:
                    <?php echo ' Width :'._width_thumb*$ratio_,'px - Height :'._height_thumb*$ratio_.'px';?>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <?php } foreach ($ar_lang as $key => $value){
         if($config_ten){ ?>
        <div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
            <label>Tiêu đề <br />
                <?php echo $value['ten']; ?> </label>
            <div class="formRight">
                <input type="text" name="ten_<?php echo $value['slug'] ?>" title="Nhập tên" id="ten_<?php echo $value['slug'] ?>" class="tipS validate[required]" value="<?=@$item['ten_'.$value['slug']]?>" />
            </div>
            <div class="clear"></div>
        </div>
        <?php } if($config_mota){ ?>
        <div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
            <label>Mô tả <br />
                <?php echo $value['ten']; ?> </label>
            <div <?php if($config_mota_ckeditor){ ?> class="ck_editor"
                <?php } else { ?> class="formRight"
                <?php } ?> >
                <textarea id="mota_<?php echo $value['slug'] ?>" rows="5" name="mota_<?php echo $value['slug'] ?>"><?=@$item['mota_'.$value['slug']]?></textarea>
            </div>
            <div class="clear"></div>
        </div>
        <?php } if($config_noidung){ ?>
        <div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
            <label>Nội Dung <br />
                <?php echo $value['ten']; ?> </label>
            <div class="ck_editor">
                <textarea id="noidung_<?php echo $value['slug'] ?>" name="noidung_<?php echo $value['slug'] ?>"><?=@$item['noidung_'.$value['slug']]?></textarea>
            </div>
            <div class="clear"></div>
        </div>
        <?php }
         } if($config_links){ ?>
        <div class="formRow">
            <label>Video Hiện Tại :</label>
            <div class="formRight">
                <object width="300" height="200">
                    <param name="movie" value="//www.youtube.com/v/<?=youtobi($item['links'])?>?version=3&amp;hl=vi_VN&amp;rel=0">
                    </param>
                    <param name="allowFullScreen" value="true">
                    </param>
                    <param name="allowscriptaccess" value="always">
                    </param><embed src="//www.youtube.com/v/<?=youtobi($item['links'])?>?version=3&amp;hl=vi_VN&amp;rel=0" type="application/x-shockwave-flash" width="300" height="200" allowscriptaccess="always" allowfullscreen="true" wmode="transparent"></embed></object>
            </div>
            <div class="clear"></div>
        </div>
        <div class="formRow lang_hidden lang_en active">
            <label>Link youtube</label>
            <div class="formRight">
                <input type="text" name="links" title="Nhập link youtube" id="links" class="tipS" value="<?=@$item['links']?>" />
            </div>
            <div class="clear"></div>
        </div>
        <?php } ?>
    </div>
    <div class="formRow">
        <label>Hiển thị : <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>
        <div class="formRight">
            <input type="checkbox" name="hienthi" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
        </div>
        <div class="clear"></div>
    </div>      
    <div class="widget">
        <div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
            <h6>Nội dung seo</h6>
        </div>
        <div class="title chonngonngu">
            <ul>
                <?php foreach ($ar_lang as $key => $value): ?>
                <li><a href="<?php echo $value[' slug'] ?>" class="
            <?php echo $value['active'] ?> tipS validate[required]" title="Chọn
            <?php echo $value['ten'] ?>"><img src="./images/<?php echo $value['img'] ?>" alt="" class="tiengviet" />
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
                <input type="hidden" name="id_cat" id="id_this_product" value="<?=@$item['id_cat']?>" />
                <input type="submit" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
            </div>
            <div class="clear"></div>
        </div>
    </div>
</form>
<script>
$(document).ready(function() {
    $('.file_input').filer({
        showThumbs: true,
        templates: {
            box: '<ul class="jFiler-item-list"></ul>',
            item: '<li class="jFiler-item">\
                                                <div class="jFiler-item-container">\
                                                <div class="jFiler-item-inner">\
                                                <div class="jFiler-item-thumb">\
                                                <div class="jFiler-item-status"></div>\
                                                <div class="jFiler-item-info">\
                                                <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                                </div>\
                                                {{fi-image}}\
                                                </div>\
                                                <div class="jFiler-item-assets jFiler-row">\
                                                <ul class="list-inline pull-left">\
                                                <li><span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span></li>\
                                                </ul>\
                                                <ul class="list-inline pull-right">\
                                                <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                                </ul>\
                                                </div>\<input type="text" name="stthinh[]" class="stthinh" placeholder="Nhập STT" />\
                                                </div>\
                                                </div>\
                                                </li>',
            itemAppend: '<li class="jFiler-item">\
                                                <div class="jFiler-item-container">\
                                                <div class="jFiler-item-inner">\
                                                <div class="jFiler-item-thumb">\
                                                <div class="jFiler-item-status"></div>\
                                                <div class="jFiler-item-info">\
                                                <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                                </div>\
                                                {{fi-image}}\
                                                </div>\
                                                <div class="jFiler-item-assets jFiler-row">\
                                                <ul class="list-inline pull-left">\
                                                <span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span>\
                                                </ul>\
                                                <ul class="list-inline pull-right">\
                                                <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                                </ul>\
                                                </div>\<input type="text" name="stthinh[]" class="stthinh" placeholder="Nhập STT" />\
                                                </div>\
                                                </div>\
                                                </li>',
            progressBar: '<div class="bar"></div>',
            itemAppendToEnd: true,
            removeConfirmation: true,
            _selectors: {
                list: '.jFiler-item-list',
                item: '.jFiler-item',
                progressBar: '.bar',
                remove: '.jFiler-item-trash-action',
            }
        },
        addMore: true
    });
});
</script>