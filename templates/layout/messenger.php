<link rel="stylesheet" id="messenger-css" href="css/facebook/messenger.css" type="text/css" media="all">
<!-- JS BLOCK-->
<div class="drag-wrapper">
   <div data-drag="data-drag" class="thing" style="transform: translate(1190px, 20px);">
      <a class="drag_messenger_button toby_tooltip" title="Chat Facebook" data-toggle="tooltip">
         <div class="circle facebook-messenger-avatar">
            <img class="facebook-messenger-avatar" src="images/icon_face.svg">
         </div>
      </a>
      <div class="content" style="display: none; max-height: 563px;">
         <div class="inside" id="fbmessenger_content">
            <div class="arrow"></div>
            <ul class="ChatLog" id="chat_text">
               <li class="ChatLog__entry">
                  <img class="ChatLog__avatar" src="<?=_upload_hinhanh_l.$logo["photo"]?>" />
                  <p class="ChatLog__message">
                     Chào bạn!
                     <time class="ChatLog__timestamp">1 minutes ago</time>
                  </p>
               </li>
               <li class="ChatLog__entry">
                  <img class="ChatLog__avatar" src="<?=_upload_hinhanh_l.$logo["photo"]?>?>" />
                  <p class="ChatLog__message">
                     Bạn hỗ trợ thêm thông tin gì?
                     <time class="ChatLog__timestamp">2 minutes ago</time>
                  </p>
               </li>
               <li class="Chat_button" id="Chat_button">  
                 
               </li>
            </ul>
           
            <div class="fb-page" data-href="<?=$row_setting['facebook']?>" data-tabs="messages" data-width="310" data-height="270" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="<?=$row_setting['facebook']?>" class="fb-xfbml-parse-ignore"><a href="<?=$row_setting['facebook']?>">Facebook</a></blockquote></div>
         </div>
      </div>
   </div>
   <div class="magnet-zone">
      <div class="magnet"></div>
   </div>
</div>
<div id="messenger_bg"> </div>


<script type="text/javascript" src="js/facebook/popup.js"></script>
<script type="text/javascript" src="js/facebook/jquery.event.move.js"></script>
<script type="text/javascript" src="js/facebook/rebound.min.js"></script>
<script type="text/javascript" src="js/facebook/index.js"></script>