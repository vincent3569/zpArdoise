	<?php switch ($_zp_gallery_page) {
		case 'album.php':
			$comments_open = getOption('comment_form_albums');
			$comments_allowed = getCommentsAllowed();
			break;
		case 'image.php':
			$comments_open = getOption('comment_form_images');
			$comments_allowed = getCommentsAllowed();
			break;
		case ZENPAGE_PAGES.'.php':
			$comments_open = getOption('comment_form_pages');
			$comments_allowed = zenpageOpenedForComments();
			break;
		case ZENPAGE_NEWS.'.php':
			$comments_open = getOption('comment_form_articles');
			$comments_allowed = zenpageOpenedForComments();	
			break;
		default:
			return;
			break;
	} ?>

	<?php if ((function_exists('printCommentForm')) && ($comments_open)) { ?>
		<?php if ($comments_allowed || (getCommentCount() > 0 )) { ?>
			<a class="fadetoggler"><img src="<?php echo $_zp_themeroot; ?>/images/search-drop.png" alt="search_drop" id="search_icon" />
			<?php if ((getCommentCount() == 0) || (getCommentCount() == 1)) {
				echo gettext('comment').' ('.getCommentCount().')';
			} else {
				echo gettext('comments').' ('.getCommentCount().')';
			} ?>
			</a>
			<div id="comment-wrap" class="fader clearfix">
				<?php printCommentForm(true, NULL, true); ?>
			</div>
		<?php } ?>
	<?php } ?>