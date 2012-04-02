<?php
/**
 * @package		Joomla.Installation
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
// Skips FTP Config if server is a good boy
if (is_writable(dirname(__FILE__).'/index.html')) 
{
    $return = 'database';
}
else
{
    $return = 'filesystem';
}
?>
<div id="step">
	<div class="far-right">
<?php if ($this->document->direction == 'ltr') : ?>
		<div class="button1-right"><div class="prev"><a href="index.php?view=<?php echo $return ?>" onclick="return Install.goToPage('<?php echo $return ?>');" rel="prev" title="<?php echo JText::_('JPrevious'); ?>"><?php echo JText::_('JPrevious'); ?></a></div></div>
		<div class="button1-left"><div class="next"><a href="#" onclick="Install.submitform();" rel="next" title="<?php echo JText::_('JNext'); ?>"><?php echo JText::_('JNext'); ?></a></div></div>
<?php elseif ($this->document->direction == 'rtl') : ?>
		<div class="button1-right"><div class="prev"><a href="#" onclick="Install.submitform();" rel="next" title="<?php echo JText::_('JNext'); ?>"><?php echo JText::_('JNext'); ?></a></div></div>
		<div class="button1-left"><div class="next"><a href="index.php?view=<?php echo $return ?>" onclick="return Install.goToPage('<?php echo $return ?>');" rel="prev" title="<?php echo JText::_('JPrevious'); ?>"><?php echo JText::_('JPrevious'); ?></a></div></div>
<?php endif; ?>
	</div>

</div>

	
		<form action="index.php" method="post" id="adminForm" class="form-validate">
		
						<table>
							<tr>
								<td class="item">
									<?php echo $this->form->getLabel('site_name'); ?>
								</td>
								<td>
									<?php echo $this->form->getInput('site_name'); ?>
								</td>
							</tr>
              
              <tr>
                                <td class="item">
                                    <?php echo $this->form->getLabel('admin_email'); ?>
                                </td>
                                <td>
                                    <?php echo $this->form->getInput('admin_email'); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="item">
                                    <?php echo $this->form->getLabel('admin_user'); ?>
                                </td>
                                <td>
                                    <?php echo $this->form->getInput('admin_user'); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="item">
                                    <?php echo $this->form->getLabel('admin_password'); ?>
                                </td>
                                <td>
                                    <?php echo $this->form->getInput('admin_password'); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="item">
                                    <?php echo $this->form->getLabel('admin_password2'); ?>
                                </td>
                                <td>
                                    <?php echo $this->form->getInput('admin_password2'); ?>
                                </td>
                            </tr>
              
						</table>

                
                <input type="hidden" name="task" value="setup.saveconfig" />
                <?php echo JHtml::_('form.token'); ?>
           
        </form>

		<div class="clr"></div>

