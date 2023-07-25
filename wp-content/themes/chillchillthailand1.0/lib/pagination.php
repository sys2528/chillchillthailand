<?php
//pagination
function pagination($pages = '', $range = 2)
{
     $showitems = ($range * 2)+1;
     global $paged;
     if(empty($paged)) $paged = 1;
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }
     if(1 != $pages)
     {
		 echo "<section id=\"pagination\">\n";
		 echo "<ul>\n";
         if($paged > 1){ echo "<li><a href='".get_pagenum_link($paged - 1)."'>กลับไป</a></li>\n";}else{echo "<li><span>กลับไป</span></li>\n";}
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                echo ($paged == $i)? "<li><span class=\"active\">".$i."</span></li>\n":"<li><a href='".get_pagenum_link($i)."'>".$i."</a></li>\n";
             }
         }
		if ($paged < $pages) {echo "<li><a href=\"".get_pagenum_link($paged + 1)."\">ถัดไป</a></li>\n";}else{echo "<li><span>ถัดไป</span></li>\n";}
		echo "</ul>\n";
		echo "</section>\n";
     }
}
?>