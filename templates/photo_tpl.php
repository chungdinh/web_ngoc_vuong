<div class="main">
	<div class="container">
		<?php echo $breadcrumb ?>
		<div class="block-photo">
			<div class="row">
				<?php foreach ($photo as $key => $value): ?>
					<div class="col-4 mr-bottom-30 wow fadeInUp" data-wow-delay="<?php echo $key*0.15 ?>s">
						<div class="hv">
							<a data-fancybox="gallery" href="<?php echo _upload_hinhanh_l.$value['photo'] ?>" title="<?php echo $value['ten'] ?>">
							</a> 
							<img class="w_100" src="thumb/365x270/1/<?php echo _upload_hinhanh_l.$value['photo'] ?>" alt="<?php echo $value['ten'] ?>">

						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>		
	</div>
</div>