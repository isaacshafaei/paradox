<?php 
if(is_active_sidebar( 'sidebar-1' )){ ?>
<aside class="sidebar sticky-sidebar">
    <div class="theiaStickySidebar">
     <?php dynamic_sidebar( 'sidebar-1' ); ?>
    </div>
</aside>
<?php }