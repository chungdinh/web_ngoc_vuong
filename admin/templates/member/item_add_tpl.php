<?php
function get_list_role($id=0){

	$sql="select * from table_user_role order by stt";
	$stmt=mysql_query($sql);
	$str='
	<select id="id_role" name="id_role" class="main_font">
	<option>Chọn nhóm thành viên</option>			
	';
	while ($row=@mysql_fetch_array($stmt)) 
	{
		if($row["id"]==$id)
			$selected="selected";
		else 
			$selected="";
		$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten"].'</option>';			
	}
	$str.='</select>';
	return $str;

}
?>
<div class="control_frm" style="margin-top:25px;">
	<div class="bc">
		<ul id="breadcrumbs" class="breadcrumbs">
			<li><a href="index.php?com=member&act=man"><span>Danh sách thành viên</span></a></li>
			<li class="current"><a href="#" onclick="return false;">Chỉnh sửa thành viên</a></li>
		</ul>
		<div class="clear"></div>
	</div>
</div>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
		$('#validate').submit();		
	}
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=member&act=save" method="post" enctype="multipart/form-data">	        
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/pencil.png" alt="" class="titleIcon" />
			<h6>Thông tin tài khoản</h6>
		</div>	

        <?php ?><div class="formRow">
            <label>Hình đại diện:</label>
            <div class="formRight">
                <img src="../thumb/265x265/2/<?=_upload_member_l.$item['photo']?>"  alt="NO PHOTO" class="avatar_member" />
              
            </div>
            <div class="clear"></div>                       
        </div>
                <?php  /*?>
        <div class="formRow">
            <label>Tải hình ảnh:</label>
            <div class="formRight">
                <input type="file" id="file" name="img" />
                <img src="./images/question-button.png" alt="Upload hình đại diện" class="icon_question tipS" original-title="Tải hình đại diện (ảnh JPEG , JPG , PNG)">
            </div>
            <div class="clear"></div>                       
        </div>	
       
        <div class="formRow">
        	<label>Tài khoản</label>
        	<div class="formRight">
        		<input id="username" type="text" value="<?=@$item['username']?>" name="username" title="Nhập tài khoản" <?php if($_GET['act']=='edit') echo 'readonly'; ?> class="tipS validate[required]" />
        	</div>
        	<div class="clear"></div>
        </div>
     <div class="formRow">
            <label>Mật khẩu</label>
            <div class="formRight">
                <input type="password" value="" name="password" title="Nhập mật khẩu" id="password" class="tipS <?php if($_GET['act']=='add'){ echo 'validate[required]'; } ?>" />
            </div>
            <div class="clear"></div>
        </div>
        <?php */?>
        <div class="formRow">
        	<label>Email</label>
        	<div class="formRight">
        		<input type="text" readonly value="<?=@$item['email']?>" name="email" title="Nhập email của bạn" class="tipS" />
        	</div>
        	<div class="clear"></div>
        </div>


        <div class="formRow">
        	<label>Họ tên</label>
        	<div class="formRight">
        		<input type="text" value="<?=@$item['ten']?>" name="ten" id='ten' title="Nhập họ tên của bạn" class="tipS validate[required]" />
        	</div>
        	<div class="clear"></div>
        </div>
        
        <div class="formRow hidden">
        	<label>Điểm tích lũy</label>
        	<div class="formRight">
        		<input type="text" value="<?=@$item['tichluy']?>" name="tichluy" title="Điểm tích lũy" class="tipS" />
        	</div>
        	<div class="clear"></div>
        </div>
        
        <div class="formRow">
        	<label>Giới tính</label>
        	<div class="formRight">
        		<input type="radio" name="sex" id="male" value="1" <?=(!isset($item['sex']) || $item['sex']==1)?'checked':''?>>
        		<label for="male">Nam</label>
        		<input type="radio" name="sex" id="female" value="0" <?=($item['sex']==0)?'checked':''?>>
        		<label for="female">Nữ</label>
        	</div>
        	<div class="clear"></div>
        </div>
        <div class="formRow">
        	<label>Điện thoại</label>
        	<div class="formRight">
        		<input type="text" value="<?=@$item['dienthoai']?>" name="dienthoai" title="Nhập điện thoại của bạn" class="tipS" />
        	</div>
        	<div class="clear"></div>
        </div>
        <div class="formRow">
        	<label>Địa chỉ</label>
        	<div class="formRight">
        		<input type="text" value="<?=@$item['diachi']?>" name="diachi" title="Nhập địa chỉ của bạn" class="tipS" />
        	</div>
        	<div class="clear"></div>
        </div>

		<!-- <div class="formRow">
			<label>Doanh Nghiệp</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['doanhnghiep_ten']?>" name="doanhnghiep_ten" title="Nhập tên doanh nghiệp" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>

		<div class="formRow">
			<label>Địa chỉ</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['doanhnghiep_diachi']?>" name="doanhnghiep_diachi" title="Nhập địa chỉ doanh nghiệp" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>

		<div class="formRow">
			<label>Mã số thuế</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['doanhnghiep_MST']?>" name="doanhnghiep_MST" title="Nhập MST doanh nghiệp" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
	-->





	<div class="formRow">
		<div class="formRight">
			<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
			<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
		</div>
		<div class="clear"></div>
	</div> 			
</div>


</form>   
<script>
	$(document).ready(function() {
		 //Chọn ngày sinh
		 $("#ngaysinh" ).datepicker({      
		 	dateFormat: 'dd/mm/yy',
		 	changeYear: true,
		 	closeText: "Close",
		 	yearRange: "1900:+nn",
		 });
		});	
	</script>