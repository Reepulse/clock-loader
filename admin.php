<?php

function pl_admin_include_files()
{
    wp_register_script( 'pl-script', plugins_url( 'script.js', __FILE__ ) );
    wp_enqueue_script( 'pl-script' );
	wp_register_style('pl-style', plugins_url('style.css',__FILE__ ));
	wp_enqueue_style('pl-style');
}
add_action( 'admin_enqueue_scripts', 'pl_admin_include_files' );

add_action( 'admin_menu', 'clock_loader_menu' );

function clock_loader_menu() {
	add_options_page( __('Clock Loader','clock-loader'), __('Clock Loader Settings','clock-loader'), 'manage_options', 'clock-loader-setting', 'clock_loader_admin' );
	add_action( 'admin_init', 'register_clock_loader_settings' );
}

function register_clock_loader_settings() {
	register_setting( 'clock-loader-options', 'icon_color' );
	register_setting( 'clock-loader-options', 'background_color' );
	register_setting( 'clock-loader-options', 'loader_icon' );
}

function clock_loader_admin() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	?>
	
	<div class="wrap">
	
	<h1>clock Loader</h1>
	
	<p>Here you can manage options of clock Loader plugin.</p>
	
	<form method="post" action="options.php">
    <?php settings_fields( 'clock-loader-options' ); ?>
    <?php do_settings_sections( 'clock-loader-options' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">clock border color</th>
        <td><input type="text" name="icon_color" class="pl-color-picker" data-default-color="#000000" value="<?php echo esc_attr( get_option('icon_color') ); ?>" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Background Color</th>
        <td><input type="text" name="background_color" class="pl-color-picker" data-default-color="#ffffff" value="<?php echo esc_attr( get_option('background_color') ); ?>" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Loader</th>
        <td>
            <select name="loader_icon">
                <option value="plcircle" <?php selected( esc_attr( get_option('loader_icon') ), 'plcircle' ); ?>>Clock</option>
            </select>
        </tr>
    </table>
    
    
    <?php submit_button(); ?>

	
	<?php
}

add_action( 'admin_enqueue_scripts', 'pl_add_color_picker' );
function pl_add_color_picker() {
    wp_enqueue_style( 'wp-color-picker' ); 
    wp_enqueue_script( 'pl-color-picker-js', plugins_url( 'hue-selector.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
}

?>