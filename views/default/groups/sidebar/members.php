<?php
/**
 * Group members sidebar
 *
 * @package ElggGroups
 *
 * @uses $vars['entity'] Group entity
 * @uses $vars['limit']  The number of members to display
 */

$limit = elgg_extract('limit', $vars, 14);

$group = $vars['entity'];

$num_members = $group->getMembers(array('count' => true));

$all_link = elgg_view('output/url', array(
	'href' => 'groups/members/' . $vars['entity']->guid,
	'text' => elgg_echo('groups:members:more') . ' ('. $num_members . ')',
	'is_trusted' => true,
));

$body = elgg_list_entities_from_relationship(array(
	'relationship' => 'member',
	'relationship_guid' => $vars['entity']->guid,
	'inverse_relationship' => true,
	'type' => 'user',
	'limit' => $limit,
	'order_by' => 'r.time_created DESC',
	'pagination' => false,
	'list_type' => 'gallery',
	'gallery_class' => 'elgg-gallery-users',
));

$body .= "<div class='left mts'>$all_link</div>";

echo elgg_view_module('aside', elgg_echo('groups:members'), $body);
