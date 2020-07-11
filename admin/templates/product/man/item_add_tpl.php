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
    $('.update_stt').keyup(function(event) {
        var id = $(this).attr('rel');
        var table = 'product_photo';
        var value = $(this).val();
        $.ajax({
            type: "POST",
            url: "ajax/update_stt.php",
            data: { id: id, table: table, value: value },
            success: function(result) {}
        });
    });
    $('.delete_images').click(function() {
        if (confirm('Bạn có muốn xóa hình này ko ? ')) {
            var id = $(this).attr('title');
            var table = 'product_photo';
            var links = "../upload/product/";
            $.ajax({
                type: "POST",
                url: "ajax/delete_images.php",
                data: { id: id, table: table, links: links },
                success: function(result) {}
            });
            $(this).parents('.item_trich').slideUp();
        }
        return false;
    });
    $('.themmoi').click(function(e) {
        $.ajax({
            type: "POST",
            url: "ajax/khuyenmai.php",
            success: function(result) {
                $('.load_sp').append(result);
            }
        });
    });
    $('.delete').click(function(e) {
        $(this).parent().remove();
    });
});
$(function() {
    $("#states").select2({
        tags: true,
        tokenSeparators: [",", " "],
        language: "vi",
        placeholder: "Từ khóa sản phẩm",
    });
    /*$("#states").change(function(){
            $tags = $(this).val();
            if($tags != 0){
                $("#tags_name").append("<p class='delete_tags'>"+$("#states option:selected").text()+"<input name='tags[]' value='"+$tags+"'  type='hidden' /> <span></span> </p>");
            }
            $(".delete_tags span").click(function(){
                $(this).parent().remove();
            });
        });
        $(".delete_tags span").click(function(){
            $(this).parent().remove();
        });*/
});
$(function() {
    $("#states2").select2();
    $("#states2").change(function() {
        $idtin = $(this).val();
        if ($idtin > 0) {
            $("#tags_name").append("<p class='delete_tags'>" + $("#states2 option:selected").text() + "<input name='idtin[]' value='" + $idtin + "'  type='hidden' /> <span></span> </p>");
        }
        $(".delete_tags span").click(function() {
            $(this).parent().remove();
        });
    });
    $(".delete_tags span").click(function() {
        $(this).parent().remove();
    });
});
</script>
<?php
function get_main_list(){
    global $item;
    $sql="select * from table_product_list where type='".$_GET['type']."' order by stt asc";
    $stmt=mysql_query($sql);
    $str='
    <select id="id_list" name="id_list" data-level="0" data-type="'.$_GET['type'].'" data-table="table_product_cat" data-child="id_cat" class="main_select select2 select_danhmuc">
    <option value="">Chọn danh mục 1</option>';
    while ($row=@mysql_fetch_array($stmt)) 
    {
        if($row["id"]==(int)@$item["id_list"])
            $selected="selected";
        else 
            $selected="";
        $str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';      
    }
    $str.='</select>';
    return $str;
}
function get_nhasanxuat(){
    global $item;
    $sql="select * from table_nhasanxuat order by stt asc";
    $stmt=mysql_query($sql);
    $str='
    <select style="width:300px;" id="state3" name="id_nsx" class="main_select
    select_danhmuc select2">
    <option value="">Chọn khu vực</option>';
    while ($row=@mysql_fetch_array($stmt)) 
    {
        if($row["id"]==(int)@$item["id_nsx"])
            $selected="selected";
        else 
            $selected="";
        $str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';      
    }
    $str.='</select>';
    return $str;
}
function get_main_cat(){
    global $item;
    $sql="select * from table_product_cat where id_list='".$item['id_list']."' and type='".$_GET['type']."' order by stt asc";
    $stmt=mysql_query($sql);
    $str='
    <select id="id_cat" name="id_cat" data-level="1" data-type="'.$_GET['type'].'" data-table="table_product_item" data-child="id_item" class="main_select select2 select_danhmuc">
    <option value="">Chọn danh mục 2</option>';
    while ($row=@mysql_fetch_array($stmt)) 
    {
        if($row["id"]==(int)@$item["id_cat"])
            $selected="selected";
        else 
            $selected="";
        $str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';      
    }
    $str.='</select>';
    return $str;
}
function get_main_item(){
    global $item;
    $sql="select * from table_product_item where id_cat='".$item['id_cat']."' and type='".$_GET['type']."' order by stt asc";
    $stmt=mysql_query($sql);
    $str='
    <select id="id_item" name="id_item" data-level="2" data-type="'.$_GET['type'].'" data-table="table_product_sub" data-child="id_sub" class="main_select select2  select_danhmuc">
    <option value="">Chọn danh mục 3</option>';
    while ($row=@mysql_fetch_array($stmt)) 
    {
        if($row["id"]==(int)@$item["id_item"])
            $selected="selected";
        else 
            $selected="";
        $str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';      
    }
    $str.='</select>';
    return $str;
}
function get_main_sub(){
    global $item;
    $sql="select * from table_product_sub where id_item='".$item['id_item']."' and type='".$_GET['type']."' order by stt asc";
    $stmt=mysql_query($sql);
    $str='
    <select id="id_sub" name="id_sub" class="main_select select2">
    <option value="">Chọn danh mục 3</option>';
    while ($row=@mysql_fetch_array($stmt)) 
    {
        if($row["id"]==(int)@$item["id_sub"])
            $selected="selected";
        else 
            $selected="";
        $str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';      
    }
    $str.='</select>';
    return $str;
}
if($item['idtin']!=''){
    $idtin = explode(",", $item['idtin']) ;
    $sql = "select id,ten_vi from #_baiviet where type='tintuc' and id<>'".$idtin[0]."'";
    for ($i=1,$count = count($idtin); $i < $count ; $i++) { 
        $sql .=" and id<> '".$idtin[$i]."'";
    }
}else{
    $sql = "select id,ten_vi from #_baiviet where type='tintuc'";
}
$d->query($sql);
$baiviet_arr = $d->result_array();
  //------------ tags-------------------------
$tags_arr = _result_array("select id,ten_vi from #_tags WHERE type like '".$_GET['type']."'");
  //------------end tags---------------
$sizes = _result_array( "select * from #_size where hienthi=1 AND type like '".$_GET['type']."' order by stt asc");
$mausacs = _result_array("select * from #_mausac where hienthi=1 AND type like '".$_GET['type']."' order by stt asc");
$lau = _result_array("SELECT ten_vi,id FROM table_option WHERE type like 'lau'");
$phong = _result_array("SELECT ten_vi,id FROM table_option WHERE type like 'phong'");
$huong = _result_array("SELECT ten_vi,id FROM table_option WHERE type like 'huong'");
$duan = _result_array("SELECT ten_vi,id FROM table_option WHERE type like 'duan'");
$dientich = _result_array("SELECT ten_vi,id FROM table_option WHERE type like 'dientich'");
function donvitien(){
    global $d,$item;
    $donvi = _result_array("SELECT ten,id FROM table_option WHERE hienthi = 1 AND type='donvi' ORDER BY stt ASC");
    $donvitien = '<option value="0">-- Chọn đơn vị tiền --</option>';
    foreach ($donvi as $key => $value) {
        $donvitien .= '
        <option value="'.$value['id'].'" ';
        if ($item['id_donvi'] == $value['id']) {
            $donvitien .= 'selected';
        }
        $donvitien .= '>'.$value['ten'].'</option>';
    }
    return $donvitien;
}
function huong(){
    global $d,$item;
    $h = _result_array("SELECT ten,id FROM table_option WHERE hienthi = 1 AND type='huong' ORDER BY stt ASC");
    $huong = '<option value="0">-- Chọn hướng --</option>';
    foreach ($h as $key => $value) {
        $huong .= '<option value="'.$value['id'].'" ';
        if ($item['id_huong'] == $value['id']) {
            $huong .= 'selected';
        }
        $huong .='>'.$value['ten'].'</option>';
    }
    return $huong;
}
function tinh(){
    global $d,$h,$item;
    $h = _result_array("SELECT ten_vi as ten,id FROM table_tinh WHERE hienthi = 1 ORDER BY stt ASC");
    $huong = '<option value="0">-- Chọn Tỉnh/Thành phố --</option>';
    foreach ($h as $key => $value) {
        $huong .= '<option value="'.$value['id'].'" ';
        if (@$item['id_tinh'] == $value['id']) {
            $huong .= 'selected';
        }
        $huong .='>'.$value['ten'].'</option>';
    }
    return $huong;
}
function quan(){
    global $d,$item;
    $quan = '';
    if ($item['id_tinh'] != 0) {
        $h = _result_array("SELECT ten_vi as ten,id FROM table_quan WHERE hienthi = 1 AND id_list = ".$item['id_tinh']." ORDER BY stt ASC");
        $quan .= '<option value="0">-- Chọn Quận/Huyện --</option>';
        foreach ($h as $key => $value) {
            $quan .= '  <option value="'.$value['id'].'" ';
            if (@$item['id_quan'] == $value['id']) {
                $quan .= 'selected';
            }
            $quan .= '>'.$value['ten'].'</option>';
        }
    } else {
        $quan .= '<option value="0">-- Chọn Quận/Huyện --</option>';
    }
    return $quan;
}
function phuong(){
    global $d,$item;
    $quan = '';
    if ($item['id_quan'] != 0) {
        $h = _result_array("SELECT ten_vi as ten,id FROM table_phuong WHERE hienthi = 1 AND id_cat = ".$item['id_quan']." ORDER BY stt ASC");
        $quan .= '<option value="0">-- Chọn Phường/Xã --</option>';
        foreach ($h as $key => $value) {
            $quan .= '  <option value="'.$value['id'].'" ';
            if ($item['id_quan'] == $value['id']) {
                $quan .= 'selected';
            }
            $quan .= '>'.$value['ten'].'</option>';
        }
    } else {
        $quan .= '<option value="0">-- Chọn Phường/Xã --</option>';
    }
    return $quan;
}
function duong(){
    global $d,$item;
    $quan = '';
    if ($item['id_quan'] != 0) {
        $h = _result_array("SELECT ten_vi as ten,id FROM table_duong WHERE hienthi = 1 AND id_cat = ".$item['id_quan']." ORDER BY stt ASC");
        $quan .= '<option value="0">-- Chọn đường --</option>';
        foreach ($h as $key => $value) {
            $quan .= '  <option value="'.$value['id'].'" ';
            if ($item['id_quan'] == $value['id']) {
                $quan .= 'selected';
            }
            $quan .= '>'.$value['ten'].'</option>';
        }
    } else {
        $quan .= '<option value="0">-- Chọn đường --</option>';
    }
    return $quan;
}
?>
<input type="hidden" id="id_list_hidden" value="<?=$_GET['id_list']?>">
<div class="wrapper">
    <div class="control_frm" style="margin-top:25px;">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="index.php?com=product&act=add_list<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Thêm
                            <?=$title_main?></span></a></li>
                <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
    <form name="supplier" id="validate" class="form" action="index.php?com=product&act=save<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
        <div class="widget">
            <div class="title chonngonngu">
                <ul>
                    <?php foreach ($ar_lang as $key => $value): ?>
                    <li><a href="<?php echo $value['slug'] ?>" class="<?php echo $value['active'] ?> tipS validate[required]" title="Chọn <?php echo $value['ten'] ?>"><img src="./images/<?php echo $value['img'] ?>" alt="" class="tiengviet" />
                            <?php echo $value['ten'] ?></a></li>
                    <?php endforeach ?>
                </ul>
            </div>
            <?php if($config_list){ ?>
            <div class="formRow">
                <label>Chọn danh mục 1</label>
                <div class="formRight">
                    <?=get_main_list()?>
                </div>
                <div class="clear"></div>
            </div>
            <?php } if($config_cat){ ?>
            <div class="formRow">
                <label>Chọn danh mục 2</label>
                <div class="formRight">
                    <?=get_main_cat()?>
                </div>
                <div class="clear"></div>
            </div>
            <?php } if($config_item){ ?>
            <div class="formRow">
                <label>Chọn danh mục 3</label>
                <div class="formRight">
                    <?=get_main_item()?>
                </div>
                <div class="clear"></div>
            </div>
            <?php } if($config_sub){ ?>
            <div class="formRow">
                <label>Chọn danh mục 4</label>
                <div class="formRight">
                    <?=get_main_sub()?>
                </div>
                <div class="clear"></div>
            </div>
            <?php } if($config_nhasanxuat){ ?>
            <div class="formRow">
                <label>Chọn khu vực</label>
                <div class="formRight">
                    <?=get_nhasanxuat()?>
                </div>
                <div class="clear"></div>
            </div>
            <?php } if ($config_bds){ ?>
            <div class="formRow">
                <label>Chọn tỉnh</label>
                <div class="formRight">
                    <select name="cbo_tinh" data-level="0" data-table="table_quan" data-target="cbo_quan" class="select2 select_diachi" id="cbo_tinh">
                        <?php echo tinh(); ?>
                    </select>
                </div>
                <div class="clear"></div>
            </div>
            <div class="formRow">
                <label>Chọn quận/huyện</label>
                <div class="formRight">
                    <select id="cbo_quan" data-level="1" name="cbo_quan" data-target="cbo_phuong" class="select2 select_diachi">
                        <?php echo quan(); ?>
                    </select>
                </div>
                <div class="clear"></div>
            </div>
            <div class="formRow">
                <label>Chọn phường/xã</label>
                <div class="formRight">
                    <select id="cbo_phuong" data-level="2" name="cbo_phuong" data-target="cbo_duong" class="select2 select_diachi">
                        <?php echo phuong(); ?>
                    </select>
                </div>
                <div class="clear"></div>
            </div>
            <div class="formRow">
                <label>Chọn đường</label>
                <div class="formRight">
                    <select id="cbo_duong" data-level="3" name="cbo_duong" class="select2 select_diachi">
                        <?php echo duong(); ?>
                    </select>
                </div>
                <div class="clear"></div>
            </div>
            <?php } if($config_images){?>
            <div class="formRow">
                <label>Tải hình ảnh:</label>
                <div class="formRight">
                    <input type="file" id="file" name="file" />
                    <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
                    <div class="note">
                        <?php echo ' Width: '._width_thumb*$ratio_.'px - Height: '._height_thumb*$ratio_.'px';?>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <?php if($_GET['act'] == 'edit'){?>
            <div class="formRow">
                <label>Hình Hiện Tại :</label>
                <div class="formRight">
                    <div>
                        <img class="max-widht" src="../thumb/<?php echo _width_thumb.'x'._height_thumb.'/'._style_thumb.'/'._upload_product_l.$item['photo']?>" alt="NO PHOTO" />
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <?php }
                    } ?>
            <?php /* ?>
            <div class="formRow">
                <label>Tải hình ảnh 2:</label>
                <div class="formRight">
                    <input type="file" id="file" name="photo_2" />
                    <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
                    <div class="note"> width :
                        <?php echo _width_thumb*$ratio_;?> px , Height :
                        <?php echo _height_thumb*$ratio_;?> px </div>
                </div>
                <div class="clear"></div>
            </div>
            <?php if($_GET['act']=='edit'){?>
            <div class="formRow">
                <label>Hình Hiện Tại 2:</label>
                <div class="formRight">
                    <div class="mt10"><img src="<?=_upload_product.$item['photo_2']?>" alt="NO PHOTO" width="100" /></div>
                </div>
                <div class="clear"></div>
            </div>
            <?php } ?>
            <?php */ ?>
            <?php if($config_mul){ ?>
            <div class="formRow">
                <label>Hình ảnh kèm theo: </label>
                <div class="formRight">
                    <a class="file_input" data-jfiler-name="files" data-jfiler-extensions="jpg, jpeg, png, gif"><img src="images/image_add.png" alt="" width="100"></a>
                    <?php if($act=='edit' && count($ds_photo)!=0){?>
                    <div class="clear_gal">
                        <?php for($i=0;$i<count($ds_photo);$i++){?>
                        <div class="item_trich">
                            <div class="border-box">
                                <div>
                                    <img class="img_trich" src="../thumb/148x135/2/<?=_upload_product_l.$ds_photo[$i]['photo']?>" />
                                    <a class="delete_images icon-jfi-trash jFiler-item-trash-action" title="<?=$ds_photo[$i]['id']?>" style="color:#FF0000"></a>
                                    <input type="text" rel="<?=$ds_photo[$i]['id']?>" value="<?=$ds_photo[$i]['stt']?>" class="update_stt tipS" />
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <?php }?>
                </div>
                <div class="clear"></div>
            </div>
            <?php } if ($config_motangan){ ?>
            <div class="formRow lang_hidden lang_vi active">
                <label id="txt_tieude_x">Mô tả ngắn</label>
                <div class="formRight">
                    <input type="text" name="mota_ngan" title="Nhập giá" id="mota_ngan" class="tipS" value="<?=@$item['mota_ngan']?>" />
                </div>
                <div class="clear"></div>
            </div>
            <?php } if($config_tags){ 
                $arr_tags = explode(',', @$item['tags']);
                ?>
            <div class="formRow">
                <label>Tags </label>
                <div class="formRight">
                    <select style="width:300px" multiple="" id="states" class="select2" name="tags[]">
                        <?php foreach ($tags_arr as $value) { ?>
                        <option value="<?=$value['id']?>" <?php if(in_array($value['id'], @$arr_tags)){echo 'selected' ;} ?> >
                            <?=$value["ten_vi"]?>
                        </option>
                        <?php }?>
                    </select>
                </div>
                <div class="clear"></div>
            </div>
            <?php } if($config_masp){ ?>
            <div class="formRow">
                <label id="txt_tieude_x">Mã sản phẩm</label>
                <div class="formRight">
                    <input type="text" name="masp" title="Nhập mã sản phẩm" id="masp" class="tipS validate[required]" value="<?=@$item['masp']?>" />
                </div>
                <div class="clear"></div>
            </div>
            <?php } if($config_diachi){ ?>
            <div class="formRow">
                <label id="txt_tieude_x">
                    <?php echo $config_text_diachi ?></label>
                <div class="formRight">
                    <input type="text" name="diachi" title="Nhập nội dung" id="diachi" class="tipS" value="<?=@$item['diachi']?>" />
                </div>
                <div class="clear"></div>
            </div>
            <?php } if($config_chudautu){ ?>
            <div class="formRow">
                <label id="txt_tieude_x">
                    <?php echo $config_text_chudautu ?></label>
                <div class="formRight">
                    <input type="text" name="chudautu" title="Nhập nội dung" id="chudautu" class="tipS" value="<?=@$item['chudautu']?>" />
                </div>
                <div class="clear"></div>
            </div>
            <?php } if($config_tiendo){ ?>
            <div class="formRow">
                <label id="txt_tieude_x">
                    <?php echo $config_text_tiendo ?></label>
                <div class="formRight">
                    <input type="text" name="tiendo" title="Nhập nội dung" id="tiendo" class="tipS" value="<?=@$item['tiendo']?>" />
                </div>
                <div class="clear"></div>
            </div>
            <?php } if($config_dientich){ ?>
            <div class="formRow">
                <label id="txt_tieude_x">
                    <?php echo $config_text_dientich ?></label>
                <div class="formRight">
                    <input type="text" name="dientich" title="Nhập nội dung" id="dientich" class="tipS" value="<?=@$item['dientich']?>" />
                </div>
                <div class="clear"></div>
            </div>
            <?php } if($config_giacu){ ?>
            <div class="formRow">
                <label id="txt_tieude_x">Giá</label>
                <div class="formRight">
                    <input type="text" name="giacu" title="Nhập giá bán" id="giacu" class="tipS" value="<?=@$item['giacu']?>" />
                </div>
                <div class="clear"></div>
            </div>
            <?php } if($config_giaban){ ?>
            <div class="formRow">
                <label id="txt_tieude_x">Giá KM</label>
                <div class="formRight">
                    <input type="text" name="giaban" title="Nhập giá bán" id="giaban" class="tipS" value="<?=@$item['giaban']?>" />
                </div>
                <div class="clear"></div>
            </div>
            <?php } ?>
            <?php if ($config_bds): ?>
            <div class="formRow">
                <label id="txt_tieude_x">Địa chỉ</label>
                <div class="formRight">
                    <input type="text" name="diachi" title="Nhập địa chỉ" id="diachi" class="tipS" value="<?=@$item['diachi']?>" />
                </div>
                <div class="clear"></div>
            </div>
            <div class="formRow">
                <label id="txt_tieude_x">Diện tích</label>
                <div class="formRight">
                    <input type="text" name="dientich" title="Nhập diện tích" id="dientich" class="tipS" value="<?=@$item['dientich']?>" />
                </div>
                <div class="clear"></div>
            </div>
            <div class="formRow">
                <label id="txt_tieude_x">Địa chỉ</label>
                <div class="formRight">
                    <input type="text" name="diachi" title="Nhập địa chỉ" id="diachi" class="tipS" value="<?=@$item['diachi']?>" />
                </div>
                <div class="clear"></div>
            </div>
            <div class="formRow">
                <label id="txt_tieude_x">Diện tích</label>
                <div class="formRight">
                    <input type="text" name="dientich" title="Nhập diện tích" id="dientich" class="tipS" value="<?=@$item['dientich']?>" />
                </div>
                <div class="clear"></div>
            </div>
            <div class="formRow">
                <label id="txt_tieude_x">Hướng</label>
                <div class="formRight">
                    <input type="text" name="huong" title="Nhập hướng" id="huong" class="tipS" value="<?=@$item['huong']?>" />
                </div>
                <div class="clear"></div>
            </div>
            <div class="formRow">
                <label id="txt_tieude_x">Lầu</label>
                <div class="formRight">
                    <input type="text" name="lau" title="Nhập lầu" id="lau" class="tipS" value="<?=@$item['lau']?>" />
                </div>
                <div class="clear"></div>
            </div>
            <div class="formRow">
                <label id="txt_tieude_x">Phòng</label>
                <div class="formRight">
                    <input type="text" name="phong" title="Nhập phòng" id="phong" class="tipS" value="<?=@$item['phong']?>" />
                </div>
                <div class="clear"></div>
            </div>
            <div class="formRow">
                <label id="txt_tieude_x">Dự án</label>
                <div class="formRight">
                    <input type="text" name="duan" title="Nhập dự án" id="duan" class="tipS" value="<?=@$item['duan']?>" />
                </div>
                <div class="clear"></div>
            </div>
            <?php endif ?>
            <?php if($config_size){ ?>
            <div class="formRow">
                <label>Chọn size</label>
                <div class="formRight">
                    <?php 
                                        $size = explode(',',$item['size']);
                                        for($i=0;$i<count($sizes);$i++){?>
                    <label><input type="checkbox" name="size[]" id="size_<?=$i?>" value="<?=$sizes[$i]['id']?>" <?php if(in_array($sizes[$i]['id'], $size)){ echo "checked='checked'" ;}?> />
                        <?=$sizes[$i]['ten_vi']?></label>
                    <?php } ?>
                </div>
                <div class="clear"></div>
            </div>
            <?php } if($config_mausac){ ?>
            <div class="formRow">
                <label>Chọn màu</label>
                <div class="formRight">
                    <?php 
                                            $mausac = explode(',',$item['mausac']);
                                            for($i=0;$i<count($mausacs);$i++){?>
                    <label style="color:<?=$mausacs[$i]['color']?>"><input type="checkbox" name="mausac[]" id="mausac_<?=$i?>" value="<?=$mausacs[$i]['id']?>" <?php if(in_array($mausacs[$i]['id'], $mausac)){ echo "checked='checked'" ;}?> />
                        <?=$mausacs[$i]['ten_vi']?></label>
                    <?php } ?>
                </div>
                <div class="clear"></div>
            </div>
            <?php } foreach ($ar_lang as $key => $value){ 
                                        if($config_ten){ ?>
            <div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
                <label>Tiêu đề <br>
                    <?php echo $value['ten'] ?></label>
                <div class="formRight">
                    <input type="text" name="ten_<?php echo $value['slug'] ?>" title="Nhập tên danh mục <?php echo $value['ten'] ?>" id="ten_<?php echo $value['slug'] ?>" class="tipS validate[required]" value="<?=@$item['ten_'.$value['slug']]?>" />
                </div>
                <div class="clear"></div>
            </div>
            <?php } if($config_mota){ ?>
            <div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
                <label id="txt_tieude_x">Mô tả<br>
                    <?php echo $value['ten'] ?></label>
                <div <?php if($config_mota_ckeditor){ ?> class="ck_editor"
                    <?php } else{ ?> class="formRight"
                    <?php }?>>
                    <textarea rows="5" id="mota_<?php echo $value['slug'] ?>" name="mota_<?php echo $value['slug'] ?>"><?=@$item['mota_'.$value['slug']]?></textarea>
                </div>
                <div class="clear"></div>
            </div>
            <?php 
                                                }if($config_noidung){ ?>
            <div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
                <label>Nội dung
                    <?php echo $value['ten'] ?></label>
                <div class="ck_editor">
                    <textarea id="noidung_<?php echo $value['slug'] ?>" name="noidung_<?php echo $value['slug'] ?>"><?=@$item['noidung_'.$value['slug']]?></textarea>
                </div>
                <div class="clear"></div>
            </div>
            <?php } if($config_thongso){ ?>
            <div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
                <label>Thông số
                    <?php echo $value['ten'] ?></label>
                <div class="ck_editor">
                    <textarea id="thongso_<?php echo $value['slug'] ?>" name="thongso_<?php echo $value['slug'] ?>"><?=@$item['thongso_'.$value['slug']]?></textarea>
                </div>
                <div class="clear"></div>
            </div>
            <?php } 
                                                    } ?>
            <div class="formRow">
                <label>Hiển thị : <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! ">
                    <input type="checkbox" name="hienthi" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
                                                        </label>
                                                        <div class="formRight">         
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
            <a href="index.php?com=product&act=man<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS" original-title="Thoát">Thoát</a>
        </div>
        <div class="clear"></div>
    </div>
</div>
</form>
</div>
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