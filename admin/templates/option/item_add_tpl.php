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
                <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
    <form name="supplier" id="validate" class="form" action="index.php?com=option&act=save&type=<?php echo $_GET['type'] ?>&id=<?php echo $_GET['id'] ?>" method="post" enctype="multipart/form-data">
        <div class="widget">
            <div class="title chonngonngu">
                <ul>
                    <?php foreach ($ar_lang as $key => $value): ?>
                    <li><a href="<?php echo $value['slug'] ?>" class="<?php echo $value['active'] ?> tipS validate[required]" title="Chọn <?php echo $value['ten'] ?>"><img src="./images/<?php echo $value['img'] ?>" alt="" class="tiengviet" />
                            <?php echo $value['ten'] ?></a></li>
                    <?php endforeach ?>
                </ul>
            </div>
            <!-- <div class="title chonngonngu">
    <ul>
        <li><a href="vi" class="active tipS validate[required]" title="Chọn tiếng việt "><img src="./images/vi.png" alt="" class="tiengviet" /></a></li>
    </ul>
</div> -->
            <?php foreach ($ar_lang as $key => $value){ ?>
            <?php if ($config_ten){ ?>
            <div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
                <label>Tiêu đề:</label>
                <div class="formRight">
                    <input type="text" name="ten_<?php echo $value['slug'] ?>" title="Nhập tên danh mục <?php echo $value['ten'] ?>" id="ten_<?php echo $value['slug'] ?>" class="tipS validate[required]" value="<?=@$item['ten_'.$value['slug']]?>" />
                </div>
                <div class="clear"></div>
            </div>
            <?php } if ($config_noidung){ ?>
            <div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
                <label>Nội Dung: </label>
                <div class="formRight">
                    <textarea rows="4" title="Nhập dữ liệu <?php echo $value['ten'] ?> " class="tipS" name="noidung_<?php echo $value['slug'] ?>"><?=@$item['noidung_'.$value['slug']]?></textarea>
                </div>
                <div class="clear"></div>
            </div>
            <?php } } ?>
            <div class="formRow">
                <label>Hiển thị : <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>
                <div class="formRight">
                    <input type="checkbox" name="hienthi" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
                    <label>Số thứ tự: </label>
                    <input type="text" class="tipS" value="<?=isset($item[' stt'])?$item['stt']:1?>" name="stt" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="widget">
            <div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
                <h6></h6>
            </div>
            <div class="formRow">
                <div class="formRight">
                    <input type="hidden" name="type" id="id_this_type" value="<?=$_REQUEST['type']?>" />
                    <input type="hidden" name="id" id="id_this_post" value="<?=@$item['id']?>" />
                    <input type="submit" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
                    <a href="index.php?com=option&act=man<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS" original-title="Thoát">Thoát</a>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </form>
</div>