	</div>		<!-- END #CONTAINER -->

	<div id="footer">
		<?php if ((getOption('allow_search')) || (function_exists('printAlbumMenu'))) { ?>
		<div id="jump-search" class="clearfix">
			<?php
			if (function_exists('printAlbumMenu')) {
				printAlbumMenu('jump', NULL, '', '', '', '', gettext('Gallery Index'));
			}
			if (getOption('allow_search')) {
				printSearchForm('', 'search', '', gettext('Search'), "$_zp_themeroot/images/search-drop.png", NULL, NULL,"$_zp_themeroot/images/reset.gif" );
			}
			?>
		</div>
		<?php } ?>

		<div id="foot-left">
			<?php if ((getOption('RSS_album_image')) || ((getOption('RSS_articles')) && (function_exists('printZenpageRSSLink')))) { ?>
			<div id="rsslinks">
				<?php
				$separ = '';
				if (getOption('RSS_album_image')) {
					printRSSLink('Gallery', '', gettext('Gallery'), '', false, 'rss');
					$separ = ' | ';
				}
				if ((getOption('RSS_articles')) && (function_exists('printZenpageRSSLink'))) {
					printZenpageRSSLink('NewsWithImages', '', $separ, gettext('News and Gallery'), '', false, 'rss');
				}
				?>
				<script type="text/javascript">
				//<![CDATA[
					$('.rss').prepend('<img alt="RSS Feed" src="<?php echo $_zp_themeroot; ?>/images/rss.png">&nbsp;');
				//]]>
				</script>
			</div>
			<?php } ?>

			<div id="copyright">
				<?php
				echo getMainSiteName();
				printCustomPageURL(gettext('Archive View'), 'archive', '', ' | ');

				if (function_exists('printUserLogin_out')) {
					printUserLogin_out(' | ', '', 2);
				}
				if ((!zp_loggedin()) && (function_exists('printRegistrationForm'))) {
					printCustomPageURL(gettext('Register'), 'register', '', ' | ');
				}
				?>
			</div>

			<div id="zpcredit">
				<?php printZenphotoLink(); ?>
				<?php if (($_zp_gallery_page == 'image.php') ||
						(($_zp_gallery_page == 'album.php') && (getOption('use_galleriffic')) && (getNumImages() > 0)) ||
						((function_exists('is_NewsArticle')) && (is_NewsArticle()))) { ?>
					<img id="icon-help" src="<?php echo $_zp_themeroot; ?>/images/help.png" title="<?php echo gettext_th('You can browse with the arrows keys of your keyboard'); ?>" alt="help" />
				<?php } ?>
			</div>
		</div>
	</div>		<!-- END #FOOTER -->
</div>			<!-- END #PAGE -->

<?php
	printAdminToolbox();
	zp_apply_filter('theme_body_close');
?>

</body>
</html>
<!-- zpArdoise 1.4.3.1 - a ZenPhoto/ZenPage theme by Vincent3569  -->