<!doctype html>  

<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		
		<title><?php wp_title('-', true, 'left'); ?></title>
				
		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		
		<!-- iconos & favicons -->
		<!-- Para iPhone 4 -->
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://emslinux.com/wp-content/themes/wordpress-bootstrap-spanish/library/images/icons/h/apple-touch-icon.png">
		<!-- Para iPad 1-->
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="http://emslinux.com/wp-content/themes/wordpress-bootstrap-spanish/library/images/icons/m/apple-touch-icon.png">
		<!-- Para iPhone 3G, iPod Touch y Android -->
		<link rel="apple-touch-icon-precomposed" href="http://emslinux.com/wp-content/themes/wordpress-bootstrap-spanish/library/images/icons/l/apple-touch-icon-precomposed.png">
		<!-- Para Nokia -->
		<link rel="shortcut icon" href="http://emslinux.com/wp-content/themes/wordpress-bootstrap-spanish/library/images/icons/l/apple-touch-icon.png">
		<!-- Para todo lo demás -->
		<link rel="shortcut icon" href="http://emslinux.com/wp-content/themes/wordpress-bootstrap-spanish/favicon.ico">
		
		<!-- media-queries.js (de reserva) -->
		<!--[if lt IE 9]>
			<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>			
		<![endif]-->

		<!-- html5.js -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		
  		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		
  		<link rel="stylesheet/less" type="text/css" href="<?php echo get_template_directory_uri(); ?>/less/bootstrap.less">
  		<link rel="stylesheet/less" type="text/css" href="<?php echo get_template_directory_uri(); ?>/less/responsive.less">

		<!-- funciones de la cabecera de wordpress -->
		<?php wp_head(); ?>
		<!-- fin de la cabecera de wordpress -->

		<!-- opciones del tema desde el panel de opciones -->
		<?php get_wpbs_theme_options(); ?>

		<?php 

			// comprueba el nivel del usuario wp
			get_currentuserinfo(); 
			// almacena para usar después
			global $user_level; 

			// obtener la lista de los nombres de entrada para usarlos en el plugin 'typeahead' para la barra de búsqueda
			if(of_get_option('search_bar', '1')) { // solamente hacer esto si estamos mostrando la barra de búsqueda en la barra de navegación

				global $post;
				$tmp_post = $post;
				$get_num_posts = 40; // volver y obtener esta cantidad de títulos de entrada
				$args = array( 'numberposts' => $get_num_posts );
				$myposts = get_posts( $args );
				$post_num = 0;

				global $typeahead_data;
				$typeahead_data = "[";

				foreach( $myposts as $post ) :	setup_postdata($post);
					$typeahead_data .= '"' . get_the_title() . '",';
				endforeach;

				$typeahead_data = substr($typeahead_data, 0, strlen($typeahead_data) - 1);

				$typeahead_data .= "]";

				$post = $tmp_post;

			} // terminar si la barra de búsqueda es usada

		?>
				
	</head>
	
	<body <?php body_class(); ?>>
				
		<header role="banner">
		
			<div id="inner-header" class="clearfix">
				
				<div class="navbar navbar-fixed-top">
					<div class="navbar-inner">
						<div class="container-fluid nav-container">
							<nav role="navigation">
								<a class="brand" id="logo" title="<?php echo get_bloginfo('description'); ?>" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
								
								<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
							        <span class="icon-bar"></span>
							        <span class="icon-bar"></span>
							        <span class="icon-bar"></span>
								</a>
								
								<div class="nav-collapse">
									<?php bones_main_nav(); // Ajusta usando Menús en el administrador de Wordpress ?>
								</div>
								
							</nav>
							
							<?php if(of_get_option('search_bar', '1')) {?>
							<form class="navbar-search pull-right" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
								<input name="s" id="s" type="text" class="search-query" autocomplete="off" placeholder="<?php _e('Buscar','bonestheme'); ?>" data-provide="typeahead" data-items="4" data-source='<?php echo $typeahead_data; ?>'>
							</form>
							<?php } ?>
							
						</div>
					</div>
				</div>
			
			</div> <!-- fin de #inner-header -->
		
		</header> <!-- fin de la cabecera -->
		
		<div class="container-fluid">