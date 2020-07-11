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
				<li class="current"><a href="#" onclick="return false;">Cập nhật title</a></li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>

	<form name="supplier" id="validate" class="form" action="index.php?com=option&act=save&type=<?php echo $_GET['type'] ?>" method="post" enctype="multipart/form-data">
		<?php if($config_title){ //Dành cho lập trình khi tạo title làm xong nhớ khóa lại ?>
			<div class="widget">
				<div class="title chonngonngu">
					<ul>
						<li><a href="vi" class="active tipS validate[required]" title="Chọn tiếng việt "><img src="./images/vi.png" alt="" class="tiengviet" /></a></li>
					</ul>
				</div>	
				<div class="formRow lang_hidden lang_vi active">
					<label>Tên</label>
					<div class="formRight">
						<input type="text" name="ten_vi" title="Nhập nội dung" id="ten_vi" class="tipS validate[required]" value="<?=@$item['ten_vi']?>" />
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow lang_hidden lang_vi active">
					<label>Name</label>
					<div class="formRight">
						<input type="text" name="name_vi" title="Nhập nội dung" id="name_vi" class="tipS validate[required]" value="<?=@$item['name_vi']?>" />
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow lang_hidden lang_vi active">
					<label>Nội dung</label>
					<div class="formRight">
						<input type="text" name="value" title="Nhập nội dung" id="value" class="tipS validate[required]" value="<?=@$item['ten']?>" />
					</div>
					<div class="clear"></div>
				</div>
				
				<div class="formRow lang_hidden lang_vi active">
					<label>Tạo title</label>
					<div class="formRight">
						<button type="button" class="btn-tao blueB" class="blueB">Tạo title</button>
					</div>
					<div class="clear"></div>
				</div>
				<script type="text/javascript">
					$(document).ready(function() {
						$('.btn-tao').click(function(event) {
							var ten = $("#ten_vi").val(),name = $("#name_vi").val(),value = $("#value").val();
							if (ten.length > 0 && name.length > 0 && value.length > 0) {
								$.ajax({
									type:'POST',
									url:'ajax/option-title.php',
									cache:false,
									data:{
										ten:ten,
										name:name,
										value:value,
										do: 'them',
										type:'<?php echo $_GET['type'] ?>',
									},
									success:function(data){
										$("#result").append(data);
									}
								});
							}
						});
					});
				</script>
			</div>  
		<?php } ?>
		<div class="widget">
			<div id="result">
				<?php foreach ($item as $key => $value): ?>
					<div class="formRow lang_hidden lang_vi active">
						<label><?php echo $value['ten_vi'] ?></label>
						<div class="formRight item-capnhat">
							<div class="row">
								<div class="col-xs-12 col-sm-10">
									<input type="text" class="tipS" name="value" data-name="<?php echo $value['name_vi'] ?>" value="<?php echo $value['value'] ?>" />
								</div>
								<div class="col-xs-12 col-sm-2">
									<button type="button" data-id="<?php echo $value['id'] ?>" class="blueB btn-capnhat">Cập nhật</button>
								</div>
							</div>
						</div>
						<div class="clear"></div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
	</form>        
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('body').on('click', '.btn-capnhat', function(event) {
			event.preventDefault();
			var id = $(this).attr('data-id'), parent = $(this).parents('.item-capnhat'),value = parent.find('input[type="text"]').val();
			if (value.length > 0) {
				$.ajax({
					type:'POST',
					url:'ajax/option-title.php',
					cache:false,
					data:{
						id:id,
						value: value,
						do: 'capnhat',
						type:'<?php echo $_GET['type'] ?>',
					},
					success:function(data){
						if (data == 1) {
							alert('Cập nhật thành công !');
						} else {
							alert('Cập nhật thất bại ! vui lòng kiểm tra lại');
						}
					}
				});
			}
		});
	});
</script>