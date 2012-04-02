<?php
/**
 * @package		Joomla.Installation
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<div id="step">
	<div class="far-right">
<?php if ($this->document->direction == 'ltr') : ?>               
		
		<div class="button1-left"><div class="admin"><a href="<?php echo JURI::root(); ?>administrator/" title="<?php echo JText::_('JADMINISTRATOR'); ?>"><?php echo JText::_('JADMINISTRATOR'); ?></a></div></div>
<?php elseif ($this->document->direction == 'rtl') : ?>
		<div class="button1-left"><div class="admin"><a href="<?php echo JURI::root(); ?>administrator/" title="<?php echo JText::_('JADMINISTRATOR'); ?>"><?php echo JText::_('JADMINISTRATOR'); ?></a></div></div>
<?php endif; ?>
	</div>

</div>                                          

<form action="index.php" method="post" id="adminForm" class="form-validate">
	<div id="installer ">
     	<div class="completepage">
   
  <span id="removebtn"><input class="button" type="button" name="instDefault" value="<?php echo JText::_('INSTL_COMPLETE_REMOVE_FOLDER'); ?>" onclick="Install.removeFolder(this);"/></span>
						
					<fieldset>
						<table class="final-table">
			
							<tr class="message inlineError" id="theDefaultError" style="display: none">
								<td>
									<dl>
										<dt class="error"><?php echo JText::_('JERROR'); ?></dt>
										<dd id="theDefaultErrorMessage"></dd>
									</dl>
								</td>
							<tr>
							<tr>
								<td>
									<h3>
									<?php echo JText::_('INSTL_COMPLETE_ADMINISTRATION_LOGIN_DETAILS'); ?>
									</h3>
								</td>
							</tr>
							<tr>
								<td class="notice">
									<?php echo JText::_('JUSERNAME'); ?> : <strong><?php echo $this->options['admin_user']; ?></strong>
								</td>
							</tr>
					
							<?php if ($this->config) : ?>
							<tr>
								<td class="small">
									<?php echo JText::_('INSTL_CONFPROBLEM'); ?>
								</td>
							</tr>
							<tr>
								<td>
									<textarea rows="5" cols="49" name="configcode" onclick="this.form.configcode.focus();this.form.configcode.select();" ><?php echo $this->config; ?></textarea>
								</td>
							</tr>
							<?php endif; ?>
						</table>
					</fieldset>
		
			<div class="clr"></div>

	</div>  </div>
	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
</form>
