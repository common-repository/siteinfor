<?php

/*

 Plugin Name: SI实时分析

 Plugin URI: http://www.siteinfor.com/fenxi

 Description: 此插件可以实时分析您的网站、博客访客人数、访问页面、访问来源、访问国家以及停留时间等信息。

 Version: 1.0

 Author: SiteInfor

 Author URI: http://www.siteinfor.com

 License: GPL 2.0, @see http://www.gnu.org/licenses/gpl-2.0.html

 */



/**

 * WP Hooks

 **/

add_action('wp_footer', 'inject_siteinfor_code');

add_action('admin_menu', 'siteinfor_widget_options_admin_menu');

/**

 *functions

 */

 //code injector funtion

function inject_siteinfor_code() {

if (!is_admin())

{

$keys="网站实时统计
网站实时分析
网站分析
流量统计
访客统计
博客分析
实时在线统计
SI实时分析";
$keys=explode("\n",$keys);
$rand=rand(0,25);
$key=trim($keys[$rand]);
$mmuloc=get_option('siteinfor_location','rightcenter');
$mmu_bg=get_option('mmu_bg','990500');
$mmu_fg=get_option('mmu_fg','FFFFFF');
echo "<!-- SiteInfor widget code start -->\n";
echo "<script type=\"text/javascript\" src=\"http://www.siteinfor.com/siteinfor_widget.js\"></script>\n<script type=\"text/javascript\">siteinfor({location:\"".$mmuloc."\",Bg:\"".$mmu_bg."\",Fg:\"".$mmu_fg."\"})</script><noscript><a href=\"http://www.siteinfor.com/\"><img src=\"http://www.siteinfor.com/noimg.gif\" alt=\"".$key."\" border=\"0\" />".$key."</a></noscript>\n";
echo "<!-- SiteInfor widget code end -->\n";
}
}
//admin menu funtion
function siteinfor_widget_options_admin_menu(){
add_options_page('SI实时分析','SI实时分析','manage_options',basename(__FILE__),'siteinfor_settings_page');
}
function siteinfor_settings_page() {
$mmulocs=array('lefttop'=>'左上部','leftcenter'=>'左中部','leftbottom'=>'左底部','righttop'=>'右上部','rightcenter'=>'右中部','rightbottom'=>'右下部','bottomleft'=>'底左部','bottomcenter'=>'底中部','bottomright'=>'底右部');
if(isset($_POST['siteinfor_location'])) {
update_option('siteinfor_location',$_POST['siteinfor_location']);
}
if(isset($_POST['mmu_bg'])) {
update_option('mmu_bg',$_POST['mmu_bg']);
}
if(isset($_POST['mmu_fg'])) {
update_option('mmu_fg',$_POST['mmu_fg']);
}
$mmu_bg=get_option('mmu_bg','990500');
$mmu_fg=get_option('mmu_fg','FFFFFF');
$mmu_loc=get_option('siteinfor_location','rightcenter');
$url_js = plugins_url('jscolor/jscolor.js', __FILE__);
echo "<script type='text/javascript' src='$url_js'></script>\n";
?>
<div class="wrap">
<h2>SI实时分析设置</h2>
<h4>您目前插件显示位置为 &quot;<?php echo $mmulocs[$mmu_loc]; ?>&quot;</h4>
<h4>请选择你需要显示的新插件配色以及位置</h4>
<h4><form method="post" action="">
<strong>背景颜色&nbsp;&nbsp;&nbsp;</strong>
<input class="color" value="<? echo $mmu_bg; ?>" name="mmu_bg"  readonly="readonly" /><br />
<strong>字体颜色&nbsp;&nbsp;&nbsp;</strong>
	  <input class="color" value="<? echo $mmu_fg; ?>" name="mmu_fg" readonly="readonly" /><br />

  <strong>Select Location</strong>

  <select name="siteinfor_location">

  <?php

  foreach($mmulocs as $key=>$val)

  {

  ?>

  <option value="<?php echo $key;?>" <?php if($mmu_loc==$key) echo "selected=\"selected\""; ?>><?php echo $val;?></option>

  <? } ?>

  </select>  <input name="button" type="submit" value="更新插件" />
</h4>
</form>
<?php $url = get_bloginfo('url');
$nowww = str_replace("http://","",$url);  ?>
查看SI实时分析情况 <a target="_blank" href="http://www.siteinfor.com/status/<?php echo $nowww ; ?>">这里</a> 或者输入 http://www.siteinfor.com/status/<strong>&lt;你的域名&gt;</strong></div>
<?php
}
?>