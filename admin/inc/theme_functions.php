<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/**
 * Theme Functions
 *
 * These functions are used within the front-end of a GetSimple installation
 *
 * @link https://github.com/GetSimpleCMS-CE/GetSimpleCMS-CE/wiki/Theme-Creation
 *
 * @package GetSimple
 * @subpackage Theme-Functions
 */

/**
 * Get Page Content
 *
 * @since 1.0
 * @uses $content 
 * @uses exec_action
 * @uses exec_filter
 * @uses strip_decode
 *
 * @return string Echos.
 */
function get_page_content() {
	global $content;
	exec_action('content-top');
	$content = strip_decode($content);
	$content = exec_filter('content',$content);
	if(getDef('GSCONTENTSTRIP',true)) $content = strip_content($content);
	echo $content;
	exec_action('content-bottom');
}

/**
 * Get Page Excerpt
 *
 * @since 2.0
 * @uses $content
 * @uses exec_filter
 * @uses strip_decode
 *
 * @param string $n Optional, default is 200.
 * @param bool $striphtml Optional, default false, true will strip html from $content
 * @param string $ellipsis Optional, Default '...', specify an ellipsis
 * @return string Echos.
 */
function get_page_excerpt($len=200, $striphtml=true, $ellipsis = '...') {
	GLOBAL $content;
	if ($len<1) return '';
	$content_e = strip_decode($content);
	$content_e = exec_filter('content',$content_e);
	if(getDef('GSCONTENTSTRIP',true)) $content_e = strip_content($content_e);	
	echo getExcerpt($content_e, $len, $striphtml, $ellipsis);
}


/**
 * Get Page Meta Keywords
 *
 * @since 2.0
 * @uses $metak
 * @uses strip_decode
 *
 * @param bool $echo Optional, default is true. False will 'return' value
 * @return string Echos or returns based on param $echo
 */
function get_page_meta_keywords($echo=true) {
	global $metak;
	$myVar = encode_quotes(strip_decode($metak));
	
	if ($echo) {
		echo $myVar;
	} else {
		return $myVar;
	}
}

/**
 * Get Page Meta Description
 *
 * @since 2.0
 * @uses $metad
 * @uses strip_decode
 *
 * @param bool $echo Optional, default is true. False will 'return' value
 * @return string Echos or returns based on param $echo
 */
function get_page_meta_desc($echo=true) {
	global $metad;
	$myVar = encode_quotes(strip_decode($metad));
	if ($echo) {
		echo $myVar;
	} else {
		return $myVar;
	}
}

/**
 * Get Page Title
 *
 * @since 1.0
 * @uses $title
 *
 * @param bool $echo Optional, default is true. False will 'return' value
 * @return string Echos or returns based on param $echo
 */
function get_page_title($echo=true) {
	global $title;
	$myVar = strip_decode($title);
	
	if ($echo) {
		echo $myVar;
	} else {
		return $myVar;
	}
}

/**
 * Get Page Clean Title
 *
 * This will remove all HTML from the title before returning
 *
 * @since 1.0
 * @uses $title
 *
 * @param bool $echo Optional, default is true. False will 'return' value
 * @return string Echos or returns based on param $echo
 */
function get_page_clean_title($echo=true) {
	global $title;
	$myVar = strip_tags(strip_decode($title));
	
	if ($echo) {
		echo $myVar;
	} else {
		return $myVar;
	}
}

/**
 * Get Page Slug
 *
 * This will return the slug value of a particular page
 *
 * @since 1.0
 * @uses $url
 *
 * @param bool $echo Optional, default is true. False will 'return' value
 * @return string Echos or returns based on param $echo
 */
function get_page_slug($echo=true) {
	global $url;
	$myVar = $url;
	
	if ($echo) {
		echo $myVar;
	} else {
		return $myVar;
	}
}

/**
 * Get Page Parent Slug
 *
 * This will return the slug value of a particular page's parent
 *
 * @since 1.0
 * @uses $parent
 *
 * @param bool $echo Optional, default is true. False will 'return' value
 * @return string Echos or returns based on param $echo
 */
function get_parent($echo=true) {
	global $parent;
	$myVar = $parent;
	
	if ($echo) {
		echo $myVar;
	} else {
		return $myVar;
	}
}

/**
 * Get Page Date
 *
 * This will return the page's updated date/timestamp
 *
 * @since 1.0
 * @uses $date
 * @uses $TIMEZONE
 *
 * @param string $i Optional, default is "l, F jS, Y - g:i A"
 * @param bool $echo Optional, default is true. False will 'return' value
 * @return string Echos or returns based on param $echo
 */
function get_page_date($i = "l, F jS, Y - g:i A", $echo=true) {
	global $date;
	global $TIMEZONE;
	if ($TIMEZONE != '') {
		if (function_exists('date_default_timezone_set')) {
			date_default_timezone_set($TIMEZONE);
		}
	}
	
	$myVar = date($i, strtotime($date));
	
	if ($echo) {
		echo $myVar;
	} else {
		return $myVar;
	}
}

/**
 * Get Page Full URL
 *
 * This will return the full url
 *
 * @since 1.0
 * @uses $parent
 * @uses $url
 * @uses $SITEURL
 * @uses $PRETTYURLS
 * @uses find_url
 *
 * @param bool $echo Optional, default is false. True will 'return' value
 * @return string Echos or returns based on param $echo
 */
function get_page_url($echo=false) {
	global $url;
	global $SITEURL;
	global $PRETTYURLS;
	global $parent;

	if (!$echo) {
		echo find_url($url, $parent);
	} else {
		return find_url($url, $parent);
	}
}

/**
 * Get Page Header HTML
 *
 * This will return header html for a particular page. This will include the 
 * meta desriptions & keywords, canonical and title tags
 *
 * @since 1.0
 * @uses exec_action
 * @uses get_page_url
 * @uses strip_quotes
 * @uses get_page_meta_desc
 * @uses get_page_meta_keywords
 * @uses $metad
 * @uses $title
 * @uses $content
 * @uses $site_full_name from configuration.php
 * @uses GSADMININCPATH
 *
 * @return string HTML for template header
 */
function get_header($full=true) {
	global $metad;
	global $title;
	global $content;
	include(GSADMININCPATH.'configuration.php');
	
	// meta description	
	if ($metad != '') {
		$desc = get_page_meta_desc(FALSE);
	}
	else if(getDef('GSAUTOMETAD',true))
	{
		// use content excerpt, NOT filtered
		$desc = strip_decode($content);
		if(getDef('GSCONTENTSTRIP',true)) $desc = strip_content($desc);
		$desc = cleanHtml($desc,['style', 'script']); // remove unwanted elements that strip_tags fails to remove
		$desc = getExcerpt($desc,160); // grab 160 chars
		$desc = strip_whitespace($desc); // remove newlines, tab chars
		$desc = encode_quotes($desc);
		$desc = trim($desc);
	}

	if(!empty($desc)) echo '<meta name="description" content="'.$desc.'" />'."\n";

	// meta keywords
	$keywords = get_page_meta_keywords(FALSE);
	if ($keywords != '') echo '<meta name="keywords" content="'.$keywords.'" />'."\n";
	
	if ($full) {
		echo '<link rel="canonical" href="'. get_page_url(true) .'" />'."\n";
	}

	// script queue
	get_scripts_frontend();
	
	exec_action('theme-header');
}

/**
 * Get Page Footer HTML
 *
 * This will return footer html for a particular page. Right now
 * this function only executes a plugin hook so developers can hook into
 * the bottom of a site's template.
 *
 * @since 2.0
 * @uses exec_action
 *
 * @return string HTML for template header
 */
function get_footer() {
	get_scripts_frontend(TRUE);
	exec_action('theme-footer');
}

/**
 * Get Site URL
 *
 * This will return the site's full base URL
 * This is the value set in the control panel
 *
 * @since 1.0
 * @uses $SITEURL
 *
 * @param bool $echo Optional, default is true. False will 'return' value
 * @return string Echos or returns based on param $echo
 */
function get_site_url($echo=true) {
	global $SITEURL;
	
	if ($echo) {
		echo $SITEURL;
	} else {
		return $SITEURL;
	}
}

/**
 * Get Theme URL
 *
 * This will return the current active theme's full URL 
 *
 * @since 1.0
 * @uses $SITEURL
 * @uses $TEMPLATE
 *
 * @param bool $echo Optional, default is true. False will 'return' value
 * @return string Echos or returns based on param $echo
 */
function get_theme_url($echo=true) {
	global $SITEURL;
	global $TEMPLATE;
	$myVar = trim($SITEURL . "theme/" . $TEMPLATE);
	
	if ($echo) {
		echo $myVar;
	} else {
		return $myVar;
	}
}

/**
 * Get Data Uploads URL
 *
 * This will return the "data/uploads" URL 
 *
 * @since 3.3.20
 * @uses $SITEURL
 *
 * @param bool $echo Optional, default is true. False will 'return' value
 * @return string Echos or returns based on param $echo
 */
function get_data_uploads($filename = '', $echo = true) {
	global $SITEURL;
	$base_url = trim($SITEURL . "data/uploads/");

	// Ensure no leading slash in the filename to avoid double slashes
	if ($filename) {
		$base_url .= ltrim($filename, '/');
	}

	if ($echo) {
		echo $base_url;
	} else {
		return $base_url;
	}
}

/**
 * Get Data Thumbs URL
 *
 * This will return the "data/thumbs" URL 
 *
 * @since 3.3.20
 * @uses $SITEURL
 *
 * @param bool $echo Optional, default is true. False will 'return' value
 * @return string Echos or returns based on param $echo
 */
function get_data_thumbs($filename = '', $echo = true) {
	global $SITEURL;
	$base_url = trim($SITEURL . "data/thumbs/");

	// Ensure no leading slash in the filename to avoid double slashes
	if ($filename) {
		$base_url .= ltrim($filename, '/');
	}

	if ($echo) {
		echo $base_url;
	} else {
		return $base_url;
	}
}

/**
 * Get Site's Name
 *
 * This will return the value set in the control panel
 *
 * @since 1.0
 * @uses $SITENAME
 *
 * @param bool $echo Optional, default is true. False will 'return' value
 * @return string Echos or returns based on param $echo
 */
function get_site_name($echo=true) {
	global $SITENAME;
	$myVar = cl($SITENAME);
	
	if ($echo) {
		echo $myVar;
	} else {
		return $myVar;
	}
}

/**
 * Get Administrator's Email Address
 * 
 * This will return the value set in the control panel
 * 
 * @depreciated as of 3.0
 *
 * @since 1.0
 * @uses $EMAIL
 *
 * @param bool $echo Optional, default is true. False will 'return' value
 * @return string Echos or returns based on param $echo
 */
function get_site_email($echo=true) {
	global $EMAIL;
	$myVar = trim(stripslashes($EMAIL));
	
	if ($echo) {
		echo $myVar;
	} else {
		return $myVar;
	}
}


/**
 * Get Site Credits
 *
 * This will return HTML that displays 'Powered by GetSimple X.XX'
 * It will always be nice if developers left this in their templates 
 * to help promote GetSimple. 
 *
 * @since 1.0
 * @uses $site_link_back_url from configuration.php
 * @uses $site_full_name from configuration.php
 * @uses GSVERSION
 * @uses GSADMININCPATH
 *
 * @param string $text Optional, default is 'Powered by'
 * @return string 
 */
function get_site_credits($text ='Powered by ') {
	include(GSADMININCPATH.'configuration.php');
	
	$site_credit_link = '<a href="'.$site_link_back_url.'" target="_blank" >'.$text.' '.$site_full_name.'</a>';
	echo stripslashes($site_credit_link);
}

/**
 * Menu Data
 *
 * This will return data to be used in custom navigation functions
 *
 * @since 2.0
 * @uses GSDATAPAGESPATH
 * @uses find_url
 * @uses getXML
 * @uses subval_sort
 *
 * @param bool $xml Optional, default is false. 
 *				True will return value in XML format. False will return an array
 * @return array|string Type 'string' in this case will be XML 
 */
function menu_data($id = null,$xml=false) {
	$menu_extract = [];

	global $pagesArray; 
	$pagesSorted = subval_sort($pagesArray,'menuOrder');
	if (count($pagesSorted) != 0) { 
	  $count = 0;
	  if (!$xml){
		foreach ($pagesSorted as $page) {
		  $text = (string)$page['menu'];
		  $pri = (string)$page['menuOrder'];
		  $parent = (string)$page['parent'];
		  $title = (string)$page['title'];
		  $slug = (string)$page['url'];
		  $menuStatus = (string)$page['menuStatus'];
		  $private = (string)$page['private'];
					$pubDate = (string)$page['pubDate'];
		  
		  $url = find_url($slug,$parent);
		  
		  $specific = ["slug"=>$slug, "url"=>$url, "parent_slug"=>$parent, "title"=>$title, "menu_priority"=>$pri, "menu_text"=>$text, "menu_status"=>$menuStatus, "private"=>$private, "pub_date"=>$pubDate];
		  
		  if ($id == $slug) { 
			  return $specific; 
			  exit; 
		  } else {
			  $menu_extract[] = $specific;
		  }
		}
		return $menu_extract;
	  } else {
		$xml = '<?xml version="1.0" encoding="UTF-8"?><channel>';	
			foreach ($pagesSorted as $page) {
			$text = $page['menu'];
			$pri = $page['menuOrder'];
			$parent = $page['parent'];
			$title = $page['title'];
			$slug = $page['url'];
			$pubDate = $page['pubDate'];
			$menuStatus = $page['menuStatus'];
			$private = $page['private'];
		   	
			$url = find_url($slug,$parent);
			
			$xml.="<item>";
			$xml.="<slug><![CDATA[".$slug."]]></slug>";
			$xml.="<pubDate><![CDATA[".$pubDate."]]></pubDate>";
			$xml.="<url><![CDATA[".$url."]]></url>";
			$xml.="<parent><![CDATA[".$parent."]]></parent>";
			$xml.="<title><![CDATA[".$title."]]></title>";
			$xml.="<menuOrder><![CDATA[".$pri."]]></menuOrder>";
			$xml.="<menu><![CDATA[".$text."]]></menu>";
			$xml.="<menuStatus><![CDATA[".$menuStatus."]]></menuStatus>";
			$xml.="<private><![CDATA[".$private."]]></private>";
			$xml.="</item>";
			}
			$xml.="</channel>";
			return $xml;
		}
	}
}

/**
 * Get Component
 *
 * This will return the component requested. 
 * Components are parsed for PHP within them.
 *
 * @since 1.0
 * @uses GSDATAOTHERPATH
 * @uses getXML
 * @modified mvlcek 6/12/2011
 *
 * @param string $id This is the ID of the component you want to display
 *				True will return value in XML format. False will return an array
 * @return string 
 */
function get_component($id, $ret=false) {
	global $components;

	// normalize id
	$id = to7bit($id, 'UTF-8');
	$id = clean_url($id);

	if (!$components) {
		 if (file_exists(GSDATAOTHERPATH.'components.xml')) {
			$data = getXML(GSDATAOTHERPATH.'components.xml');
			$components = $data->item;
		} else {
			$components = [];
		}
	}
	if (count($components) > 0) {
		foreach ($components as $component) {
			if ($id == $component->slug) {
				if ($ret) return strip_decode($component->value);
				else eval("?>" . strip_decode($component->value) . "<?php "); 
			}
		}
	}
}

// Returns component as array of lines of the component
// 1st element is the array of lines
// 2nd element is the first line in the component (as title, if you wish)
// 3rd element is the rest of lines seperated by <br/>
function splitComponent($component) {
	$comp  = $component;
	$parts = $content = preg_split("/\r\n|\r|\n/", $comp, 0);
	$title = $parts[0]; unset($parts[0]);
	$text  = implode("<br/>", $parts);
	
	return [$content, $title, $text];
}

// Returns component as array of lines of the component
// usefull for creating <LI> items etc.
function split_component($sec) {
	$comp  = get_component($sec, true);
	$parts = preg_split("/\r\n|\r|\n/", $comp, 0);

	return $parts;
}

/**
 * Get Main Navigation
 *
 * This will return unordered list of main navigation
 * This function uses the menu opitions listed within the 'Edit Page' control panel screen
 *
 * @since 1.0
 * @uses GSDATAOTHERPATH
 * @uses getXML
 * @uses subval_sort
 * @uses find_url
 * @uses strip_quotes 
 * @uses exec_filter 
 *
 * @param string $currentpage This is the ID of the current page the visitor is on
 * @param string $classPrefix Prefix that gets added to the parent and slug classnames
 * @return string 
 */	

// Fixed menu for multi levels based on edit Menu Manager 
function build_menu($parentId, $menuTree, $currentpage, $classPrefix, $isSubmenu = false) {
	if (!isset($menuTree[$parentId])) {
		return '';
	}

	$menu = $isSubmenu ? "\n<ul class=\" subMenu \">\n" : ""; 
	foreach ($menuTree[$parentId] as $page) {
		$url_nav = $page['url'];
		$classes = !empty($page['parent']) ? $classPrefix . $page['parent'] . " " : "";
		$classes .= $classPrefix . $url_nav;
		
		// Check if the current page has sub-pages
		$hasSubmenu = isset($menuTree[$url_nav]);
		if ($hasSubmenu) {
			$classes .= " wSub "; // Add the "with-sub-pages" class to <li>
		}

		// Add a class for <li> elements within a submenu
		if ($isSubmenu) {
			$classes .= " subItem "; // Add the "submenu-item" class to <li>
		} else {
			// Add a class for first-level <li> items
			$classes .= " topL "; // Add the "top-level" class to <li>
		}

		if ($currentpage == $url_nav) {
			$classes .= " current active "; // Add the "current active" class to <li>
		}

		$menuText = !empty($page['menu']) ? $page['menu'] : (!empty($page['title']) ? $page['title'] : $url_nav);
		$pageTitle = !empty($page['title']) ? $page['title'] : $page['menu'];
		
		// Add classes to the <a> element
		$linkClasses = [];
		if (!$isSubmenu) {
			$linkClasses[] = " topL-a "; // Add class to top-level <a>
		}
		if ($hasSubmenu) {
			$linkClasses[] = " wSub-a "; // Add class to <a> with submenus
		}
		if ($isSubmenu) {
			$linkClasses[] = " subItem-a "; // Add class to submenu <a>
		}
		if ($currentpage == $url_nav) {
			$linkClasses[] = " cur-act-a "; // Add class to active <a>
		}

		$menu .= '<li class="' . trim($classes) . '"><a href="' . find_url($page['url'], $page['parent']) . '" class="' . implode(" ", $linkClasses) . '" title="' . encode_quotes(cl($pageTitle)) . '">' . strip_decode($menuText) . '</a>';

		// Add submenu if exists
		$subMenu = build_menu($url_nav, $menuTree, $currentpage, $classPrefix, true);
		if (!empty($subMenu)) {
			$menu .= $subMenu;
		}

		$menu .= "</li>\n";
	}
	$menu .= $isSubmenu ? "</ul>\n" : ""; 
	return $menu;
}

function get_navigation($currentpage = "", $classPrefix = "") {
	global $pagesArray, $id;
	if (empty($currentpage)) {
		$currentpage = $id;
	}

	$pagesSorted = subval_sort($pagesArray, 'menuOrder');

	$menuTree = [];
	foreach ($pagesSorted as $page) {
		if ($page['menuStatus'] == 'Y') {
			$parent = !empty($page['parent']) ? $page['parent'] : 0;
			$menuTree[$parent][] = $page;
		}
	}

	if (!empty($menuTree)) {
		$menuHtml = build_menu(0, $menuTree, $currentpage, $classPrefix, false);
		echo exec_filter('menuitems', $menuHtml);
	} else {
		echo "<!-- No menu items -->";
	}
}

/**
 * Check if a user is logged in
 * 
 * This will return true if user is logged in
 *
 * @since 3.2
 * @uses get_cookie();
 * @uses $USR
 *
 * @return bool
 */	
function is_logged_in(){
	global $USR;
	if (isset($USR) && $USR == get_cookie('GS_ADMIN_USERNAME')) {
		return true;
	}
}	
	

	
/**
 * @depreciated as of 2.04
 */
function return_page_title() {
	return get_page_title(FALSE);
}
/**
 * @depreciated as of 2.04
 */
function return_parent() {
	return get_parent(FALSE);
}
/**
 * @depreciated as of 2.04
 */
function return_page_slug() {
  return get_page_slug(FALSE);
}
/**
 * @depreciated as of 2.04
 */
function return_site_ver() {
	return get_site_version(FALSE);
}	
/**
 * @depreciated as of 2.03
 */
if(!function_exists('set_contact_page')) {
	function set_contact_page() {
		#removed functionality	
	}
}
?>
