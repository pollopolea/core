<div class="update" data-productname="<?php p($_['productName']) ?>" data-version="<?php p($_['version']) ?>">
	<div class="updateOverview">
		<h2 class="title"><?php p($l->t('%s needs be updated to version %s',
				array($_['productName'], $_['version']))); ?></h2>
		<div class="infogroup">
		<ul>
			<li class='update'>
				<?php p($l->t('Please use the command line updater to update your %s.', [$theme->getName()])) ?><br><br>
				<?php print_unescaped($l->t('For further documentation please read our <a target="_blank" rel="noreferrer" href="%s">documentation</a>.', [link_to_docs('admin-cli-upgrade')])) ?><br><br>
				<?php p($l->t('Thank you for your patience.')); ?><br><br>
			</li>
		</ul>
		</div>
	</div>
</div>
