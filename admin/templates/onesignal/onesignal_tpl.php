<div class="wrapper">
	<div class="control_frm" style="margin-top:25px;">
		<div class="bc">
			<ul id="breadcrumbs" class="breadcrumbs">
				<li class="current"><a href="index.php?com=onesignal">Đẩy tin - Onesignal</a></li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>
	<form name="supplier" class="form" action="index.php?com=onesignal&act=save" method="post" enctype="multipart/form-data">
		<div class="widget">			
			<div class="formRow">
				<label>Tải hình ảnh:</label>
				<div class="formRight">
					<input type="file" id="file" name="file" />
					<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
					<div class="note"> width : 125 px , Height : 125 px </div>

				</div>
				<div class="clear"></div>
			</div>			
			<?php if (isset($_GET['id'])): ?>
				<div class="formRow">
					<label> Ảnh:</label>
					<div class="formRight">	
						<img style="width: 125px;height: 125px" src="../thumb/125x125/2/<?=_upload_hinhanh_l.$item['photo']?>" alt="" onError="this.src='images/no_image.jpg';" style="border:1px solid #CCC;" />
					</div>
					<div class="clear"></div>
				</div>
			<?php endif ?>	
			<div class="formRow lang_hidden lang_vi active">
				<label>Tiêu đề</label>
				<div class="formRight">
					<input type="text" name="heading" class="form-control" value="<?php echo $item['ten'] ?>" />
				</div>
				<div class="clear"></div>
			</div>			
			<div class="formRow lang_hidden lang_vi active">
				<label>Mô tả</label>
				<div class="formRight">
					<textarea name="content" cols="50" rows="4" id="mota_vi" class="form-control"><?php echo $item['noidung'] ?></textarea> 
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow lang_hidden lang_vi active">
				<label>Đường dẫn</label>
				<div class="formRight">
					<input type="text" name="url" class="form-control" value="<?php echo $item['link'] ?>"  />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<div class="formRight">
					<input type="submit" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
				</div>
				<div class="clear"></div>
			</div>
		</div>  
		<input type="hidden" name="id" value="<?php echo $item['id'] ?>">
	</form>    
	<?php if (isset($_GET['id'])): ?>
	<div class="widget">
		<div class="formRow lang_hidden lang_vi active">
			<div class="formRight">
				<input type="submit" class="blueB" onclick="window.location='index.php?com=onesignal'" return false;" value="Thêm mới" />
			</div>
			<div class="clear"></div>
		</div>
	</div>	
	<?php endif ?>
	<div class="widget">
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
			<thead>
				<tr>
					<td align="center">STT</td>
					<td width="75" align="center"></td>
					<td align="center">Tên</td>
					<td align="center">Mô tả</td>
					<td align="center">Đường dẫn</td>
					<td width="50" align="center">Đẩy tin</td>
					<td align="center">Tùy chỉnh</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($items as $key => $value): ?>
					<tr>
						<td align="center"><?php echo $key + 1 ?></td>								
						<td align="center"><img style="max-width: 50px" src="<?php echo _upload_hinhanh.$value['photo'] ?>" alt=""></td>								
						<td align="center">
							<a href="index.php?com=onesignal&id=<?php echo $value['id'] ?>" title="<?php echo $value['ten'] ?>"><?php echo $value['ten'] ?></a>
						</td>
						<td align="center">
							<?php echo $value['noidung'] ?>
						</td>
						<td align="center">
							<a  href="index.php?com=onesignal&id=<?php echo $value['id'] ?>" title="<?php echo $value['link'] ?>"><?php echo $value['link'] ?></a>
						</td>
						<td align="center">
							<input class="blueB" type="submit" value="Đẩy tin" onclick="window.location='index.php?com=onesignal&act=push&id=<?php echo $value['id'] ?>'">
						</td>
						<td class="btnOne">

							<a class="smallButton tipS" href="index.php?com=onesignal&id=<?=$value['id']?>">
								<img src="./images/icons/dark/pencil.png" alt="">
							</a>
							<a class="smallButton tipS" href="index.php?com=onesignal&delete=<?=$value['id']?>">
								<img src="./images/icons/dark/close.png" alt="">
							</a>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>   
	<div class="paging"><?=$paging?></div>
</div>
