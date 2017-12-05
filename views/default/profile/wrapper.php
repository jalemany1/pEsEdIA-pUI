<?php
/**
 * Profile info box
 */
$owner = elgg_get_page_owner_entity();
?>

<div class="profile elgg-col-3of3 mrn">
	<div class="elgg-inner clearfix h-card vcard">
		<?php echo elgg_view('profile/owner_block'); ?>
		<?php echo elgg_view('profile/details'); ?>
	</div>
</div>
<div class="profile-wall elgg-col-2of3 mrn">
	<div class="elgg-main elgg-body">
		<?php
			elgg_push_context('wall');
			echo elgg_view('page/layouts/elements/header', array(
				'title' => elgg_echo('wall:owner', [$owner->getDisplayName()]),
			));
			echo elgg_view('framework/wall/container', []);
			echo elgg_view('lists/wall', array(
				'entity' => $owner,
				'limit' => elgg_extract('limit', $vars, elgg_get_config('default_limit')) ? : 10,
			));
			elgg_pop_context();
		?>
	</div>
</div>