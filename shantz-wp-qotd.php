<?php
/* 
Plugin Name: Shantz Wordpress QOTD 
Plugin URI: http://tech.shantanugoel.com/projects/wordpress/shantz-wordpress-qotd
Version: 1.2.2
Author: Shantanu Goel
Author URI: http://blog.shantanugoel.com
Description: This plugin shall give you the ability of adding quotes to anywhere on your blog on the fly. Go to <a href="http://tech.shantanugoel.com/projects/wordpress/shantz-wordpress-qotd">shantz-wp-qotd</a> for updates/help. Also visit my <a href="http://tech.shantanugoel.com">tech site</a>.
 
Copyright 2007  Shantanu Goel  (email : shantanu [a t ] shantanugoel DOT com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/
$include_path = ".";
if (!class_exists("shantzWpQotdPlugin")) {
	class shantzWpQotdPlugin {
        var $adminOptionsName = "shantzWpQotdPluginAdminOptions";
        var $wpCompat;

		function shantzWpQotdPlugin() { //constructor
			
		}

        function getAdminOptions() {
            $shantzAdminOptions = array('enable_qotd_plugin' => 'true',
                'quotes_db_wp' => "I didn't do it. Nobody saw me do it, you can't prove anything - Bart Simpson
                Try, try, try again, until you succeed - Anonymous",
                'quotes_src_file' => 'true',
                'quotes_src_box' => 'true',
                'quotes_src_web' => 'false',
                'quotes_separator' => '',
                'quote_pattern' => 'qottd',
                'quote_add_auto' => 'true',
                'quote_add_pages' => 'true',
                'quote_add_bottom' => 'true',
                'quote_static_text_before' => '<b>QOTD:</b><i>',
                'quote_static_text_after' => '</i>');

            $shantzOptions = get_option($this->adminOptionsName);
            if (!empty($shantzOptions)) {
                foreach ($shantzOptions as $key => $option)
                    $shantzAdminOptions[$key] = $option;
            }
            update_option($this->adminOptionsName, $shantzAdminOptions);
            return $shantzAdminOptions;
        }

        function init() {
            $this->getAdminOptions();
        }

        function printAdminPage() {
            $shantzOptions = $this->getAdminOptions();

            if(isset($_POST['defaults_shantzWpQotdPluginSettings'])) {
                    $shantzOptions['enable_qotd_plugin'] = 'true';
                    $shantzOptions['quotes_db_wp'] = "I didn't do it. Nobody saw me do it, you can't prove anything - Bart Simpson\nTry, try, try again, until you succeed - Anonymous";
                    $shantzOptions['quotes_src_file'] = 'true';
                    $shantzOptions['quotes_src_box'] =  'true';
                    $shantzOptions['quotes_separator'] =  '';
                    $shantzOptions['quotes_pattern'] = 'qottd';
                    $shantzOptions['quotes_add_auto'] = 'true';
		    $shantzOptions['quotes_exclude_pages'] = 'true';
                    $shantzOptions['quotes_add_bottom'] = 'true';
                    $shantzOptions['quotes_static_text_before'] = '<b>QOTD:</b><i>';
                    $shantzOptions['quotes_static_text_after'] = '</i>';

                update_option($this->adminOptionsName, $shantzOptions);

                ?>
                    <div class="updated"><p><strong><?php _e("Settings Reset to Defaults.", "shantzWpQotdPlugin");?></strong></p></div>
                    <?php
            }

            else if(isset($_POST['update_shantzWpQotdPluginSettings'])) {
                if(isset($_POST['shantzWpQotdEnable'])) {
                    $shantzOptions['enable_qotd_plugin'] = $_POST['shantzWpQotdEnable'];
                }
                if(isset($_POST['shantzWpQotdDb'])) {
                    $shantzOptions['quotes_db_wp'] = stripslashes (apply_filters('content_save_pre', $_POST['shantzWpQotdDb']));
            }
             if(isset($_POST['shantzWpQotdSrcFile'])) {
                $shantzOptions['quotes_src_file'] =  $_POST['shantzWpQotdSrcFile'];
            }
             if(isset($_POST['shantzWpQotdSrcBox'])) {
                $shantzOptions['quotes_src_box'] =  $_POST['shantzWpQotdSrcBox'];
            }
             if(isset($_POST['shantzWpQotdSeparator'])) {
                $shantzOptions['quotes_separator'] =  $_POST['shantzWpQotdSeparator'];
            }
             if(isset($_POST['shantzWpQotdPattern'])) {
                $shantzOptions['quotes_pattern'] = $_POST['shantzWpQotdPattern'];
            }
             if(isset($_POST['shantzWpQotdAddAuto'])) {
                $shantzOptions['quotes_add_auto'] = $_POST['shantzWpQotdAddAuto'];
            }
             if(isset($_POST['shantzWpQotdExcludePages'])) {
                $shantzOptions['quotes_exclude_pages'] = $_POST['shantzWpQotdExcludePages'];
            }
             if(isset($_POST['shantzWpQotdAddBottom'])) {
                $shantzOptions['quotes_add_bottom'] = $_POST['shantzWpQotdAddBottom'];
            }
             if(isset($_POST['shantzWpQotdStaticTextBefore'])) {
                $shantzOptions['quotes_static_text_before'] = apply_filters('content_save_pre', $_POST['shantzWpQotdStaticTextBefore']);
            }
             if(isset($_POST['shantzWpQotdStaticTextAfter'])) {
                $shantzOptions['quotes_static_text_after'] = apply_filters('content_save_pre', $_POST['shantzWpQotdStaticTextAfter']);
            }

            update_option($this->adminOptionsName, $shantzOptions);

            ?>
<div class="updated"><p><strong><?php _e("Settings Updated.", "shantzWpQotdPlugin");?></strong></p></div>
            <?php
        } ?>
<div class=wrap>
<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
<h2>Shantanu's Quotes Plugin</h2>
<h3>Go to <a href="http://tech.shantanugoel.com/projects/wordpress/shantz-wordpress-qotd">shantz-wp-qotd</a> for updates and help. Also visit my <a href="http://tech.shantanugoel.com">tech site</a>.<h3>

<h3>Enable the plugin</h3>
<p>Selecting "No" will disable the plugin. (To disable widget as well, you have to deactivate the pugin, or remove widget from sidebar)</p>
<p><label for="shantzWpQotdEnable_yes"><input type="radio" id="shantzWpQotdEnable_yes" name="shantzWpQotdEnable" value="true" <?php if ($shantzOptions['enable_qotd_plugin'] == "true") { _e('checked="checked"', "shantzWpQotdPlugin"); }?> /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="shantzWpQotdEnable_no"><input type="radio" id="shantzWpQotdEnable_no" name="shantzWpQotdEnable" value="false" <?php if ($shantzOptions['enable_qotd_plugin'] == "false") { _e('checked="checked"', "shantzWpQotdPlugin"); }?>/> No</label></p>

<h3>Source for your quotes</h3>
<p><label for="shantzWpQotdSrcBox"><input type="hidden" name="shantzWpQotdSrcBox" value="false"/><input type="checkbox" name="shantzWpQotdSrcBox" value="true" <?php if ($shantzOptions['quotes_src_box'] == "true") { _e('checked="checked"');} ?>/> Quotes Text Area</label></p>

<p><label for="shantzWpQotdSrcFile"><input type="hidden" name="shantzWpQotdSrcFile" value="false"/><input type="checkbox" name="shantzWpQotdSrcFile" value="true" <?php if ($shantzOptions['quotes_src_file'] == "true") { _e('checked="checked"');} ?>/> Quotes From A File ('quotes.txt' kept in plugin folder)</label></p>

<h3>Quotes Separator Tag (e.g. [quote]. Leave blank if each quote is on a new line)</h3>
<textarea name="shantzWpQotdSeparator" style="width: 10%; height: 20px;"><?php _e(apply_filters('format_to_edit',$shantzOptions['quotes_separator']), 'shantzWpQotdPlugin') ?></textarea>

<h3>Paste the quotes here, each quote in a new line</h3> <h4><i>("Quotes Text Area" option must me selected for this to work)</i></h4>
<textarea name="shantzWpQotdDb" style="width: 80%; height: 100px;"><?php _e(apply_filters('format_to_edit',$shantzOptions['quotes_db_wp']), 'shantzWpQotdPlugin') ?></textarea>

<h3>Select the quotes pattern</h3>
<p><label for="shantzWpQotdPattern_random"><input type="radio" id="shantzWpQotdPattern_random" name="shantzWpQotdPattern" value="random" <?php if ($shantzOptions['quotes_pattern'] == "random") { _e('checked="checked"', "shantzWpQotdPlugin"); }?> /> Random</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="shantzWpQotdPattern_qotd"><input type="radio" id="shantzWpQotdPattern_qotd" name="shantzWpQotdPattern" value="qotd" <?php if ($shantzOptions['quotes_pattern'] == "qotd") { _e('checked="checked"', "shantzWpQotdPlugin"); }?>/> Quote of the day</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="shantzWpQotdPattern_qottd"><input type="radio" id="shantzWpQotdPattern_qottd" name="shantzWpQotdPattern" value="qottd" <?php if ($shantzOptions['quotes_pattern'] == "qottd") { _e('checked="checked"', "shantzWpQotdPlugin"); }?>/> Quote of that day</label></p>
 

<h3>Add quotes to the posts automatically</h3>
<p><label for="shantzWpQotdAddAuto_yes"><input type="radio" id="shantzWpQotdAddAuto_yes" name="shantzWpQotdAddAuto" value="true" <?php if ($shantzOptions['quotes_add_auto'] == "true") { _e('checked="checked"', "shantzWpQotdPlugin"); }?> /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="shantzWpQotdAddAuto_no"><input type="radio" id="shantzWpQotdAddAuto_no" name="shantzWpQotdAddAuto" value="false" <?php if ($shantzOptions['quotes_add_auto'] == "false") { _e('checked="checked"', "shantzWpQotdPlugin"); }?>/> No</label></p>

<p>
<label for="shantzWpQotdExcludePages"><input type="hidden" name="shantzWpQotdExcludePages" value="false"/><input type="checkbox" name="shantzWpQotdExcludePages" value="true" <?php if ($shantzOptions['quotes_exclude_pages'] == "true") { _e('checked="checked"');} ?>/> Exclude pages from automatically added quotes</label>
</p>

<h3>Quotes to be added at the top of the posts, or bottom.</h3>
<p><label for="shantzWpQotdAddBottom_top"><input type="radio" id="shantzWpQotdAddBottom_top" name="shantzWpQotdAddBottom" value="false" <?php if ($shantzOptions['quotes_add_bottom'] == "false") { _e('checked="checked"', "shantzWpQotdPlugin"); }?> /> Top</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="shantzWpQotdAddBottom_bottom"><input type="radio" id="shantzWpQotdAddBottom_bottom" name="shantzWpQotdAddBottom" value="true" <?php if ($shantzOptions['quotes_add_bottom'] == "true") { _e('checked="checked"', "shantzWpQotdPlugin"); }?>/> Bottom</label></p>

<h3>Add the following text before the quote</h3>
<textarea name="shantzWpQotdStaticTextBefore" style="width: 40%; height: 15px;"><?php _e(apply_filters('format_to_edit',$shantzOptions['quotes_static_text_before']), 'shantzWpQotdPlugin') ?></textarea>

<h3>Add the following text after the quote</h3>
<textarea name="shantzWpQotdStaticTextAfter" style="width: 40%; height: 15px;"><?php _e(apply_filters('format_to_edit',$shantzOptions['quotes_static_text_after']), 'shantzWpQotdPlugin') ?></textarea>

<div class="submit">
<input type="submit" name="defaults_shantzWpQotdPluginSettings" value="<?php _e('Load Default Settings', 'shantzWpQotdPlugin') ?>" />
<input type="submit" name="update_shantzWpQotdPluginSettings" value="<?php _e('Update Settings', 'shantzWpQotdPlugin') ?>" /></div>
</form>
 </div>
					<?php
				}//End function printAdminPage()

        function process_quote($content = '') {
            $shantzOptions = $this->getAdminOptions();
            $wpCompat = (version_compare($wp_version, '2.1', '<'));
            if($shantzOptions['enable_qotd_plugin'] == "true") {

                $content = preg_replace('/<!--\s*shantz-wp-qotd\s*(\w*)\s*-->/ie', '$this->addQuote(\'$1\')', $content);

                if($shantzOptions['quotes_add_auto'] == "true") {
		    global $post;
		    if( (($wpCompat) && ($post->post_type != 'page')) || 
                (!($wpCompat) && ($post->post_status !='static')) ||
		    	($shantzOptions['quotes_exclude_pages'] == "false") ){		    
                    	$quote = $this->addQuote('default');
                    	if($shantzOptions['quotes_add_bottom'] == "true") {
                            $content .= $quote;
                    	}
                    	else {
                            $content = $quote.$content;
                    	}
		    }
                }
            }
            return $content;
        }

        function addQuote($quotes_pattern = '') {
            $shantzOptions = $this->getAdminOptions();
            $quote = '';
            $quotes_string = '';

            if($shantzOptions['quotes_src_file'] == "true") {
                if (function_exists(file_get_contents)) {
                    $quotes_string .= file_get_contents('quotes.txt',FILE_USE_INCLUDE_PATH);
                }
            }

            if($shantzOptions['quotes_src_box'] == "true") {
                $quotes_string .= $shantzOptions['quotes_db_wp'];
            }

            $separator = $shantzOptions['quotes_separator'];
            if ($separator == '') {
                $separator = "\n";
            }
            $quote_list = explode ($separator, $quotes_string);
            $num_quotes = count($quote_list);

            if ($quote_list[$num_quote] == '')
            {
                array_pop ($quote_list);
                $num_quotes--;
            }

            if($num_quotes > 0) {
                
                if ($quotes_pattern == "default"){
                    $quotes_pattern = $shantzOptions['quotes_pattern'];
                }
                if ($quotes_pattern == "qottd") {
                    $day = the_date('z','','',FALSE);
                }
                else if ($quotes_pattern == "qotd") {
                    $day = date('z');
                }
                else {
                    srand(time());
                    $day = (rand()%$num_quotes);
                }
                $quote = $quote_list[$day % $num_quotes];
                $quote = $shantzOptions['quotes_static_text_before'].$quote.$shantzOptions['quotes_static_text_after'];
            }
            return $quote;
        }
	}//End Class shantz-plugin

} 


if (!class_exists("shantzWpQotdWidget")) {
	class shantzWpQotdWidget {
        var $widgetOptionsName = "shantzWpQotdWidgetOptions";

		function shantzWpQotdWidget() { //constructor
			
		}

        function getWidgetOptions() {
            $shantzWidgetOptions = array(
                'w_quote_title' => '<b>Random Quote<b>',
                'w_quote_pattern' => 'random',
                'w_quote_static_text_before' => '<b><i>',
                'w_quote_static_text_after' => '</i></b>');

            $shantzWOptions = get_option($this->widgetOptionsName);
            if (!empty($shantzWOptions)) {
                foreach ($shantzWOptions as $key => $option)
                    $shantzWidgetOptions[$key] = $option;
            }
            update_option($this->widgetOptionsName, $shantzWidgetOptions);
            return $shantzWidgetOptions;
        }

        function widget_init() {
            if ( !function_exists('register_sidebar_widget') || !function_exists('register_widget_control') )
                return;
            register_sidebar_widget('Shantz Qotd', array($this, 'widget_shantzQotd'));
            register_widget_control('Shantz Qotd', array($this, 'widget_shantzQotdCtrl'), 300, 350);
        }

        function widget_shantzQotd($args) {
            extract($args);
            global $shantzWpQotdInstance;
            $widgetOptions = $this->getWidgetOptions();
            $shantzOptions = $shantzWpQotdInstance->getAdminOptions();

            $title = $widgetOptions['w_quote_title'];

            $quote = '';

            $quotes_string = '';

            if($shantzOptions['quotes_src_file'] == "true") {
                if (function_exists(file_get_contents)) {
                    $quotes_string .= file_get_contents('quotes.txt',FILE_USE_INCLUDE_PATH);
                }
            }

            if($shantzOptions['quotes_src_box'] == "true") {
                $quotes_string .= $shantzOptions['quotes_db_wp'];
            }

            $separator = $shantzOptions['quotes_separator'];
            if ($separator == '') {
                $separator = "\n";
            }
            $quote_list = explode ($separator, $quotes_string);
            $num_quotes = count($quote_list);

            if($num_quotes > 0) {

                if ($widgetOptions['w_quote_pattern'] == "qottd") {
                    $day = the_date('z','','',FALSE);
                }
                else if ($widgetOptions['w_quote_pattern'] == "qotd") {
                    $day = date('z');
                }
                else {
                    srand(time());
                    $day = (rand()%$num_quotes);
                }
                $quote = $quote_list[$day % $num_quotes];
                $quote = $widgetOptions['w_quote_static_text_before'].$quote.$widgetOptions['w_quote_static_text_after'];
            }

            echo $before_widget;
            echo $before_title . $title . $after_title;
            echo $quote;
            echo $after_widget; 

        }

        function widget_shantzQotdCtrl() {
            $widgetOptions = $this->getWidgetOptions();

            if(isset($_POST['update_shantzWpQotdWidgetSettings'])) {
                if(isset($_POST['shantzWpQotdWidgetTitle'])) {
                    $widgetOptions['w_quote_title'] =stripslashes (apply_filters('content_save_pre', $_POST['shantzWpQotdWidgetTitle']) );
                }
                if(isset($_POST['shantzWpQotdWidgetPattern'])) {
                    $widgetOptions['w_quote_pattern'] =  $_POST['shantzWpQotdWidgetPattern'];
                }
                if(isset($_POST['shantzWpQotdWidgetTextBefore'])) {
                    $widgetOptions['w_quote_static_text_before'] = stripslashes(apply_filters('content_save_pre', $_POST['shantzWpQotdWidgetTextBefore']));
                }
                if(isset($_POST['shantzWpQotdWidgetTextAfter'])) {
                    $widgetOptions['w_quote_static_text_after'] = stripslashes(apply_filters('content_save_pre', $_POST['shantzWpQotdWidgetTextAfter']));
                }
                update_option($this->widgetOptionsName, $widgetOptions);
            }

            ?>
                <div>
                <label for="shantzWpQotdWidgetTitle" style="line-height:35px;display:block;">Widget Title: <input type="text" id="shantzWpQotdWidgetTitle" name="shantzWpQotdWidgetTitle" value="<?php _e($widgetOptions['w_quote_title']); ?>" /></label>

                <p>Quotes Rotation Pattern:<br><label for="shantzWpQotdWidgetPattern_random"><input type="radio" id="shantzWpQotdWidgetPattern_random" name="shantzWpQotdWidgetPattern" value="random" <?php if ($widgetOptions['w_quote_pattern'] == "random") { _e('checked="checked"', "shantzWpQotdWidget"); }?> /> Random<br></label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="shantzWpQotdWidgetPattern_qotd"><input type="radio" id="shantzWpQotdWidgetPattern_qotd" name="shantzWpQotdWidgetPattern" value="qotd" <?php if ($widgetOptions['w_quote_pattern'] == "qotd") { _e('checked="checked"', "shantzWpQotdWidget"); }?>/> Quote of the day<br></label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="shantzWpQotdWidgetPattern_qottd"><input type="radio" id="shantzWpQotdWidgetPattern_qottd" name="shantzWpQotdWidgetPattern" value="qottd" <?php if ($widgetOptions['w_quote_pattern'] == "qottd") { _e('checked="checked"', "shantzWpQotdWidget"); }?>/> Quote of that day</label></p>

<p>Text Before Quote:
<textarea name="shantzWpQotdWidgetTextBefore" style="width: 80%; height: 45px;"><?php _e(apply_filters('format_to_edit',$widgetOptions['w_quote_static_text_before']), 'shantzWpQotdWidget') ?></textarea><br>
Text After Quote:
<textarea name="shantzWpQotdWidgetTextAfter" style="width: 80%; height: 45px;"><?php _e(apply_filters('format_to_edit',$widgetOptions['w_quote_static_text_after']), 'shantzWpQotdWidget') ?></textarea></p>

                <input type="hidden" name="update_shantzWpQotdWidgetSettings" id="update_shantzWpQotdWidgetSettings" value="1" />
                </div>
                <?php

        }

    }//end widget class
}// end if class exists

//Init the admin panel
if (!function_exists("shantzWpQotd_ap")) {
    function shantzWpQotd_ap() {
        global $shantzWpQotdInstance;
        if(!isset($shantzWpQotdInstance)) {
            return;
        }
        if (function_exists('add_options_page')) {
            add_options_page('Shantanu\'s Wordpress Quotes Plugin Settings', 'Shantz WP Quotes', 9, basename(__FILE__), array($shantzWpQotdInstance, 'printAdminPage'));
        }
    }
}

if (class_exists("shantzWpQotdPlugin")) {
	$shantzWpQotdInstance = new shantzWpQotdPlugin();
}

if (class_exists("shantzWpQotdWidget")) {
	$shantzWpQotdWidgetInstance = new shantzWpQotdWidget();
}

if (isset($shantzWpQotdInstance)) {

    add_action('admin_menu', 'shantzWpQotd_ap');
    add_action('activate_shantz-wp-qotd/shantz-wp-qotd.php', array(&$shantzWpQotdInstance, 'init'));

    add_filter('the_content', array(&$shantzWpQotdInstance, 'process_quote'));
}

if (isset($shantzWpQotdWidgetInstance)) {

	add_action('plugins_loaded', array(&$shantzWpQotdWidgetInstance, 'widget_init'));

}

?>
