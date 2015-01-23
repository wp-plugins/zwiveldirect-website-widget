<?php
/*
Plugin Name: Zwivel Widget
Plugin URI: http://www.zwivel.com/
Description: A plugin that adds the Zwivel widget to your website
Version: 0.1
Author: Zwivel LLC
Author URI: http://www.zwivel.com/
License: GPL2
*/

/*  Copyright 2015  VivifyIdeas  (email : zwivel@vivifyideas.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class wp_zwivel_widget extends WP_Widget {

    // constructor
    function wp_zwivel_widget() {
        parent::WP_Widget(false, $name = __('Zwivel Widget', 'wp_zwivel_widget') );
    }

    // widget form creation
    function form($instance) {  
        
        // Check values
        if( $instance) {
             $url = esc_attr($instance['url']);
        } else {
             $url = '';
        }
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('ZwivelDirect URL', 'wp_zwivel_widget'); ?>*</label>
            <input class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo $url; ?>" />
            <small>*copy/paste the link to your ZwivelDirect profile here</small>
        </p>
        <?php
    }

    // widget update
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        // Fields
        $instance['url'] = strip_tags($new_instance['url']);
        return $instance;
    }

    // widget display
    function widget($args, $instance) {
        extract( $args );
        $url = $instance['url'];

        if( $url ) {
            $matches = array();
            preg_match('/zwivel.com\/(.*)\/direct/', $url, $matches);
            $widget_url = '<script id="zwivelWidgetSnippet" src="http://zwivel.com/widget/'.$matches[1].'"></script>';
            echo $widget_url;
        }
    }
}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("wp_zwivel_widget");'));

?>