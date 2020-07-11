<script type="text/javascript">	
	function TreeFilterChanged2(){
		
		$('#validate').submit();
	}
</script>

<script type="text/javascript">		

	$(document).ready(function() {
		$('.chonngonngu li a').click(function(event) {
			var lang = $(this).attr('href');
			$('.chonngonngu li a').removeClass('active');
			$(this).addClass('active');
			$('.lang_hidden').removeClass('active');
			$('.lang_'+lang).addClass('active');
			return false;
		});
	});
</script>
<div class="wrapper">
	<div class="control_frm" style="margin-top:25px;">
		<div class="bc">
			<ul id="breadcrumbs" class="breadcrumbs">
				<li><a href="index.php?com=diachi&act=man"><span>Địa chỉ</span></a></li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>
	<form name="supplier" id="validate" class="form" action="index.php?com=diachi&act=save&type=<?=$_GET['type']?>" method="post" enctype="multipart/form-data">
		<div class="widget">
			<div class="title chonngonngu">
				<ul>
					<?php foreach ($ar_lang as $key => $value): ?>
						<li><a href="<?php echo $value['slug'] ?>" class="<?php echo $value['active'] ?> tipS validate[required]" title="Chọn <?php echo $value['ten'] ?>"><img src="./images/<?php echo $value['slug'] ?>.png" alt="" class="tiengviet" /><?php echo $value['ten'] ?></a></li>
					<?php endforeach ?>
				</ul>
			</div>	
			<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
				<h6>Nhập dữ liệu</h6>
			</div>		
			<?php foreach ($ar_lang as $key => $value): ?>
				<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
					<label>Tên <?php echo $value['ten'] ?></label>
					<div class="formRight">
						<input type="text" name="ten_<?php echo $value['slug'] ?>" title="Nhập tên địa chỉ" id="ten_<?php echo $value['slug'] ?>" class="tipS " value="<?=@$item['ten_'.$value['slug']]?>" />
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
					<label>Địa chỉ <?php echo $value['ten'] ?></label>
					<div class="formRight">
						<input type="text" name="diachi_<?php echo $value['slug'] ?>" title="Nhập địa chỉ" id="diachi_<?php echo $value['slug'] ?>" class="tipS " value="<?=@$item['diachi_'.$value['slug']]?>" />
					</div>
					<div class="clear"></div>
				</div>
			<?php endforeach ?>
			<div class="formRow">
				<label>Điện thoại</label>
				<div class="formRight">
					<input type="text" name="dienthoai" title="Nhập số điện thoại" id="dienthoai" class="tipS " value="<?=@$item['dienthoai']?>" />
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="formRow">
				<label>Email</label>
				<div class="formRight">
					<input type="text" name="email" title="Nhập email" id="yahoo" class="tipS " value="<?=@$item['email']?>" />
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow">
				<label>Webiste</label>
				<div class="formRight">
					<input type="text" name="website" title="Nhập website" id="website" class="tipS " value="<?=@$item['website']?>" />
				</div>
				<div class="clear"></div>
			</div>

			<!-- <div class="formRow">
				<label>Tọa độ</label>
				<div class="formRight">
					<input type="text" name="latlng" title="Nhập tọa độ" id="latlng" class="tipS " value="<?=@$item['latlng']?>" />
				</div>
				<div class="clear"></div>
			</div> -->
			<!-- bando -->

			<?php if($_GET['act'] == 'edit'){ 
				$latlng = explode(',', $item['latlng']);
				$lat = $latlng[0];
				$lng = $latlng[1];
			} else {
				$lat = '10.7636669';
				$lng = '106.6493337';
			} ?>
			<div class="formRow">
				<label for="diachi">Tọa độ</label>
				<div class="formRight">
					<div class="input-50">
						<div>
							<input id="Latitude" class="input-toado" name="lat" type="text" value="<?=$lat?>" />
						</div>
						<div>
							<input id="Longitude" class="input-toado" name="lng" type="text" value="<?=$lng?>" />
						</div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
				<div class="formRight">

					<input type="checkbox" name="active" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
					<label for="check1">Hiển thị</label>            
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Số thứ tự: </label>
				<div class="formRight">
					<input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="num" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<div class="formRight">
					<input type="hidden" name="id" id="id_this_yahoo" value="<?=@$item['id']?>" />
					<input type="submit" class="blueB"  value="Hoàn tất" />
				</div>
				<div class="clear"></div>
			</div>
		</div>  
	</form>
</div>
