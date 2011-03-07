<?php get_header(); ?>
	<div id="content">
		<?php get_sidebar(); ?>

		<div id="posts">
		<?php if (have_posts()) : ?>
		<?php
            while (have_posts()) :
            the_post();
                if (has_post_format('link')):
                    // See http://codex.wordpress.org/Function_Reference/the_content
                    // You must apply the filers manually, someone at wordpress needs to stop this and make it consistent
                    $content = get_the_content();
                    // Cheap substitution on the way
                    preg_match('/<a.*>.*<\/a>/i', $content, $linkme);
                    $content = str_replace($linkme[0], '', $content);
                    $content = apply_filters('the_content', $content);
                    $content = str_replace(']]>', ']]&gt;', $content);
                    ?>
                    <div class="post" id="post-<?php the_ID(); ?>">
                        <h2><img src="<?php bloginfo('template_directory'); ?>/images/link.png" width="32" height="32" alt="Link" /> <?php echo $linkme[0] ?></h2>
                        <div class="postcontent" style="padding-left: 10px;"><?php echo $content; ?></div>
                        <div style="clear: both;">
                            <div class="alignleft metadata"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_time('F jS, Y') ?></a> by <?php the_author() ?> in <?php the_category(', ') ?> <?php the_tags() ?></div>
                            <div class="commentlink"><?php comments_popup_link('No Comments, add yours', '1 Comment, add yours', '% Comments, add yours'); ?></div>
                        </div>
                    </div>
                <?php

                else:
                    ?>
                    <div class="post" id="post-<?php the_ID(); ?>">
                        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                        <div class="metadata"><?php the_time('F jS, Y') ?> by <?php the_author() ?> in <?php the_category(', ') ?> <?php the_tags() ?></div>
                        <div class="postcontent"><?php echo the_content('Read the rest of this entry &raquo;'); ?></div>
                        <div class="commentlink"><?php comments_popup_link('No Comments, add yours', '1 Comment, add yours', '% Comments, add yours'); ?></div>
                    </div>
                <?php
                endif;
            endwhile;
        ?>
			<div class="navigation">
				<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
				<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
			</div>
		<?php else : ?>
			<h2 class="center">Not Found</h2>
			<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php include (TEMPLATEPATH . "/searchform.php"); ?>
		<?php endif; ?>
		</div>
	</div>
<?php get_footer(); ?>