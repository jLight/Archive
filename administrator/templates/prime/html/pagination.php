<?php
/**
 * @version		$Id: pagination.php 21097 2011-04-07 15:38:03Z dextercowley $
 * @package		Joomla.Administrator
 * @subpackage	Templates.bluestork
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

/**
 * This is a file to add template specific chrome to pagination rendering.
 *
 * pagination_list_footer
 *	Input variable $list is an array with offsets:
 *		$list[prefix]		: string
 *		$list[limit]		: int
 *		$list[limitstart]	: int
 *		$list[total]		: int
 *		$list[limitfield]	: string
 *		$list[pagescounter]	: string
 *		$list[pageslinks]	: string
 *
 * pagination_list_render
 *	Input variable $list is an array with offsets:
 *		$list[all]
 *			[data]		: string
 *			[active]	: boolean
 *		$list[start]
 *			[data]		: string
 *			[active]	: boolean
 *		$list[previous]
 *			[data]		: string
 *			[active]	: boolean
 *		$list[next]
 *			[data]		: string
 *			[active]	: boolean
 *		$list[end]
 *			[data]		: string
 *			[active]	: boolean
 *		$list[pages]
 *			[{PAGE}][data]		: string
 *			[{PAGE}][active]	: boolean
 *
 * pagination_item_active
 *	Input variable $item is an object with fields:
 *		$item->base	: integer
 *		$item->prefix	: string
 *		$item->link	: string
 *		$item->text	: string
 *
 * pagination_item_inactive
 *	Input variable $item is an object with fields:
 *		$item->base	: integer
 *		$item->prefix	: string
 *		$item->link	: string
 *		$item->text	: string
 *
 * This gives template designers ultimate control over how pagination is rendered.
 *
 * NOTE: If you override pagination_item_active OR pagination_item_inactive you MUST override them both
 */

function pagination_list_footer($list)
{
	// Initialise variables.
	$lang = JFactory::getLanguage();
	$html = "<div class=\"container\"><div class=\"pagination list-footer\">\n";

  $html .= "<div class=\"totalitems\">".Jtext::_('TPL_PRIME_TOTAL_ITEMS')." ".$list['total']."</div>";

  $html .= "<div class=\"paginationbtns\">";
	$html .= "\n<span class=\"limit\">".JText::_('JGLOBAL_DISPLAY_NUM').$list['limitfield']."</span>";

  
  $html .= $list['pageslinks'];
	$html .= "\n<div class=\"limitnumber\">".$list['pagescounter']."</div>";

	$html .= "\n<input type=\"hidden\" name=\"" . $list['prefix'] . "limitstart\" value=\"".$list['limitstart']."\" />";
	$html .= "\n</div></div>";

	return $html;
}

function pagination_list_render($list)
{
	// Initialise variables.
	$lang = JFactory::getLanguage();
	$html = null;
	                                  

	if ($list['start']['active']) {
		$html .= "<span class=\"page-first\">".$list['start']['data']."</span>";
	} else {
		$html .= "<span class=\"page-first-off\">".$list['start']['data']."</span>";
	}
	if ($list['previous']['active']) {
		$html .= "<span class=\"page-previous\">".$list['previous']['data']."</span>";
	} else {
		$html .= "<span class=\"page-previous-off\">".$list['previous']['data']."</span>";
	}


	$html .= "\n<ul class=\"pages\">";
	
	foreach($list['pages'] as $page) {
		$html .= "<li>";
		$html .= $page['data'];
		$html .= "</li>";
	}
	

	
	
	$html .= "\n</ul>";       
  
  if ($list['next']['active']) {
		$html .= "<span class=\"page-next\">".$list['next']['data']."</span>";
	} else {
		$html .= "<span class=\"page-next-off\">".$list['next']['data']."</span>";
	}
	if ($list['end']['active']) {
		$html .= "<span class=\"page-last\">".$list['end']['data']."</span>";
	} else {
		$html .= "<span class=\"page-last-off\">".$list['end']['data']."</span>";
	}
        
              	$html .= "</div>";
	return $html;
}

function pagination_item_active(&$item)
{
	if ($item->base>0)
		return "<a href=\"#\" title=\"".$item->text."\" onclick=\"document.adminForm." . $item->prefix . "limitstart.value=".$item->base."; Joomla.submitform();return false;\">".$item->text."</a>";
	else
		return "<a href=\"#\" title=\"".$item->text."\" onclick=\"document.adminForm." . $item->prefix . "limitstart.value=0; Joomla.submitform();return false;\">".$item->text."</a>";
}

function pagination_item_inactive(&$item)
{
	return "<span>".$item->text."</span>";
}
?>
