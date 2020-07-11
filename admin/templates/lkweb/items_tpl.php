<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
            <li>
                <a href="index.php?com=lkweb&act=man">
                    <span>Liên kết website</span>
                </a>
            </li>
            <li class="current">
                <a href="#" onclick="return false;">Tất cả</a>
            </li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script language="javascript">
    function CheckDelete(l){
    if(confirm('Bạn có chắc muốn xoá mục này?')){
      location.href = l;  
    }
  } 
  function ChangeAction(str){
    if(confirm("Bạn có chắc chắn?")){
      document.f.action = str;
      document.f.submit();
    }
  }   
</script>
<form name="f" id="f" method="post">
    <div class="control_frm" style="margin-top:0;">
        <div style="float:left;">
            <input type="button" class="blueB" value="Thêm" onclick="location.href='index.php?com=lkweb&act=add&type=<?=$_GET['type']?>'" />
            <input type="button" class="blueB" value="Xoá" onclick="ChangeAction('index.php?com=lkweb&act=man&multi=del&type=<?=$_GET['type']?>');return false;" />
        </div>
    </div>
    <div class="widget">
        <div class="title">
            <span class="titleIcon">
                <input type="checkbox" id="titleCheck" name="titleCheck" />
            </span>
            <h6>Danh sách liên kết web</h6>
        </div>
        <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
            <thead>
                <tr>
                    <td></td>
                    <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">Thứ tự</a></td>
                    <?php if ($config_ten) {?>
                    <td width="200">
                        <div>Tên<span></span></div>
                    </td>
                    <?php } if ($config_link) {?>
                    <td class="sortCol">
                        <div>Link <span></span></div>
                    </td>
                    <?php } if ($config_images) {?>
                    <td class="tb_data_small" style="width: 50px;">Hình</td>
                    <?php } ?>
                    <td class="tb_data_small">Ẩn/Hiện</td>
                    <td width="100">Thao tác</td>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="10">
                        <div class="pagination">
                            <?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?>
                        </div>
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <?php for($i=0, $count=count($items); $i<$count; $i++){?>
                <tr>
                    <td>
                        <input type="checkbox" name="iddel[]" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
                    </td>
                    <td align="center">
                        <input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText update_stt" original-title="Nhập số thứ tự danh mục" id="number<?=$items[$i]['id']?>" onchange="return updateNumber('lkweb', '<?=$items[$i]['id']?>')" />
                        <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
                    </td>
                    <?php if ($config_ten) {?>
                    <td>
                        <a href="index.php?com=lkweb&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" class="tipS SC_bold">
                            <?=$items[$i]['ten']?></a>
                    </td>
                    <?php } if ($config_link) {?>
                    <td class="title_name_data">
                        <a href="index.php?com=lkweb&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" class="tipS SC_bold">
                            <?=$items[$i]['url']?></a>
                    </td>
                    <?php } if ($config_images) {?>
                    <td class="title_name_data" style="width: 50px; text-align: center;background: #d0d0d06b">
                        <a href="index.php?com=lkweb&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" class="tipS SC_bold">
                            <img src="<?php echo _upload_hinhanh.$items[$i]['photo'] ?>" alt="" width="<?= _width_thumb ?>">
                        </a>
                    </td>
                    <?php } ?>
                    <td align="center">
                        <a data-val2="table_<?=$_GET['com']?>" rel="<?=$items[$i]['hienthi']?>" data-val3="hienthi" class="diamondToggle <?=($items[$i]['hienthi']==1)?" diamondToggleOff":""?>" data-val0="
                            <?=$items[$i]['id']?>" >
                        </a>
                    </td>
                    <td class="actBtns">
                        <a href="index.php?com=lkweb&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" title="" class="smallButton tipS" original-title="Sửa danh mục">
                            <img src="./images/icons/dark/pencil.png" alt="">
                        </a>
                        <a href="" onclick="CheckDelete('index.php?com=lkweb&act=delete&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>'); return false;" title="" class="smallButton tipS" original-title="Xóa danh mục">
                            <img src="./images/icons/dark/close.png" alt="">
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</form>