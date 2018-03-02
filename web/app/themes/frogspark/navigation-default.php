<?php

 $menuitems = wp_get_nav_menu_items(3, array( 'order' => 'DESC' ) ); //3 references the menu id

?>

  <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="/home"></a>
        </div>
        <div id="navbar">
          <ul class="nav navbar-nav">
            <li><a href="/menus/" >Menus</a></li>
            <li>
              <a href="/services/">Services <span class="navbar-nav__tab">></span></a>
              <ul class="navbar-nav__dropdown">
              </ul>    
            </li>
            <li><a href="/about/" >About</a></li>
            <li><a href="/locations/" >Locations</a></li>
            <li><a href="/blog/" >Blog</a></li>
            <li><a href="/contact/" >Contact</a></li>
            <li class="navbar-nav__contact">
              <span class="navbar-nav__accent">Call: <a href="tel:<?php echo get_theme_mod('phone_setting'); ?>"><?php echo get_theme_mod('phone_setting'); ?></a></span>
              <span class="navbar-nav__accent"><a href="mailto:<?php echo get_theme_mod('contact_email'); ?>"><?php echo get_theme_mod('contact_email'); ?></a></span>
            </li>
          </ul>
        </div>
        <div class="mobile-nav">						
  				<button class="hamburger hamburger--3dx" type="button" onclick="">
  					<span class="hamburger-box">
  						<span class="hamburger-inner"></span>
  					</span>
  				</button>
  			</div>
    </div>
  </nav>
     
  <div class="topgap"></div>