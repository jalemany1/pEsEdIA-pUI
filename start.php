<?php

// Ajustes para ajustar el comportamiento de Elgg para Pesedia

elgg_register_event_handler('init', 'system', 'pesedia_init');

/**
 * Init plugin.
 */
function pesedia_init() {

	// Eliminamos el enlace al canal RSS
	elgg_unregister_plugin_hook_handler('output:before', 'layout', 'elgg_views_add_rss_link');

	// Eliminamos los widgets en el perfil del grupo
	elgg_register_plugin_hook_handler('view', 'groups/profile/widgets', 'myplugin_alter_groups_profile_widgets');

	// Cambiamos el tamaño del avatar que aparece en la topbar
	elgg_register_event_handler('pagesetup', 'system', 'profile_pagesetup_tiny', 60);

	// Cambios de estilo para dar el "look" Pesedia
	elgg_extend_view('css/elgg', 'pesedia/css', 1000);

	/* Simplificar vista River ocultando elementos */
	elgg_extend_view('css/elgg', 'pesedia/simplifier.css', 1000);

	/* Para eliminar el menú contextual que aparece al mover el ratón sobre el avatar de un usaurio
	 he modificado el fichero /pesediaDemo/public_html/vendor/elgg/elgg/js/lib/ui.js a partir de la línea 187
	 Pendiente encontrar un método menos intrusivo.
	*/

	/* Cambia el icono de las notificaciones (NOTIFIER). */
	//elgg_unregister_plugin_hook_handler('register', 'menu:topbar', 'notifier_topbar_menu_setup');
	//elgg_register_plugin_hook_handler('register', 'menu:topbar', 'notifier_topbar_menu_setup_pesedia');

	/* Improve content reporting */
	// Remove ReportContent icon from right-space (extras) options
	elgg_unregister_menu_item('extras', 'report_this');
	// Add ReportContent option for each ElggEntity
	elgg_register_plugin_hook_handler('register', 'menu:river', 'add_reportcontent_option');
	elgg_register_plugin_hook_handler('register', 'menu:entity', 'add_reportcontent_option');

	/* Extended Access_Menu_Item plugin to provide support for the River */
	elgg_register_plugin_hook_handler('register', 'menu:river', 'menus_access_river_menu_setup', 999);

	/* Improve topbar and include search in it */
	elgg_register_event_handler('pagesetup', 'system', 'reformat_topbar', 1000);

	//elgg_unregister_menu_item('footer','powered');
}



function myplugin_alter_groups_profile_widgets($hook, $type, $returnvalue, $params) {
	if ($params['viewtype'] !== 'default') {
		return $returnvalue;
	}

	return '';
}

// Cambia el avatar de la topbar a tamaño tiny. Basada en la función profile_pagesetup de "vendor/elgg/elgg/mod/profile/start.php"
function profile_pagesetup_tiny() {
	$viewer = elgg_get_logged_in_user_entity();
	if (!$viewer) {
		return;
	}
	
	elgg_register_menu_item('topbar', array(
		'name' => 'profile',
		'href' => $viewer->getURL(),
		'text' => elgg_view('output/img', array(
			'src' => $viewer->getIconURL('tiny'), // AGUS aumenta el tamaño del avatar de la topbar
			'alt' => $viewer->name,
			'title' => elgg_echo('profile'),
			'class' => 'elgg-border-plain elgg-transition',
		)),
		'priority' => 100,
		'link_class' => 'elgg-topbar-avatar',
		'item_class' => 'elgg-avatar elgg-avatar-topbar',
	));
}


/* Reemplaza a notifier_topbar_menu_setup de mod/notifier/start.php */
function notifier_topbar_menu_setup_pesedia ($hook, $type, $return, $params) {
	if (elgg_is_logged_in()) {
		// Get amount of unread notifications
		$count = (int)notifier_count_unread();

		$text = elgg_view_icon('bell'); // Este es el cambio 
		$tooltip = elgg_echo("notifier:unreadcount", array($count));

		if ($count > 0) {
			if ($count > 99) {
				// Don't allow the counter to grow endlessly
				$count = '99+';
			}
			$hidden = '';
		} else {
			$hidden = 'class="hidden"';
		}

		$text .= "<span id=\"notifier-new\" $hidden>$count</span>";

		$item = ElggMenuItem::factory(array(
				'name' => 'notifier',
				'href' => '#notifier-popup',
				'text' => $text,
				'priority' => 600,
				'title' => $tooltip,
				'rel' => 'popup',
				'id' => 'notifier-popup-link'
		));

		$return[] = $item;
	}

	return $return;
}


/**
 * Add ReportContent option for each Elgg RiverItem or Entity
 *
 * @param string 	$hook 		'register'
 * @param string 	$type 		['menu:river'|'menu:entity']
 * @param array 	$return 	Menu items
 * @param array 	$params 	Hook params
 * @return ElggMenuItem[]
 */
function add_reportcontent_option($hook, $type, $return, $params) {

	/* @var ElggEntity $entity */
	$entity = $params['item'] ? $params['item']->getObjectEntity() :
			 ($params['entity'] ? $params['entity'] : null);

	// Check requirements
    if (!elgg_is_logged_in() || !$entity || !elgg_instanceof($entity)) {
        return $return;
    }

    $title = empty($entity->title) ? get_class($entity) : $entity->title;
    $href = elgg_http_add_url_query_elements('reportedcontent/add', [
		'address' => $entity->getURL(),
		'title' => $title,
	]);
	
	$return[] = \ElggMenuItem::factory([
		'name' => 'report',
		'text' => elgg_echo('reportedcontent:report'),
		'href' => $href,
		'section' => 'action',
		'link_class' => 'elgg-lightbox',
		'deps' => 'elgg/reportedcontent',
	]);

	return $return;
}

/**
 * When 'user_friends' plugin is enabled, this function filters the
 * actions to enable them only in Request View
 *
 * @param string 	$hook 		'register'
 * @param string 	$type 		'menu:river'
 * @param array 	$return 	Array of ElggMenuItems[]
 * @param array 	$params 	Hook params
 * @return ElggMenuItem[]
 */
function menus_access_river_menu_setup($hook, $type, $return, $params) {
	$item = elgg_extract('item', $params);
	$entity = $item->getObjectEntity();

	if ($entity instanceof ElggUser) {
		$item_menu = \ElggMenuItem::factory([
			'name' => 'access',
			'data' => array('subsection' => 'access'),
			'text' => elgg_view_icon('globe'),
			'data-guid' => $entity->guid,
		]);
	} else {
		$item_menu = \ElggMenuItem::factory([
			'name' => 'access',
			'data' => array('subsection' => 'access'),
			'text' => elgg_view_icon(menus_access_get_icon($entity)),
			'href' => "ajax/view/menus/access?guid=$entity->guid",
			'link_class' => 'elgg-lightbox',
			'data-guid' => $entity->guid,
			'data-colorbox-opts' => json_encode([
				'maxWidth' => '600px'
			]),
		]);
	}

	$return[] = $item_menu;
	return $return;
}

/**
 * Rearrange menu items
 */
function reformat_topbar() {

	elgg_unextend_view('page/elements/sidebar', 'search/header');
	
	if (elgg_is_logged_in()) {

		$user = elgg_get_logged_in_user_entity();
		/*$item = elgg_get_menu_item('topbar', 'profile');
		if ($item) {
			$icon = elgg_view('output/img', array(
				'src' => $user->getIconURL('topbar'),
				'alt' => $user->name,
				'title' => $user->name,
				'class' => 'elgg-border-plain elgg-transition',
			));
			$text = '<span class="profile-text">'.elgg_get_excerpt($user->name, 20).'</span>';
			$item->setText($icon . $text);
		}*/

		elgg_register_menu_item('topbar', array(
			'href' => false,
			'name' => 'search',			
			'text' => elgg_view_icon('search').elgg_view('search/header'),
			'priority' => 0,
			'section' => 'alt',
		));

		elgg_register_menu_item('topbar', array(
			'name' => 'home',
			'text' => elgg_view_icon('home'),
			'href' => "/",
			'priority' => 2,
			'section' => 'alt',
		));

		/*$item = elgg_get_menu_item('topbar', 'friends');
		if ($item) {
			$item->setSection('alt');
		}

		$item = elgg_get_menu_item('topbar', 'messages');
		if ($item) {
			$item->setHref("messages/inbox/{$user->name}");
			$item->setSection('alt');
		}*/

		elgg_register_menu_item('topbar', array(
			'name' => 'account',
			'text' => elgg_view_icon('settings-alt'),
			'href' => "#",
			'priority' => 300,
			'section' => 'alt',
			'link_class' => 'elgg-topbar-dropdown',
		));
		
		$item = elgg_get_menu_item('topbar', 'usersettings');
		if ($item) {
			$item->setParentName('account');
			$item->setText(elgg_echo('settings'));
			$item->setPriority(103);
		}

		$item = elgg_get_menu_item('topbar', 'logout');
		if ($item) {
			$item->setParentName('account');
			$item->setText(elgg_echo('logout'));
			$item->setPriority(104);
		}

		$item = elgg_get_menu_item('topbar', 'administration');
		if ($item) {
			$item->setParentName('account');
			$item->setText(elgg_echo('admin'));
			$item->setPriority(101);
		}
	}
}