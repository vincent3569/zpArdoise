		<div id="footer">

			<?php if ((getOption('allow_search')) || (function_exists('printAlbumMenu'))) { ?>
			<div id="jump-search" class="clearfix">
				<?php if (function_exists('printAlbumMenu')) { printAlbumMenu('jump', NULL, '', '', '', '', gettext('Gallery Index')); } ?>
				<?php if (getOption('allow_search')) { printSearchForm('', '', '', gettext('Search'), "$_zp_themeroot/images/search-drop.png"); } ?>
			</div>
			<?php } ?>

			<div id="foot-left">
				<div id="rsslinks">
					<?php printRSSLink('Gallery', '', gettext('Gallery'), '', true); ?>
					<?php if(function_exists('printZenpageRSSLink')) { ?>
						<?php printZenpageRSSLink('NewsWithImages', '', ' | ', gettext('News and Gallery'), '', true); ?>
					<?php } ?>
				</div>

				<div id="copyright">
					<?php echo getMainSiteName(); ?><?php printCustomPageURL(gettext('Archive View'), 'archive', '', ' | '); ?>
					<?php if (function_exists('printContactForm')) { ?><?php printCustomPageURL(gettext('Contact'), 'contact', '', ' | '); } ?>

					<?php
					if (function_exists('printUserLogin_out')) {
						if (zp_loggedin()) {
							printUserLogin_out(' | ', '');
						} else { ?>
							&nbsp;|&nbsp;<a href="<?php echo FULLWEBPATH . "/" . ZENFOLDER . "/admin.php"; ?>"><?php echo gettext("Log in"); ?></a>
						<?php
						}
					} ?>

					<?php
					if ((!zp_loggedin()) && (function_exists('printRegistrationForm'))) {
						printCustomPageURL(gettext('Register'), 'register', '', ' | ');
					} ?>
				</div>

				<div id="zpcredit">
					<?php printZenphotoLink(); ?>&nbsp;&nbsp;
					<?php if	(($_zp_gallery_page == 'image.php') ||
								(($_zp_gallery_page == 'album.php') && (getOption('use_galleriffic'))) ||
								((function_exists('is_NewsArticle')) && (is_NewsArticle()))) { ?>
					&nbsp;<img src="<?php echo $_zp_themeroot; ?>/images/info.png" title="<?php echo gettext_th('You can browse with the arrows keys of your keyboard'); ?>" alt="info_icon" />
					<?php } ?>
				</div>

			</div>

		</div>	<!-- END #FOOTER -->

	</div>		<!-- END #CONTAINER -->

</div>			<!-- END #PAGE -->
<?php
printAdminToolbox();
zp_apply_filter('theme_body_close');
?>

</body>
</html>			<!-- zpArdoise 1.3 - a ZenPhoto/ZenPage theme by Vincent3569  -->