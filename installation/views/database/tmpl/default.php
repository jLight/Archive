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
		<div class="button1-right"><div class="prev"><a href="index.php?view=preinstall" onclick="return Install.goToPage('preinstall');" rel="prev" title="<?php echo JText::_('JPrevious'); ?>"><?php echo JText::_('JPrevious'); ?></a></div></div>
		<div class="button1-left"><div class="next"><a href="#" onclick="Install.submitform();" rel="next" title="<?php echo JText::_('JNext'); ?>"><?php echo JText::_('JNext'); ?></a></div></div>
<?php elseif ($this->document->direction == 'rtl') : ?>
		<div class="button1-right"><div class="prev"><a href="#" onclick="Install.submitform();" rel="next" title="<?php echo JText::_('JNext'); ?>"><?php echo JText::_('JNext'); ?></a></div></div>
		<div class="button1-left"><div class="next"><a href="index.php?view=preinstall" onclick="return Install.goToPage('preinstall');" rel="prev" title="<?php echo JText::_('JPrevious'); ?>"><?php echo JText::_('JPrevious'); ?></a></div></div>
<?php endif; ?>
	</div>

</div>
<form action="index.php" method="post" id="adminForm" class="form-validate">

						<table class="content2 db-table">

							<tr>
								<td colspan="2">
									<?php echo $this->form->getLabel('db_type'); ?>
								</td>	
                <td>	 
									<?php echo $this->form->getInput('db_type'); ?>
								</td>
						
							</tr>
							<tr>
								<td colspan="2">
									<?php echo $this->form->getLabel('db_host'); ?> 
								</td>	
                <td>	
									<?php echo $this->form->getInput('db_host'); ?>
								</td>
							
							</tr>
							<tr>
								<td colspan="2">
									<?php echo $this->form->getLabel('db_user'); ?>
								</td>	
                <td>	
									<?php echo $this->form->getInput('db_user'); ?>
								</td>
					
							</tr>
							<tr>
								<td colspan="2">
									<?php echo $this->form->getLabel('db_pass'); ?>
								</td>	
                <td>	
									<?php echo $this->form->getInput('db_pass'); ?>
								</td>
					
							</tr>
							<tr>
								<td colspan="2">
									<?php echo $this->form->getLabel('db_name'); ?>
								</td>	
                <td>	
									<?php echo $this->form->getInput('db_name'); ?>
								</td>
						
							</tr>
							<tr>
								<td colspan="2">
									<?php echo $this->form->getLabel('db_prefix'); ?>
								</td>	
                <td>	
									<?php echo $this->form->getInput('db_prefix'); ?>
               	</td>	
              </tr>
							<tr>
						    <td colspan="2">
									<?php echo $this->form->getLabel('db_old'); ?>
								</td>	
                <td>	
									<?php echo $this->form->getInput('db_old'); ?>
								</td>
							</tr>
						</table>
				
	<input type="hidden" name="task" value="setup.database" />
	<?php echo JHtml::_('form.token'); ?>
</form>
