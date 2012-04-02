<?php
/**
 * @version		$Id: cpanel.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Administrator
 * @subpackage	templates.JADMIN_PLUS
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

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
<body class="width jlight background<?php if ($this->params->get('enableGradients')) : ?> gradients<?php endif; ?><?php if ($this->params->get('roundedCorners')) : ?> rounded<?php endif; ?><?php if ($this->params->get('dropShadow')) : ?> shadows<?php endif; ?><?php if ($this->params->get('textBig')) : ?> textbig<?php endif; ?>">
		<div id="module-status">
			<jdoc:include type="modules" name="status"/>
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
	<div id="border-top">
				<span class="logo">	<jdoc:include type="modules" name="logo" /></span>
				<span class="title"><a href="index.php"><?php echo $this->params->get('showSiteName') ? $app->getCfg('sitename') : JText::_('TPL_PRIME_HEADER'); ?></a></span>
	</div>
	<div id="header-box">
		<div id="module-menu">
			<jdoc:include type="modules" name="menu"/>
		</div>
		<div class="clr"></div>
	</div>
	<div id="content-box">
				<jdoc:include type="message" /> 
  <noscript>
    	<dl id="system-message">
      <dd class="notice message fade"><ul>
    	<li><?php echo  JText::_('JGLOBAL_WARNJAVASCRIPT') ?></li>
    	</ul></dd></dl>	
	</noscript>
				<div class="clr"></div>
             
				<div id="element-box-cpanel">
					<div class="adminform">
						<div class="cpanel-left">
							<jdoc:include type="modules" name="icon" />
						</div>
						<div class="cpanel-right">
							<jdoc:include type="component" />
						</div>
					</div>
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
