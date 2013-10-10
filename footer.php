<?php
//footer.php
?>



	<footer>
    	<div class="content">
        <!--  <p>This is the footer.</p> -->
        
            <?php
			  wp_nav_menu(array(
				  'theme_location' => 'footer-nav',
				  'container' => 'nav',
				  'container_id' => 'footerNav',
				  'container_class' => 'clearfix'
				  ));
            ?>
            <p class="credit spacer">
            	<a href="http://www.jesse-smith.net">Web design starting point by Jesse Smith</a>
            </p>
		</div>    

		<?php wp_footer(); ?>
        
	</footer>
</div> <!--! end of #container -->


        <script>
		/*  Google Analytics: change UA-XXXXX-X to be your site's ID.  */
		/* un-comment to enable. */
		/*
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
		*/	
        </script>
        
<!--[if lt IE 7 ]>
	<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.2/CFInstall.min.js"></script>
	<script>window.attachEvent("onload",function(){CFInstall.check({mode:"overlay"})})</script>
<![endif]-->

        
    </body>
</html>