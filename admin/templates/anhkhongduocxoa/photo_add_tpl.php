<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
           <li><a href="index.php?com=anhkhongduocxoa&act=man_photo<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span><?=$title_main?></span></a></li>
           <li class="current"><a href="#" onclick="return false;">Thêm hình ảnh</a></li>
       </ul>
       <div class="clear"></div>
   </div>
</div>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
        $('#validate').submit();		
    }	
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=anhkhongduocxoa&act=save_photo<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
	<div class="widget">
        <div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
         <h6>Thêm hình ảnh</h6>
     </div>
     <div class="formRow">
         <label>Tên hình ảnh (vi)</label>
         <div class="formRight">
            <input type="text" name="ten_vi<?=$i?>" title="Nhập tên hình ảnh" id="name" class="tipS validate[required]" value="" />
        </div>
        <div class="clear"></div>
    </div>		                     

    <div class="formRow">
     <label>Tải hình ảnh:</label>
     <div class="formRight">
       <input type="file" id="file" name="file_vi" />
       <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
       <span class="note">width : <?php echo _width_thumb*$ratio_;?>px  - Height : <?php echo _height_thumb*$ratio_;?>px</span>
   </div>
   <div class="clear"></div>
</div>
<?php if($links_=='true'){?>
<div class="formRow">
    <label>Link liên kết:</label>
    <div class="formRight">
        <input type="text" id="code_pro" name="link<?=$i?>" value=""  title="Nhập link liên kết cho hình ảnh" class="tipS" />
    </div>
    <div class="clear"></div>
</div>
<?php }  ?>
<?php if($config_mota=='true'){ ?>
<div class="formRow lang_hidden lang_vi active">
    <label>Mô tả</label>
    <div class="formRight">
        <textarea rows="4" cols="" title="Nhập mô tả . " class="tipS" name="mota"><?=@$item['mota']?></textarea>
    </div>
    <div class="clear"></div>
</div>
<?php } ?>
<?php if($config_map=='true'){?>
<div class="formRow">
    <label>Map :</label>
    <div class="formRight">
        <select name="mapx<?=$i?>" class="main_select select_danhmuc" style='float: left'>
            <option value="11">1x - 1y</option>
            <option value="12">1x - 2y</option>
            <option value="13">1x - 3y</option>
            <option value="21">2x - 1y</option>
            <option value="22">2x - 2y</option>
            <option value="23">2x - 3y</option>
            <option value="31">3x - 1y</option>
            <option value="32">3x - 2y</option>
        </select>
        <div class="note">X : 140px , Y : 140px</div>
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