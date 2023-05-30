<?php
/* 
Plugin Name: Thay đổi form Login
Description: Thay đổi form Login
Author: NhatQuang
Text Domain: NhatQuang
Version:0.1
 */

function my_login_logo()
{
    $logo = get_theme_mod('login_logo');
?>
    <style type="text/css">
        #login h1 a,
        .login h1 a {
            background-image: url(<?php echo $logo; ?>);
            height: 125px;
            width: 125px;
            background-size: cover;
            background-repeat: no-repeat;
            padding-bottom: 30px;
            border-radius: 100%;
        }
    </style>
<?php }
add_action('login_enqueue_scripts', 'my_login_logo');

//add section to edit login page
function customize_login_page_register($wp_customize)
{
    // adding section in wordpress customizer
    $wp_customize->add_section('login_extras_section', array(
        'title'  => 'Login page'
    ));

    //adding setting for coppyright text
    $wp_customize->add_setting('login_logo', array(
        'capability'        => 'edit_theme_options',
        'default'           => '',
        'sanitize_callback' => 'ic_sanitize_img',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'login_logo',
        array(
            'label'         => __('Thay đổi logo', 'storefront'),
            'description'   => __('Height: &gt;80px', 'storefront'),
            'section'       => 'login_extras_section',
            'settings'      => 'login_logo',
            'priority'      => 1,
        )
    ));
}

add_action('customize_register', 'customize_login_page_register');

?>