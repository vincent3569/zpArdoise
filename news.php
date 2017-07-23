<?php include ('header.php'); ?>

		<div id="headline-news" class="clearfix">
			<?php if(is_NewsArticle()) { ?>
			<div class="control-nav-news">
				<div class="nav-img clearfix">
					<ul class="clearfix">
					<?php if (getPrevNewsURL()) { ?>
						<li><a href="<?php $article_url = getPrevNewsURL(); echo $article_url['link']; ?>" title="<?php echo $article_url['title']; ?>">&laquo; <?php echo gettext('plus r&eacute;cent'); ?></a></li>
					<?php } else { ?>
						<li class="disabledlink"><span>&laquo; <?php echo gettext('plus r&eacute;cent'); ?></span></li>
					<?php } ?>
					<?php if (getNextNewsURL()) { ?>
						<li><a href="<?php $article_url = getNextNewsURL(); echo $article_url['link']; ?>" title="<?php echo $article_url['title']; ?>"><?php echo gettext('plus ancien'); ?> &raquo;</a></li>
					<?php } else { ?>
						<li class="disabledlink"><span><?php echo gettext('plus ancien'); ?> &raquo;</span></li>
					<?php } ?>
					</ul>
				</div>
			</div>
			<?php } ?>
			<h4><?php printNewsIndexURL(gettext('News')); ?><?php printCurrentNewsCategory(' &raquo; Cat&eacute;gorie : '); ?><?php printCurrentNewsArchive(' | '); ?></h4>
		</div>

	<?php
	// single news article
	if(is_NewsArticle()) { ?>
		<div id="post" class="clearfix">
			<h3><?php printNewsTitle(); ?></h3>
			<div class="newsarticlecredit">
				<?php printNewsDate(); ?><?php printNewsCategories(', ', gettext(' | '), 'hor-list'); ?>
			</div>
			<?php if (getNewsExtraContent()) { ?>
			<div class="extra-content">
				<?php printNewsExtraContent(); ?>
			</div>
			<?php } ?>
			<?php 
			printNewsContent();
			printCodeblock(1);
			?>
		</div>

		<?php if (function_exists('printCommentForm')) { ?>
			<?php if (zenpageOpenedForComments() || (!zenpageOpenedForComments() && (getCommentCount() > 0))) { ?>
				<a class="fadetoggler"><img src="<?php echo $_zp_themeroot; ?>/images/search-drop.png" alt="search_drop" id="search_icon" /><?php echo gettext('Comments'); ?> (<?php echo getCommentCount(); ?>)</a>
				<div id="comment-wrap" class="fader clearfix">
					<?php printCommentForm(); ?>
				</div>
			<?php } ?>
		<?php } ?>

	<?php } else {
	// news article loop ?>

		<div class="pagination-news clearfix">
			<?php printNewsPageListWithNav('&raquo;', '&laquo;', true, 'clearfix'); ?>
		</div>

		<div id="post" class="clearfix">
			<div class="news-cat-list">
				<?php printAllNewsCategories(gettext('All news'), true, 'news-cat-list', 'news-cat-active'); ?>
			</div>

			<?php while (next_news('date', 'desc')): ; ?>
			<div class="news-truncate">
				<h3><?php printNewsTitleLink(); ?></h3>
				<div class="newsarticlecredit">
					<?php printNewsDate(); ?><?php printNewsCategories(', ', ' | ', 'hor-list'); ?>
				</div>
				<?php printNewsContent(); ?>
				<?php printNewsReadMoreLink(); ?>
			</div>
			<?php endwhile; ?>
		</div>
        
		<div class="pagination-news clearfix">
			<?php printNewsPageListWithNav(' &raquo; ', ' &laquo; ', true, 'clearfix'); ?>
		</div>
        
	<?php } ?>

<?php include('footer.php'); ?>