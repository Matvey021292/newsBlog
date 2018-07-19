<?php

if ( is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
?>


<div class="aside-wrapper information-wrapper" id="aside">
    <div class="widget">
        <div>
            <h3 class="aside-title"><span>КРИПТОВАЛЮТЫ</span></h3>
          
        </div>
<!--        <div>-->
<!--            <h3 class="aside-title">ТОВАРЫ</h3>-->
<!--            <div class="list commodities"></div>-->
<!--        </div>-->
        <div>
            <h3 class="aside-title"><span>ВАЛЮТЫ</span></h3>
          
        </div>
    </div>
</div>

	<?php dynamic_sidebar( 'sidebar-2' ); ?>
<!-- navigation-conteiner -->

<!-- navigation-conteiner -->
