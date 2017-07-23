<?php include ('header.php'); ?>

		<div id="post" class="clearfix">
			<h2><?php printPageTitle(); ?></h2>
			<?php if (getPageExtraContent()) { ?>
			<div class="extra-content">
				<?php printPageExtraContent(); ?>
			</div>
			<?php } ?>
			<?php
				printPageContent();
				printCodeblock(1);
			?>
		</div>

		<?php include('print_comment.php'); ?>

<?php include('footer.php'); ?>