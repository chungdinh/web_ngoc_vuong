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
<?php 
function get_linhvuc()
{ 
  global $item;
  $sql="select * from table_linhvuc where hienthi = 1";
  $stmt=mysql_query($sql);
  $str='
  <select id="id_linhvuc" name="id_linhvuc" class="main_select select2" data-target="id_list" data-type="'.$_GET['type'].'" data-table="table_baiviet_list">
  <option value="">Chọn lĩnh vực</option>';
  while ($row=@mysql_fetch_array($stmt)) 
  {
    if($row["id"]==(int)@$item["id_linhvuc"])
      $selected="selected";
  else 
      $selected="";
  $str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';      
}
$str.='</select>';
return $str;
}
?>
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
            <li>
                <a href="index.php?com=photo&act=man_photo<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>">
                    <span>
                        <?='Quản Lý '.$title_main?>
                    </span>
                </a>
            </li>
            <li class="current"><a href="#" onclick="return false;">Sửa hình ảnh</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">
function TreeFilterChanged2() {
    $('#validate').submit();
}
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=photo&act=save_photo<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
    <div class="widget">
        <div class="title chonngonngu">
            <ul>
                <?php foreach ($ar_lang as $key => $value): ?>
                <li>
                    <a href="<?php echo $value['slug'] ?>" class="<?php echo $value['active'] ?> tipS validate[required]" title="Chọn <?php echo $value['ten'] ?>">
                        <img src="./images/<?php echo $value['slug'] ?>.png" alt="" class="tiengviet" />
                        <?php echo $value['ten'] ?>
                    </a>
                </li>
                <?php endforeach ?>
            </ul>
        </div>
        <div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
            <h6>Sửa hình ảnh</h6>
        </div>
        <?php if ($config_linhvuc){ ?>
        <div class="formRow">
            <label>Chọn lĩnh vực </label>
            <div class="formRight">
                <?=get_linhvuc()?>
            </div>
            <div class="clear"></div>
        </div>
        <?php } if ($config_ten) {
              foreach ($ar_lang as $key => $value){ ?>
        <div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
            <label>Tên: </label>
            <div class="formRight">
                <input type="text" name="ten_<?php echo $value['slug'] ?>" title="Nhập tên hình ảnh <?php echo $value['ten'] ?>" id="name_<?php echo $value['slug'] ?>" class="tipS" value="<?=@$item['ten_'.$value['slug']]?>" />
            </div>
            <div class="clear"></div>
        </div>
        <?php } } if($config_link){?>
        <div class="formRow">
            <label>Link liên kết: </label>
            <div class="formRight">
                <input type="text" name="link" class="tipS" value="<?=@$item['link']?>" title="Nhập link liên kết cho hình ảnh" />
            </div>
            <div class="clear"></div>
        </div>
        <?php } if($config_mota){ ?>
        <div class="formRow lang_hidden lang_vi active">
            <label>Mô tả</label>
            <div class="formRight">
                <textarea rows="4" cols="" title="Nhập mô tả" class="tipS" name="mota"><?=@$item['mota']?></textarea>
            </div>
            <div class="clear"></div>
        </div>
        <?php } if($config_images){ ?>
        <div class="formRow">
            <label>Tải hình ảnh:</label>
            <div class="formRight">
                <input type="file" id="file" name="file_vi" />
                <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
                <span class="note">
                    <?php echo ' Width: '._width_thumb*$ratio_.'px - Height: '._height_thumb*$ratio_.'px';?>
                </span>
            </div>
            <div class="clear"></div>
        </div>
        <div class="formRow">
            <label>Hình ảnh hiện tại :</label>
            <div class="formRight">
                <div>
                    <img style="max-width: 100%;" src=" ../thumb/<?php echo _width_thumb.'x'._height_thumb.'/1/'._upload_hinhanh_l.$item['photo_vi']?>" alt="" />
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <?php } ?>
        <div class="formRow">
            <label>Hiển thị: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
            <div class="formRight">
                <input type="checkbox" name="active" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />      
                </div>
                <div class="clear"></div>
            </div>
            <div class="formRow">
              <label>Số thứ tự: </label>
              <div class="formRight">
                <input type="text" class="tipS" value="<?=isset($item[' stt'])?$item['stt']:1?>" name="stt" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của hình ảnh, chỉ nhập số">
            </div>
            <div class="clear"></div>
        </div>
        <div class="formRow">
            <div class="formRight">
                <input type="hidden" name="type" id="id_this_type" value="<?=$_REQUEST['type']?>" />
                <input type="hidden" name="id" id="id_this_photo" value="<?=@$item['id']?>" />
                <input type="submit" class="blueB" value="Hoàn tất" />
            </div>
            <div class="clear"></div>
        </div>
    </div>
</form>