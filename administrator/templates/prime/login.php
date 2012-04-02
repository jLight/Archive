<?php
/**
 * @version		$Id: login.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Administrator
 * @subpackage	templates.JADMIN_PLUS
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

$app = JFactory::getApplication();
JHtml::_('behavior.noframes');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
<head>
<jdoc:include type="head" />

<link href="templates/<?php echo  $this->template ?>/css/template.css" rel="stylesheet" type="text/css" />
<?php if ($this->params->get('CustomStyle')) : ?><link href="templates/<?php echo  $this->template ?>/custom/custom.css" rel="stylesheet" type="text/css" /><?php endif; ?>

<?php  if ($this->direction == 'rtl') : ?>
	<link href="templates/<?php echo $this->template ?>/css/template_rtl.css" rel="stylesheet" type="text/css" />
<?php  endif; ?>

<!--[if IE 7]>
<link href="templates/<?php echo  $this->template ?>/css/ie7.css" rel="stylesheet" type="text/css" />
<![endif]-->

<!--[if gte IE 8]>
<link href="templates/<?php echo  $this->template ?>/css/ie8.css" rel="stylesheet" type="text/css" />
<![endif]-->

<script type="text/javascript">
	function setFocus() {
		document.getElementById('form-login').username.select();
		document.getElementById('form-login').username.focus();
	}
</script>
</head>
<body onload="javascript:setFocus()"  class="width jlight background<?php if ($this->params->get('enableGradients')) : ?> gradients<?php endif; ?><?php if ($this->params->get('roundedCorners')) : ?> rounded<?php endif; ?><?php if ($this->params->get('dropShadow')) : ?> shadows<?php endif; ?><?php if ($this->params->get('textBig')) : ?> textbig<?php endif; ?>">
	<div class="login">
  <div id="border-top">
				<span class="title"><a href="index.php"><?php echo $this->params->get('showSiteName') ? $app->getCfg('sitename') : JText::_('TPL_PRIME_HEADER'); ?></a></span>
	</div>
	<div id="content-box">    
  <noscript>
    	<dl id="system-message">
      <dd class="notice message fade"><ul>
    	<li><?php echo  JText::_('JGLOBAL_WARNJAVASCRIPT') ?></li>
    	</ul></dd></dl>	
	</noscript>
			<div class="clr"></div>
			<jdoc:include type="message" />
			<div id="element-box">
					<jdoc:include type="component" />
					<div id="lock"><div id="login-intro"><?php echo JText::_('COM_LOGIN_VALID') ?></div></div>
					<div class="clr"></div>
			</div>
	</div>
    <div class="clr"></div>
		<div id="footer" >
		<?php if($this->countModules('footer')) : ?>
        <jdoc:include type="modules" name="footer" /> 
		<?php endif; ?>
			<a class="returnhome" href="<?php echo JURI::root(); ?>">« <?php echo JText::_('COM_LOGIN_RETURN_TO_SITE_HOME_PAGE') ?></a>
      <a class="joomladmin" href="http://joomladmin.pl" target="_blank"> <?php echo JText::_('TPL_PRIME_LOGIN_FOOT') ?></a>
	</div> 	</div>
</body>
</html>
