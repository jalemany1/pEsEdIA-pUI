<?php
/**
* Profile widgets/tools
* 
* @package ElggGroups
*/ 
	
//AGUS sobrescribe la vista del plugin groups. Reemplaza la zona de widgets de la página de un grupo por su muro

$owner = elgg_get_page_owner_entity();
?>

	<div> 
            <?php
		echo elgg_view('groups/sidebar/members', array(
				'entity' => $owner));

            ?>
	</div>
	<div class="groups-profile clearfix elgg-image-block">
		<?php
			elgg_push_context('wall');

			echo '<div class="elgg-head"><h3>';
			echo elgg_echo('wall');
			echo '</h3></div>';
			echo elgg_view('framework/wall/container', []);
			echo elgg_view('lists/wall', array(
				'entity' => $owner,
				'limit' => 5,
			));
			elgg_pop_context();
		?>
	</div>
