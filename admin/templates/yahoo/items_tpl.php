<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
            <li><a href="index.php?com=yahoo&act=man"><span>Hỗ trợ trực tuyến</span></a></li>
            <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script language="javascript">
    function CheckDelete(l){
    if(confirm('Bạn có chắc muốn xoá mục này?'))
    {
      location.href = l;  
    }
  } 
  function ChangeAction(str){
    if(confirm("Bạn có chắc chắn?"))
    {
      document.f.action = str;
      document.f.submit();
    }
  }   
</script>
<form name="f" id="f" method="post">
    <div class="control_frm" style="margin-top:0;">
        <div style="float:left;">
            <input type="button" class="blueB" value="Thêm" onclick="location.href='index.php?com=yahoo&act=add&type=<?=$_GET['type']?>'" />
        </div>
    </div>
    <div class="widget">
        <div class="title"><span class="titleIcon">
                <input type="checkbox" id="titleCheck" name="titleCheck" />
            </span>
            <h6>Danh sách nick hỗ trợ hiện có</h6>
        </div>
        <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
            <thead>
                <tr>
                    <td style="width: 2%!important;"></td>
                    <td class="tb_data_small" style="width: 2%;"><a href="#" class="tipS">STT</a></td style="width: 3%;">
                    <?php if ($config_ten){ ?>
                    <td class="sortCol" style="width: 15%;">
                        <div>
                            <?php echo $config_text_ten ?><span></span>
                        </div>
                    </td>
                    <?php } if ($config_dienthoai) {?>
                    <td class="sortCol" style="width: 12%;">
                        <div>
                            <?php echo $config_text_dienthoai ?><span></span>
                        </div>
                    </td>
                    <?php } if ($config_email) {?>
                    <td class="sortCol" style="width: 15%;">
                        <div>
                            <?php echo $config_text_email ?><span></span>
                        </div>
                    </td>
                    <?php } if ($config_skype) {?>
                    <td class="sortCol" style="width: 15%;">
                        <div>
                            <?php echo $config_text_skype ?><span></span>
                        </div>
                    </td>
                    <?php } if ($config_yahoo) {?>
                    <td class="sortCol" style="width: 15%;">
                        <div>
                            <?php echo $config_text_yahoo ?><span></span>
                        </div>
                    </td>
                    <?php } if ($config_viber) {?>
                    <td class="sortCol" style="width: 15%;">
                        <div>
                            <?php echo $config_text_viber ?><span></span>
                        </div>
                    </td>
                    <?php } ?>
                    <td style="width: 2%!important;" class="tb_data_small">Ẩn/Hiện</td>
                    <td style="width: 7%!important;">Thao tác</td>
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
                        <input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText" original-title="Nhập số thứ tự danh mục" id="number<?=$items[$i]['id']?>" onchange="return updateNumber('yahoo', '<?=$items[$i]['id']?>')" />
                        <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
                    </td>
                    <?php if ($config_ten) {?>
                    <td>
                        <a href="index.php?com=yahoo&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" class="tipS SC_bold">
                            <?=$items[$i]['ten_vi']?></a>
                    </td>
                    <?php } if ($config_dienthoai) {?>
                    <td class="title_name_data">
                        <a href="index.php?com=yahoo&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" class="tipS SC_bold">
                            <?=$items[$i]['dienthoai']?></a>
                    </td>
                    <?php } if ($config_email) {?>
                    <td class="title_name_data">
                        <a href="index.php?com=yahoo&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" class="tipS SC_bold">
                            <?=$items[$i]['email']?></a>
                    </td>
                    <?php } if ($config_skype) {?>
                    <td class="title_name_data">
                        <a href="index.php?com=yahoo&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" class="tipS SC_bold">
                            <?=$items[$i]['skype']?></a>
                    </td>
                    <?php } if ($config_yahoo) {?>
                    <td class="title_name_data">
                        <a href="index.php?com=yahoo&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" class="tipS SC_bold">
                            <?=$items[$i]['yahoo']?></a>
                    </td>
                    <?php } if ($config_viber) {?>
                    <td class="title_name_data">
                        <a href="index.php?com=yahoo&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" class="tipS SC_bold">
                            <?=$items[$i]['viber']?></a>
                    </td>
                    <?php }?>
                    <td align="center">
                        <?php if(@$items[$i]['hienthi']==1){?>
                        <a href="index.php?com=yahoo&act=man&hienthi=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" title="" class="smallButton tipS" original-title="Click để ẩn"><img src="./images/icons/color/tick.png" alt=""></a>
                        <?php } else { ?>
                        <a href="index.php?com=yahoo&act=man&hienthi=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" title="" class="smallButton tipS" original-title="Click để hiện"><img src="./images/icons/color/hide.png" alt=""></a>
                        <?php } ?>
                    </td>
                    <td class="actBtns">
                        <a href="index.php?com=yahoo&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" title="" class="smallButton tipS" original-title="Sửa danh mục"><img src="./images/icons/dark/pencil.png" alt=""></a>
                        <a href="" onclick="CheckDelete('index.php?com=yahoo&act=delete&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>'); return false;" title="" class="smallButton tipS" original-title="Xóa danh mục"><img src="./images/icons/dark/close.png" alt=""></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</form>