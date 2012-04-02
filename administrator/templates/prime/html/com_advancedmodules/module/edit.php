<?php
/**
 * @package			Advanced Module Manager
 * @version			2.4.2
 *
 * @author			Peter van Westen <peter@nonumber.nl>
 * @link			http://www.nonumber.nl
 * @copyright		Copyright © 2011 NoNumber! All Rights Reserved
 * @license			http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

/**
 * @package		Joomla.Administrator
 * @subpackage	com_advancedmodules
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.combobox');
$hasContent = empty($this->item->module) || $this->item->module == 'custom' || $this->item->module == 'mod_custom';

$script = "Joomla.submitbutton = function(task)
	{
			if (task == 'module.cancel' || document.formvalidator.isValid(document.id('module-form'))) {";
if ($hasContent) {
	$script .= $this->form->getField('content')->save();
}
$script .= "	var f = document.getElementById('module-form');
				if (self != top) {
					if ( task == 'module.cancel' || task == 'module.save' ) {
						f.target = '_top';
					} else {
						f.action += '&tmpl=component';
					}
				}
				Joomla.submitform(task, f);
			} else {
				alert('".$this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'))."');
			}
	}";

require_once JPATH_PLUGINS.'/system/nnframework/helpers/versions.php';
$version = NoNumberVersions::getXMLVersion(null, null, null, 1);
$document = JFactory::getDocument();
$document->addScriptDeclaration($script);
$document->addScript(JURI::root(true).'/plugins/system/nnframework/js/script.js'.$version);
$document->addScript(JURI::root(true).'/plugins/system/nnframework/fields/toggler.js'.$version);

if ($this->config->show_color) {
	$colors = explode(',', $this->config->main_colors);
	foreach ($colors as $i=> $c)
	{
		$colors[$i] = strtoupper('#'.preg_replace('#[^a-z0-9]#i', '', $c));
	}
	$script .= "
		mainColors = new Array( '".implode("', '", $colors)."' );";
}

$document->addScriptDeclaration($script);

$tmpl = JRequest::getCmd('tmpl');
if ($tmpl == 'component') :
	$document->addStyleDeclaration('html{ overflow-y: auto !important; }body{ overflow-y: auto !important; }');
	$script = "
		window.parent.SqueezeBox.setOptions({onClose: function () {
			Joomla.submitbutton('module.cancel');
		}});
	";
	$document->addScriptDeclaration($script);
	$app = JFactory::getApplication();
	$bar = JToolBar::getInstance('toolbar');
	$bar = str_replace('href="#"', 'href="javascript://"', $bar->render());
	?>
<div id="toolbar-box">
	<div class="m">
		<?php echo $bar; ?>
		<?php echo $app->get('JComponentTitle'); ?>
	</div>
</div>
	<div id="element-box">
		<div class="m">
<?php endif; ?>
	<form
		action="<?php echo JRoute::_('index.php?option=com_advancedmodules&layout=edit&id='.(int) $this->item->id); ?>"
		method="post" name="adminForm" id="module-form" class="form-validate">
		<div class="width-60 fltlft">
			<fieldset class="adminform">
				<legend><?php echo JText::_('JDETAILS'); ?></legend>
				<ul class="adminformlist">

					<li><?php echo $this->form->getLabel('title'); ?>
						<?php echo $this->form->getInput('title'); ?></li>

					<li><?php echo $this->form->getLabel('showtitle'); ?>
						<?php echo $this->form->getInput('showtitle'); ?></li>

					<li><?php echo $this->form->getLabel('position'); ?>
						<?php echo $this->form->getInput('position'); ?></li>

					<?php if ((string) $this->item->xml->name != 'Login Form'): ?>
					<li><?php echo $this->form->getLabel('published'); ?>
						<?php echo $this->form->getInput('published'); ?></li>
					<?php endif; ?>

					<?php if ($this->item->client_id == 0 && $this->config->show_hideempty) : ?>
					<?php echo $this->render($this->assignments, 'hideempty'); ?>
					<?php endif; ?>

					<?php if ($this->item->client_id == 1) : ?>
					<li><?php echo $this->form->getLabel('access'); ?>
						<?php echo $this->form->getInput('access'); ?></li>
					<?php endif; ?>

					<li><?php echo $this->form->getLabel('ordering'); ?>
						<?php echo $this->form->getInput('ordering'); ?></li>

					<?php if ($this->item->client_id != 0): ?>
					<?php if ((string) $this->item->xml->name != 'Login Form'): ?>
						<li><?php echo $this->form->getLabel('publish_up'); ?>
							<?php echo $this->form->getInput('publish_up'); ?></li>

						<li><?php echo $this->form->getLabel('publish_down'); ?>
							<?php echo $this->form->getInput('publish_down'); ?></li>
						<?php endif; ?>

					<li><?php echo $this->form->getLabel('language'); ?>
						<?php echo $this->form->getInput('language'); ?></li>
					<?php endif; ?>

					<li><?php echo $this->form->getLabel('note'); ?>
						<?php echo $this->form->getInput('note'); ?></li>

					<?php if ($this->config->show_color) : ?>
					<?php echo $this->render($this->assignments, 'color'); ?>
					<?php endif; ?>

					<?php if ($this->item->id) : ?>
					<li><?php echo $this->form->getLabel('id'); ?>
						<?php echo $this->form->getInput('id'); ?></li>
					<?php endif; ?>

					<li><?php echo $this->form->getLabel('module'); ?>
						<?php echo $this->form->getInput('module'); ?>
						<input type="text" size="35" value="<?php if ($this->item->xml) {
							echo ($text = (string) $this->item->xml->name) ? JText::_($text) : $this->item->module;
						} else {
							echo JText::_('COM_MODULES_ERR_XML');
						}?>" class="readonly" readonly="readonly" /></li>

					<li><?php echo $this->form->getLabel('client_id'); ?>
						<input type="text" size="35"
						       value="<?php echo $this->item->client_id == 0 ? JText::_('JSITE') : JText::_('JADMINISTRATOR'); ?>	"
						       class="readonly" readonly="readonly" />
						<?php echo $this->form->getInput('client_id'); ?></li>
				</ul>
				<div class="clr"></div>
				<?php if ($this->item->xml) : ?>
				<?php if ($text = trim($this->item->xml->description)) : ?>
					<label>
						<?php echo JText::_('COM_MODULES_MODULE_DESCRIPTION'); ?>
					</label>
					<span class="readonly mod-desc"><?php echo JText::_($text); ?></span>
					<?php endif; ?>
				<?php else : ?>
				<p class="error"><?php echo JText::_('COM_MODULES_ERR_XML'); ?></p>
				<?php endif; ?>
				<div class="clr"></div>
			</fieldset>
		</div>

		<div class="width-40 fltrt">
			<?php echo JHtml::_('tabs.start', 'module-tabs'); ?>
			<?php echo $this->loadTemplate('options'); ?>
			<?php
			if ($this->item->client_id == 0) {
				echo $this->loadTemplate('assignment');
			}
			?>
			<div class="clr"></div>
			<?php echo JHtml::_('tabs.end'); ?>
		</div>

		<?php if ($hasContent) : ?>
		<div class="width-60 fltlft">
			<fieldset class="adminform">
				<legend><?php echo JText::_('COM_MODULES_CUSTOM_OUTPUT'); ?></legend>
				<ul class="adminformlist">
					<div class="clr"></div>
					<li><?php echo $this->form->getLabel('content'); ?>
						<div class="clr"></div>
						<?php echo $this->form->getInput('content'); ?></li>
				</ul>
			</fieldset>
		</div>
		<?php endif; ?>

		<div class="clr"></div>

		<div>
			<input type="hidden" name="task" value="" />
			<?php echo JHtml::_('form.token'); ?>
		</div>
	</form>

<?php if ($tmpl == 'component') : ?>
		</div>
	</div>
<?php endif; ?>