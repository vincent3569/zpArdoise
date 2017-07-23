		<div id="footer">

			<?php if ((getOption('allow_search')) || (function_exists('printAlbumMenu'))) { ?>
			<div id="jump-search" class="clearfix">
				<?php if (function_exists('printAlbumMenu')) { printAlbumMenu('jump'); } ?>
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
					<p><?php echo getMainSiteName(); ?><?php printCustomPageURL(gettext('Archive View'), 'archive', '', ' | '); ?><?php if (function_exists('printContactForm')) { ?><?php printCustomPageURL(gettext('Contact'), 'contact', '', ' | '); } ?><?php if (function_exists('printUserLogin_out')) {printUserLogin_out(' | ', ''); } ?></p>
				</div>

				<div id="zpcredit">
					<?php printZenphotoLink(); ?>
				</div>

				<div id="info">
					<?php if (($_zp_gallery_page == 'image.php') || (($_zp_gallery_page == 'album.php') && (getOption('use_galleriffic')))) {
						echo("Vous pouvez naviguer sur les photos &agrave; l'aide des fl&ecirc;ches &larr; et &rarr; de votre clavier");
					} ?>
				</div>
			</div>
			
		</div>	<!-- END #FOOTER -->
			
	</div>		<!-- END #CONTAINER -->

</div>			<!-- END #PAGE -->
<?php printAdminToolbox(); ?>

</body>
</html>			<!-- zpArdoise 1.0 - a ZenPhoto/ZenPage theme by Vincent3569  -->