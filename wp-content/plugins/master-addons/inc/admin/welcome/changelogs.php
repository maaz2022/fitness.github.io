<div class="jltma-master-addons-tab-panel" id="jltma-master-addons-changelogs" style="display: none;">
	<div class="jltma-master-addons-features is-flex">
		<div class="jltma-left_column">
			<?php
			require_once(JLTMA_PATH . '/lib/readme-parser.php');
			$li = new WordPress_Readme_Parser();
			$t = $li->parse_readme(JLTMA_PATH . '/readme.txt');
			echo '<pre>' . wp_filter_nohtml_kses($t['sections']['changelog']) . '</pre>';
			?>
		</div>

		<div class="jltma-right_column">
			<?php require(JLTMA_PATH . '/inc/admin/welcome/right-column.php'); ?>
		</div>
	</div>
</div>
