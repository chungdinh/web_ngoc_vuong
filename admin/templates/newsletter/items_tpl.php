<script>
    $(document).ready(function() {
        $("#chonhet").click(function(){
            var status=this.checked;
            $("input[name='chon']").each(function(){this.checked=status;});
        });
        $('.timkiem button').click(function(event) {
            var keyword = $(this).parent().find('input').val();
            window.location.href="index.php?com=newsletter&act=man&keyword="+keyword;
        });
        $("#send").click(function(){
            var listid="";
            $("input[name='chon']").each(function(){
                if (this.checked) listid = listid+","+this.value;
            })
    listid=listid.substr(1);     //alert(listid);
    if (listid=="") { alert("Bạn chưa chọn mục nào"); return false;}
    hoi= confirm("Xác nhận muốn gửi thư đi?");
    if (hoi==true){ document.frm.listid.value=listid; document.frm.submit();}
});
    });
</script>
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
            <li>
                <a href="index.php?com=newsletter&act=man<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>">
                    <?='<span>Quản lý '.$title_main.'</span>'?>
                </a>
            </li>
            <?php if($_GET['keyword']!=''){ ?>
            <li class="current">
                <a href="#" onclick="return false;">
                    <?='Kết quả tìm kiếm "'.$_GET['keyword'].' " '?>
                </a>
            </li>
            <?php }  else { ?>
            <li class="current"><a href="#" onclick="return false;">Quản lý email</a></li>
            <?php } ?>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<form name="frm" method="post" action="index.php?com=newsletter&act=send" enctype="multipart/form-data" id="f">
    <input type="hidden" name="listid" id="listid">
    <p>Chọn email mà bạn muốn gửi</p>
    <div class="widget">
        <div class="title"><span class="titleIcon">
                <input type="checkbox" id="titleCheck" name="titleCheck" />
            </span>
            <h6>Chọn tất cả</h6>
            <div class="timkiem">
                <input type="text" value="" placeholder="Nhập từ khóa tìm kiếm ">
                <button type="button" class="blueB" value="">Tìm kiếm</button>
            </div>
        </div>
        <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
            <tr style="text-align:center">
                <td></td>
                <?php if($config_ten) {?>
                <td class="sortCol">
                    <div>
                        <?=$config_text_ten ?><span></span>
                    </div>
                </td>
                <?php } if($config_dienthoai) {?>
                <td class="sortCol">
                    <div>
                        <?=$config_text_dienthoai ?><span></span>
                    </div>
                </td>
                <?php } if($config_email) {?>
                <td class="sortCol">
                    <div>
                        <?=$config_text_email ?><span></span>
                    </div>
                </td>
                <?php } if($config_noidung) {?>
                <td class="sortCol">
                    <div>
                        <?=$config_text_noidung ?><span></span>
                    </div>
                </td>
                <?php } if($config_diachi) {?>
                <td class="sortCol">
                    <div>
                        <?=$config_text_diachi ?> <span></span>
                    </div>
                </td>
                <?php } if($config_bonus) {?>
                <td class="sortCol">
                    <div>
                        <?=$config_text_bonus ?> <span></span>
                    </div>
                </td>
                <?php } ?>
                <td class="sortCol">
                    <div>Ngày gửi<span></span></div>
                </td>
                <td width="100">Thao tác</td>
            </tr>
            <?php for($i=0, $count=count($items); $i<$count; $i++){?>
            <tr style="text-align:center">
                <td style="width:2%;" align="center">
                    <input type="checkbox" name="chon" value="<?=$items[$i]['id']?>" class="chon" />
                </td>
                <?php if($config_ten) {?>
                <td style="width:12%;" align="center">
                    <b>
                        <?=$items[$i]['ten']?>
                    </b>
                </td>
                <?php } if($config_dienthoai) {?>
                <td style="width:10%;" align="center">
                    <b>
                        <?=$items[$i]['dienthoai']?>
                    </b>
                </td>
                <?php } if($config_email) {?>
                <td style="width:15%;" align="center">
                    <b>
                        <?=$items[$i]['email']?>
                    </b>
                </td>
                <?php } if($config_noidung) {?>
                <td style="width:15%;" align="center">
                    <b>
                        <?=$items[$i]['noidung']?>
                    </b>
                </td>
                <?php } if($config_diachi) {?>
                <td style="width:15%;" align="center">
                    <b>
                        <?=$items[$i]['diachi']?>
                    </b>
                </td>
                <?php } if($config_bonus) {?>
                <td style="width:15%;" align="center">
                    <b>
                        <?=$items[$i]['bonus']?>
                    </b>
                </td>
                <?php } ?>
                <td style="width:13%;" align="center">
                    <b>
                        <?=make_date($items[$i]['ngaytao'],'-','vi',true);?>
                    </b>
                </td>
                <td style="width:7%;">
                    <a href="index.php?com=newsletter&act=delete&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Xác nhận xóa')) return false;">
                        <img src="./images/icons/dark/close.png" alt="">
                    </a>
                </td>
            </tr>
            <?php   }?>
        </table>
    </div>
    <div class="widget">
        <div class="formRow">
            <label>File đính kèm:</label>
            <div class="formRight">
                <input type="file" id="file" name="file" />
                <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải File (rar|zip|doc|docx|xls|xlsx|ppt|pptx|pdf|png|jpg|jpeg|gif)">
            </div>
            <div class="clear"></div>
        </div>
        <div class="formRow form">
            <label>Tiêu đề</label>
            <div class="formRight">
                <input type="text" name="ten_vi" title="Nhập tiêu đề " id="ten_vi" class="tipS validate[required]" value="<?=@$item['ten_vi']?>" />
            </div>
            <div class="clear"></div>
        </div>
        <div class="formRow">
            <label>Nội Dung</label>
            <div class="ck_editor">
                <textarea id="noidung_vi" name="noidung_vi"><?=@$item['noidung_vi']?></textarea>
            </div>
            <div class="clear"></div>
        </div>
        <div class="formRow">
            <label></label>
            <div class="clear"></div>
            <input type="button" class="blueB" id="send" value="Gửi mail" />
        </div>
    </div>
</form>