<?php include ('header.php'); ?>

		<div id="post" class="clearfix">
			<h3><?php printPageTitle(); ?></h3>
			<?php if (getPageExtraContent()) { ?>
			<div class="extra-content">
				<?php printPageExtraContent(); ?>
			</div>
			<?php } ?>
			
			<?php printPageContent(); ?>
			<?php printCodeblock(1); ?>
		</div>

		<?php include('print_comment.php'); ?>

<?php include('footer.php'); ?>