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
            <li class="current"><a href="#" onclick="return false;">Thêm hình ảnh</a></li>
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
        <div class="title">
            <img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
            <h6>Thêm hình ảnh</h6>
        </div>
        <?php if ($config_linhvuc){ ?>
        <div class="formRow">
            <label>Chọn lĩnh vực </label>
            <div class="formRight">
                <?=get_linhvuc()?>
            </div>
            <div class="clear"></div>
        </div>
        <?php } if ($config_ten){ ?>
        <div class="formRow">
            <label>Tên: </label>
            <div class="formRight">
                <input type="text" name="ten_vi<?=$i?>" title="Nhập tên hình ảnh" id="name" class="tipS validate[required]" value="" />
            </div>
            <div class="clear"></div>
        </div>
        <?php } if ($config_images){ ?>
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
        <?php } if($config_link){ ?>
        <div class="formRow">
            <label>Link liên kết:</label>
            <div class="formRight">
                <input type="text" name="link<?=$i?>" value="" title="Nhập link liên kết cho hình ảnh" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>
        <?php } if($config_mota){ ?>
        <div class="formRow lang_hidden lang_vi active">
            <label>Mô tả</label>
            <div class="formRight">
                <textarea rows="4" cols="" title="Nhập mô tả . " class="tipS" name="mota"><?=@$item['mota']?></textarea>
            </div>
            <div class="clear"></div>
        </div>
        <?php } ?>
        <div class="formRow">
            <label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
            <div class="formRight">
                <input type="checkbox" name="active<?=$i?>" id="check1" value="1" checked="checked" />
                <label for="check1">Hiển thị</label>
            </div>
            <div class="clear"></div>
        </div>
        <div class="formRow">
            <label>Số thứ tự: </label>
            <div class="formRight">
                <input type="text" class="tipS" value="1" name="stt<?=$i?>" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của hình ảnh, chỉ nhập số">
            </div>
            <div class="clear"></div>
        </div>
        <div class="formRow">
            <div class="formRight">
                <input type="hidden" name="type" id="id_this_type" value="<?=$_REQUEST['type']?>" />
                <input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
            </div>
            <div class="clear"></div>
        </div>
    </div>
</form>