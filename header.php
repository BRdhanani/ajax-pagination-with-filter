<!DOCTYPE html>
<html <?php language_attributes( ); session_start(); ?>>
<head>
    <meta charset="<?php bloginfo('charset');?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php bloginfo( 'name' )?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <?php wp_head();?>
    
</head>
<body <?php body_class();?> >
    <nav class="site-nav">

        <?php 

        $args = array(
            'theme_location' => 'primary'
        );
         
        ?>
        <?php wp_nav_menu( $args); ?>
    </nav>
    <br>
