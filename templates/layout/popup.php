<?php 
 $d->reset();
 $sql = "select noidung_$lang as noidung,hienthi,photo from #_info where hienthi=1 and type='popup' ";
 $d->query($sql);
 $popup_qc=$d->fetch_array();
 
 if($_GET['com']=='index' || $_GET['com']=='' && $popup_qc["hienthi"]==1  ){
 	?>
<script type="text/javascript">
$(document).ready(function(e) {
    setTimeout(function() { $(".auto_click").click(); }, 0);
})
</script>
<style>
#modal {
    display: none;
}

#modal img {
    width: 100%;
}
</style>
<a data-fancybox="modal" data-src="#modal" class="auto_click"></a>
<div id="modal" style="display: inline-block;padding: 10px;max-width: 900px;">
    <img src="thumb/880x448/2/<?php if($popup_qc['photo']!=NULL) echo _upload_hinhanh_l.$popup_qc['photo']; else echo 'images/noimg.jpg';?>" />
    <?= $popup_qc['noidung'] ?>
</div>
<!--end center_popup-->
<?php }?>