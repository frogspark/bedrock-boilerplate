<header class="position-fixed py-3 py-lg-6 w-100">
 <div class="container">
   <div class="row">
     <div class="align-items-center col-6 col-lg-auto d-flex flex-row">
       <a class="logo" href="/"><img alt="Logo" src="<?php echo get_field('logo', 'option')['url']; ?>"></a>
     </div>
     <div class="align-items-center col-6 col-lg d-flex flex-row justify-content-end">
       <nav id="navigation">
         <?php $menu = wp_get_nav_menu_items('Main menu'); ?>
         <ul class="align-items-center d-flex flex-row justify-content-center nav">
           <?php foreach($menu as $item): ?>
             <li class="mx-4 nav-item"><a href="<?php echo $item->url; ?>"><?php echo $item->title; ?></a></li>
           <?php endforeach; ?>
         </ul>
       </nav>
     </div>
   </div>
 </div>
</header>