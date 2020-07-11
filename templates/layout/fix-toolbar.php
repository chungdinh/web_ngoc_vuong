<!-- Begin Tool Fix Mobile -->
<div class="fix-toolbar">
    <ul>
        <li>
            <a id="goidien" href="tel:<?php echo str_replace(array(',','.',' ','-'), '', $row_setting['dienthoai']) ?>" title="title">
                <img src="images/fp-phone.png" alt="images"><br>
                <span>Gọi điện</span>
            </a>
        </li>
        <li>
            <a id="nhantin" href="sms:<?php echo str_replace(array(',','.',' ','-'), '', $row_setting['dienthoai']) ?>" title="title">
                <img src="images/fp-sms.png" alt="images"><br>
                <span>Nhắn tin</span>
            </a>
        </li>
        <li>
            <a target="_blank" href="https://www.google.com/maps/dir/?api=1&amp;origin=&amp;destination=<?php echo $row_setting['diachi_'.$lang] ?>" title="Map">
                <img src="images/fp-chiduong.png" alt="images"><br>
                <span>Chỉ Đường</span>
            </a>
        </li>
        <li>
            <a id="chatzalo" href="https://zalo.me/<?php echo str_replace(array(',','.',' ','-'), '', $row_setting['dienthoai']) ?>" title="title">
                <img src="images/fp-zalo.png" alt="images"><br>
                <span>Chat zalo</span>
            </a>
        </li>
        <li>
            <a id="chatfb" href="<?=$row_setting['facebook']?>" title="title">
                <img src="images/fp-mess.png" alt="images"><br>
                <span>Chat facebook</span>
            </a>
        </li>
    </ul>
</div>
<!-- End Tool Fix Mobile -->