	<?php
	switch ($_zp_gallery_page) {
		case 'album.php':
			$comments_open = getOption('comment_form_albums');
			$comments_allowed = getCommentsAllowed();
			break;
		case 'image.php':
			$comments_open = getOption('comment_form_images');
			$comments_allowed = getCommentsAllowed();
			break;
		case 'pages.php':
			$comments_open = getOption('comment_form_pages');
			$comments_allowed = zenpageOpenedForComments();
			break;
		case 'news.php':
			$comments_open = getOption('comment_form_articles');
			$comments_allowed = zenpageOpenedForComments();
			break;
		default:
			return;
			break;
	}
	?>

	<?php if ((function_exists('printCommentForm')) && ($comments_open)) { ?>
		<?php if ($comments_allowed || (getCommentCount() > 0 )) { ?>
			<a class="fadetoggler"><img src="<?php echo $_zp_themeroot; ?>/images/icon-comment.png" alt="icon-comment" id="icon-comment" />
			<?php
			$num = getCommentCount();
			if ($num == 0) {
				echo gettext('No Comments');
			} else {
				echo sprintf(ngettext('%u Comment','%u Comments',$num), $num);
			}
			?>
			</a>
			<div id="comment-wrap" class="fader clearfix">
				<?php printCommentForm(true, NULL, true); ?>
			</div>
		<?php } ?>
	<?php } ?>