<?php
/**
 * @version		$Id: component.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Administrator
 * @subpackage	templates.bluestork
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
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

</head>
<body class="jlight contentpane<?php if ($this->params->get('roundedCorners')) : ?> rounded<?php endif; ?><?php if ($this->params->get('dropShadow')) : ?> shadows<?php endif; ?><?php if ($this->params->get('textBig')) : ?> textbig<?php endif; ?>">
	<jdoc:include type="message" />
	<jdoc:include type="component" />
</body>
</html>
