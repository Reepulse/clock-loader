<?php /*
Plugin Name: clock loader
Description: clock loader is a  Wordpress plugin to show an clock while page is being loaded.
Version:     1.0.0
Author:      Reepulse	
*/

function pl_include_files()
{
    wp_register_script( 'pl-script', plugins_url( 'script.js', __FILE__ ) );
    wp_enqueue_script( 'pl-script' );
	wp_register_style('pl-style', plugins_url('style.css',__FILE__ ));
	wp_enqueue_style('pl-style');
}
add_action( 'wp_enqueue_scripts', 'pl_include_files', 0 );


function page_loader() {
?>
<style>

</style>
<div id="plcover" style="background: <?php
$backgroundcolor = esc_attr( get_option('background_color') );
if (empty($backgroundcolor)) { echo '#ffffff'; } else { echo $backgroundcolor; }
?>">
<div id="plcontent">

<div class="<?php
$loadericon = esc_attr( get_option('loader_icon') );
if (empty($loadericon)) { echo 'plcircle'; } else { echo $loadericon; }
?>" style="<?php
	    if ( $loadericon == "plcircle" || $loadericon == "plfan" || empty($loadericon)) {
	    echo 'border-color: ';
	    } else if ( $loadericon == "plcircle2" ) {
	    echo 'border-top-color: ';
	    } else {
	    echo 'background: ';
	    }
	    $iconcolor = esc_attr( get_option('icon_color') );
		if (empty($iconcolor)) { echo '#000000'; } else { echo $iconcolor; }
	    ?>;"></div>



</div>
</div>
<?php
}
add_action( 'wp_head', 'page_loader', 0 );

include( plugin_dir_path( __FILE__ ) . 'admin.php');

?>