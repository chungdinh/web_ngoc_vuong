<?php 

class paging_ajax
{
    public $data; // DATA
    public $per_page = 5; // SỐ RECORD TRÊN 1 TRANG
    public $page; // SỐ PAGE 
    public $text_sql; // CÂU TRUY VẤN
    
    //  THÔNG SỐ SHOW HAY HIDE 
    public $show_pagination = true;
    public $show_goto = false;
    public $show_total = false;
    
    // TÊN CÁC CLASS
    public $class_pagination; 
    public $class_active;
    public $class_inactive;
    public $class_go_button;
    public $class_text_total;
    public $class_txt_goto;    

    public $text_first;
    public $text_last;
    public $text_next;
    public $text_prev;

    public $class_next;
    public $class_prev;
    public $class_first;
    public $class_last;
    
    public $k;

    private $cur_page;  // PAGE HIỆN TẠI
    private $num_row; // SỐ RECORD
    
    // PHƯƠNG THỨC LẤY KẾT QUẢ CỦA TRANG 
    public function GetResult()
    {
        global $db; // BIỀN $db TOÀN CỤC
        
        // TÌNH TOÁN THÔNG SỐ LẤY KẾT QUẢ
        $this->cur_page = $this->page;
        $this->page -= 1;
        $this->per_page = $this->per_page;
        $start = $this->page * $this->per_page;
        
        // TÍNH TỔNG RECORD TRONG BẢNG
        $result = mysql_query($this->text_sql);
        $this->num_row = mysql_num_rows($result);
        
        // LẤY KẾT QUẢ TRANG HIỆN TẠI
        return mysql_query($this->text_sql." LIMIT $start, $this->per_page");
    }
    
    // PHƯƠNG THỨC XỬ LÝ KẾT QUẢ VÀ HIỂN THỊ PHÂN TRANG
    public function Load()
    {
        // KHÔNG PHÂN TRANG THÌ TRẢ KẾT QUẢ VỀ
        if(!$this->show_pagination)
            return $this->data;
        
        // SHOW CÁC NÚT NEXT, PREVIOUS, FIRST & LAST
        $previous_btn = true;
        $next_btn = true;
        $first_btn = true;
        $last_btn = true;    
        
        // GÁN DATA CHO CHUỖI KẾT QUẢ TRẢ VỀ 
        $msg = $this->data;
        
        // TÍNH SỐ TRANG
        $count = $this->num_row;
        $no_of_paginations = ceil($count / $this->per_page);
        
        // TÍNH TOÁN GIÁ TRỊ BẮT ĐẦU & KẾT THÚC VÒNG LẶP
        if ($this->cur_page >= 6) {
            $start_loop = $this->cur_page - 3;
            if ($no_of_paginations > $this->cur_page + 3)
                $end_loop = $this->cur_page + 3;
            elseif ($this->cur_page <= $no_of_paginations && $this->cur_page > $no_of_paginations - 5) {
                $start_loop = $no_of_paginations - 5;
                $end_loop = $no_of_paginations;
            } else {
                $end_loop = $no_of_paginations;
            }
        } else {
            $start_loop = 1;
            if ($no_of_paginations > 6)
                $end_loop = 6;
            else
                $end_loop = $no_of_paginations;
        }
        
        // NỐI THÊM VÀO CHUỖI KẾT QUẢ & HIỂN THỊ NÚT FIRST 
        $msg = '';
        if ($no_of_paginations > 1) {
            $msg .= "<ul  class='$this->class_pagination'>";
            if ($first_btn && $this->cur_page > 1) {
                $msg .= "<li class='$this->class_first'><a href='javascript:void(0);' title='$this->text_first' data-key='$this->k' p='1'>$this->text_first</a> </li>";
            } elseif ($first_btn) {
                $msg .= "<li class='$this->class_first'> <a href='javascript:void(0);' title='$this->text_first'>$this->text_first</a> </li>";
            }

        // HIỂN THỊ NÚT PREVIOUS
            if ($previous_btn && $this->cur_page > 1) {
                $pre = $this->cur_page - 1;
                $msg .= "<li class='$this->class_prev'><a href='javascript:void(0);' title='$this->text_prev' data-key='$this->k' p='$pre'>$this->text_prev</a></li>";
            } elseif ($previous_btn) {
                $msg .= "<li class='$this->class_prev'><a href='javascript:void(0);' title='$this->text_prev' >$this->text_prev</a></li>";
            }
            for ($i = $start_loop; $i <= $end_loop; $i++) {

                if ($this->cur_page == $i)
                    $msg .= "<li class='$this->class_active'><a href='javascript:void(0);'>{$i}</a></li>";
                else
                    $msg .= "<li><a data-key='$this->k' p='$i' href='javascript:void(0);'>{$i}</a></li>";
            }

        // HIỂN THỊ NÚT NEXT
            if ($next_btn && $this->cur_page < $no_of_paginations) {
                $nex = $this->cur_page + 1;
                $msg .= "<li class='$this->class_next'><a data-key='$this->k' p='$nex' href='javascript:void(0);' title='$this->text_next'>$this->text_next</a></li>";
            } elseif ($next_btn) {
                $msg .= "<li class='$this->class_next'><a href='javascript:void(0);' title='$this->text_next'>$this->text_next</a></li>";
            }

        // HIỂN THỊ NÚT LAST
            if ($last_btn && $this->cur_page < $no_of_paginations) {
                $msg .= "<li class='$this->class_last'><a href='javascript:void(0);' title='$this->text_last' data-key='$this->k' p='$no_of_paginations'>$this->text_last</a></li>";
            } elseif ($last_btn) {
                $msg .= "<li class='$this->class_last'> <a href='javascript:void(0);' title='$this->text_last'>$this->text_last</a></li>";
            }

        // SHOW TEXTBOX ĐỂ NHẬP PAGE KO ? 
            if($this->show_goto) {
                 $goto = "<input type='text' id='goto' class='$this->class_txt_goto' size='1' style='margin-top:-1px;margin-left:40px;margin-right:10px'/><input type='button' id='go_btn' class='$this->class_go_button' value='Đến'/>";
             }
          if($this->show_total){
            $total_string = "<span class='$this->class_text_total' a='$no_of_paginations'>Page " . $this->cur_page . " of $no_of_paginations</span>";
          }
        $stradd = $total_string.$goto;
    }
        // TRẢ KẾT QUẢ TRỞ VỀ
        return  $stradd . $msg . "</ul>";  // Content for pagination
    }     

}