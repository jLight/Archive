<?php
/**
 * @version		$Id: index.php 2011-01-14
 * @package		Joomla.Administrator
 * @subpackage	templates.jadmin_plus
 * @copyright	Copyright (C) 2011 JoomlAdmin, All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */


$option      = JRequest::getCmd('option');
$view        = JRequest::getCmd('view');
$layout      = JRequest::getCmd('layout');
$task        = JRequest::getCmd('task');

// No direct access.
defined('_JEXEC') or die;

$app = JFactory::getApplication();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo  $this->language; ?>" lang="<?php echo  $this->language; ?>" dir="<?php echo  $this->direction; ?>" >
<head>
<jdoc:include type="head" />

<link href="templates/<?php echo  $this->template ?>/css/template.css" rel="stylesheet" type="text/css" />
<?php if ($this->params->get('CustomStyle')) : ?><link href="templates/<?php echo  $this->template ?>/custom/custom.css" rel="stylesheet" type="text/css" /><?php endif; ?>

<?php 
$componentCSS = "templates/" . $this->template . "/css/components/" . $option . ".css";
if (file_exists($componentCSS)) : ?>
	<link href="<?php echo $componentCSS;?>" rel="stylesheet" type="text/css" />
<?php endif; ?>


<?php if ($this->direction == 'rtl') : ?>
	<link href="templates/<?php echo  $this->template ?>/css/template_rtl.css" rel="stylesheet" type="text/css" />
<?php endif; ?>

<!--[if IE 7]>
<link href="templates/<?php echo  $this->template ?>/css/ie7.css" rel="stylesheet" type="text/css" />
<![endif]-->

<!--[if gte IE 8]>
<link href="templates/<?php echo  $this->template ?>/css/ie8.css" rel="stylesheet" type="text/css" />
<![endif]-->



</head>
<body class="width jlight <?php echo $option?> <?php echo $view?> <?php echo $layout?> <?php echo $task?> background<?php if ($this->params->get('enableGradients')) : ?> gradients<?php endif; ?><?php if ($this->params->get('roundedCorners')) : ?> rounded<?php endif; ?><?php if ($this->params->get('dropShadow')) : ?> shadows<?php endif; ?><?php if ($this->params->get('textBig')) : ?> textbig<?php endif; ?> <?php echo $option?>_<?php echo $view?>_<?php echo $layout?>_<?php echo $task?>_page">  
         <?php echo $group?>
    	<div id="module-status">
			<jdoc:include type="modules" name="status" />
			<?php
				//Display an harcoded logout
				$task = JRequest::getCmd('task');
				if ($task == 'edit' || $task == 'editA' || JRequest::getInt('hidemainmenu')) {
					$logoutLink = '';
				} else {
					$logoutLink = JRoute::_('index.php?option=com_login&task=logout&'. JUtility::getToken() .'=1');
				}
				$hideLinks	= JRequest::getBool('hidemainmenu');
				$output = array();
				// Print the Preview link to Main site.
				$output[] = '<span class="viewsite"><a href="'.JURI::root().'" target="_blank">'.JText::_('JGLOBAL_VIEW_SITE').'</a></span>';
				// Print the logout link.
				$output[] = '<span class="logout">' .($hideLinks ? '' : '<a href="'.$logoutLink.'">').JText::_('JLOGOUT').($hideLinks ? '' : '</a>').'</span>';

				// Output the items.
				foreach ($output as $item) :
				echo $item;
				endforeach;
			?>
		</div>
  <div id="border-top"
				<span class="logo">	<jdoc:include type="modules" name="logo" /></span>
				<span class="title"><a href="index.php"><?php echo $this->params->get('showSiteName') ? $app->getCfg('sitename') : JText::_('TPL_PRIME_HEADER'); ?></a></span>
	<!-- <?php echo $option?> <?php echo $view;?> <?php echo $layout?>  -->
  </div>
	<div id="header-box">    
		<div id="module-menu">
			<jdoc:include type="modules" name="menu" />
		</div>
		<div class="clr"></div>
	</div>
	<div id="content-box">
				<div id="toolbar-box">
				<jdoc:include type="modules" name="toolbar" />
				<jdoc:include type="modules" name="title" />
				<div class="clr"></div>
			</div>
		<jdoc:include type="message" />
			<div class="clr"></div>
				<noscript>
    	<dl id="system-message">
      <dd class="notice message fade"><ul>
    	<li><?php echo  JText::_('JGLOBAL_WARNJAVASCRIPT') ?></li>
    	</ul></dd></dl>	
		</noscript>
		<div class="clr"></div>
		<?php if (!JRequest::getInt('hidemainmenu')): ?>
		<jdoc:include type="modules" name="submenu" style="rounded" id="submenu-box" />
		<?php endif; ?>
		<div id="element-box">
				<jdoc:include type="component" />
				<div class="clr"></div>
		</div>
	</div>

		<div id="footer" >
		<?php if($this->countModules('footer')) : ?>
        <jdoc:include type="modules" name="footer" /> 
		<?php endif; ?>
    <a class="joomladmin" href="http://joomladmin.pl" target="_blank">Joomla! <?php echo JVERSION; ?> - jLight <?php echo S1VERSION; ?> <?php echo JText::_('TPL_PRIME_FOOT') ?></a>
	</div>
  
</body>
</html>
