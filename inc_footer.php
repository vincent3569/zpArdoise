	</div>		<!-- END #CONTAINER -->

	<div id="footer">
		<?php if ((getOption('allow_search')) || (function_exists('printAlbumMenu'))) { ?>
		<div id="jump-search" class="clearfix">
			<?php if (function_exists('printAlbumMenu')) {
				printAlbumMenu('jump', NULL, '', '', '', '', gettext('Gallery Index'));
			}
			if (getOption('allow_search')) {
				printSearchForm('', 'search', '', gettext('Search'), "$_zp_themeroot/images/search-drop.png", null, null,"$_zp_themeroot/images/reset.gif" );
			} ?>
		</div>
		<?php } ?>

		<div id="foot-left">
			<div id="rsslinks">
				<?php printRSSLink('Gallery', '', gettext('Gallery'), '', true); ?>
				<?php if (function_exists('printZenpageRSSLink')) { ?>
					<?php printZenpageRSSLink('NewsWithImages', '', ' | ', gettext('News and Gallery'), '', true); ?>
				<?php } ?>
			</div>

			<div id="copyright">
				<?php echo getMainSiteName(); ?><?php printCustomPageURL(gettext('Archive View'), 'archive', '', ' | '); ?>
				<?php if (function_exists('printContactForm')) { ?><?php printCustomPageURL(gettext('Contact'), 'contact', '', ' | '); } ?>

				<?php if (function_exists('printUserLogin_out')) { ?>
					<?php printUserLogin_out(' | ', '', 2); ?>
				<?php } ?>

				<?php if ((!zp_loggedin()) && (function_exists('printRegistrationForm'))) { ?>
					<?php printCustomPageURL(gettext('Register'), 'register', '', ' | '); ?>
				<?php } ?>
			</div>

			<div id="zpcredit">
				<?php printZenphotoLink(); ?>
				<?php if (($_zp_gallery_page == 'image.php') ||
						(($_zp_gallery_page == 'album.php') && (getOption('use_galleriffic'))) ||
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
<!-- zpArdoise 1.4.2 - a ZenPhoto/ZenPage theme by Vincent3569  -->