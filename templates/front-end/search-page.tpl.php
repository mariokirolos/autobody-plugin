<?php

/*

	Template Name: Search Page Layout


*/
	wp_head();
?>
<body style="background-color:pink">


	<?php  if(have_posts()):
			while(have_posts()):
				the_post();
				the_content();
			endwhile;
	endif; ?>
	

</body>
<?php wp_footer();?>