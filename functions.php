<?php

function scripts()
{
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.6' );
	wp_enqueue_style( 'blog', get_template_directory_uri() . '/css/blog.css' );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '3.3.6', true );
}
add_action( 'wp_enqueue_scripts', 'scripts' );

function gFonts()
{
	wp_register_style('OpenSans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800');
	wp_enqueue_style( 'OpenSans');
}
add_action('wp_print_styles', 'gFonts');

add_theme_support( 'title-tag' );

function settingsMenuAdd()
{
	add_menu_page( 'Custom Settings', 'Custom Settings', 'manage_options', 'custom-settings', 'pageSettings', null, 99 );
}
add_action( 'admin_menu', 'settingsMenuAdd' );

function pageSettings() { ?>
	<div class="wrap">
		<h1>Custom Settings</h1>
		<form method="post" action="options.php">
				<?php
					settings_fields( 'section' );
					do_settings_sections( 'theme-options' );
					submit_button();
				?>
		</form>
	</div>
<?php }


function settingTwitter()
{
?>
	<input type="text" name="twitter" id="twitter" value="<?php echo get_option( 'twitter' ); ?>" />
<?php
}

function settingGithub()
{
?>
	<input type="text" name="github" id="github" value="<?php echo get_option('github'); ?>" />
<?php
}

function customSettings()
{
	add_settings_section( 'section', 'All Settings', null, 'theme-options' );
	add_settings_field( 'twitter', 'Twitter URL', 'settingTwitter', 'theme-options', 'section' );
	add_settings_field( 'github', 'GitHub URL', 'settingGithub', 'theme-options', 'section' );
	register_setting('section', 'twitter');
	register_setting( 'section', 'github' );
}
add_action( 'admin_init', 'customSettings' );
?>