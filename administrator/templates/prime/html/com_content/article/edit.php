<?php
/**
 * @package		Joomla.Administrator
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');

// Load the tooltip behavior.
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');

// Create shortcut to parameters.
	$params = $this->state->get('params');

	$params = $params->toArray();

// This checks if the config options have ever been saved. If they haven't they will fall back to the original settings.
$editoroptions = isset($params['show_publishing_options']);

if (!$editoroptions):
	$params['show_publishing_options'] = '1';
	$params['show_article_options'] = '1';
	$params['show_urls_images_backend'] = '0';
	$params['show_urls_images_frontend'] = '0';
endif;

// Check if the article uses configuration settings besides global. If so, use them.
if (!empty($this->item->attribs['show_publishing_options'])):
		$params['show_publishing_options'] = $this->item->attribs['show_publishing_options'];
endif;
if (!empty($this->item->attribs['show_article_options'])):
		$params['show_article_options'] = $this->item->attribs['show_article_options'];
endif;
if (!empty($this->item->attribs['show_urls_images_backend'])):
		$params['show_urls_images_backend'] = $this->item->attribs['show_urls_images_backend'];
endif;

?>

<script type="text/javascript">
	Joomla.submitbutton = function(task) {
		if (task == 'article.cancel' || document.formvalidator.isValid(document.id('item-form'))) {
			<?php echo $this->form->getField('articletext')->save(); ?>
			Joomla.submitform(task, document.getElementById('item-form'));
		} else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>
          
<form action="<?php echo JRoute::_('index.php?option=com_content&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="item-form" class="form-validate">

    <fieldset class="adminform">
		
			<ul class="adminformlist hwidth500">
				<li><?php echo $this->form->getLabel('title'); ?>
				<?php echo $this->form->getInput('title'); ?></li>      

				<li><?php echo $this->form->getLabel('alias'); ?>
				<?php echo $this->form->getInput('alias'); ?></li>

				<li><?php echo $this->form->getLabel('catid'); ?>
				<?php echo $this->form->getInput('catid'); ?></li>

        <li><?php echo $this->form->getLabel('access'); ?>
				<?php echo $this->form->getInput('access'); ?></li>

				<li><?php echo $this->form->getLabel('state'); ?>
				<?php echo $this->form->getInput('state'); ?></li>
			
				<li><?php echo $this->form->getLabel('language'); ?>
				<?php echo $this->form->getInput('language'); ?></li>
        
        <li><?php echo $this->form->getLabel('featured'); ?>
				<?php echo $this->form->getInput('featured'); ?></li>

				<li><?php echo $this->form->getLabel('id'); ?>
				<?php echo $this->form->getInput('id'); ?></li>
			</ul>

			<div class="clr"></div>
		
		</fieldset>
               <div id="article-edit-tabs">

<?php echo JHtml::_('tabs.start', 'content-tabs-'.$this->item->id, array('useCookie'=>1)); ?>
  
  
  <?php echo JHtml::_('tabs.panel', JText::_('TPL_PRIME_ARTICLE'),'tab1');  ?>      
    <?php echo $this->form->getInput('articletext'); ?> 
		<div class="clr"></div>



    	<?php // The url and images fields only show if the configuration is set to allow them.  ?>
		<?php // This is for legacy reasons. ?>
		<?php if ($params['show_urls_images_backend']): ?>
			<?php echo JHtml::_('tabs.panel', JText::_('COM_CONTENT_FIELDSET_URLS_AND_IMAGES'), 'urls_and_images-options'); ?>
				

        
         <div class="width-40 fltrt">
        
        <fieldset class="panelform">
        <legend> 	<?php echo JText::_('TPL_PRIME_EDIT_ARTICLE_LINKS'); ?> </legend>
				<ul class="adminformlist">
					<li>
				<?php foreach($this->form->getGroup('urls') as $field): ?>
						<li>
							<?php if (!$field->hidden): ?>
								<?php echo $field->label; ?>
							<?php endif; ?>
							<?php echo $field->input; ?>
						</li>
					<?php endforeach; ?>
				</ul>
				</fieldset>        </div>
        
                <div class="width-40 fltlt">
        
        <fieldset class="panelform">
        <legend> 	<?php echo JText::_('TPL_PRIME_EDIT_ARTICLE_IMAGES'); ?> </legend>
				<ul class="adminformlist">
					<li>
					<?php echo $this->form->getLabel('images'); ?>
					<?php echo $this->form->getInput('images'); ?></li>

					<?php foreach($this->form->getGroup('images') as $field): ?>
						<li>
							<?php if (!$field->hidden): ?>
								<?php echo $field->label; ?>
							<?php endif; ?>
							<?php echo $field->input; ?>
						</li>
					<?php endforeach; ?>
				</ul>
				</fieldset>        
        
        </div> 	<div class="clr"></div>
        
        
        
		<?php endif; ?>              

  	
		<?php // Do not show the publishing options if the edit form is configured not to. ?>
		<?php  if ($params['show_publishing_options'] || ( $params['show_publishing_options'] = '' && !empty($editoroptions)) ): ?>
			<?php echo JHtml::_('tabs.panel', JText::_('TPL_PRIME_EDIT_ARTICLE_PUB_OPTIONS_AND_META'), 'publishing-details'); ?>
			<fieldset class="panelform publishing-details">
        <legend><?php echo JText::_('COM_CONTENT_FIELDSET_PUBLISHING'); ?></legend>
				<ul class="adminformlist">
					<li><?php echo $this->form->getLabel('created_by'); ?>
					<?php echo $this->form->getInput('created_by'); ?></li>

					<li><?php echo $this->form->getLabel('created_by_alias'); ?>
					<?php echo $this->form->getInput('created_by_alias'); ?></li>

					<li><?php echo $this->form->getLabel('created'); ?>
					<?php echo $this->form->getInput('created'); ?></li>

					<li><?php echo $this->form->getLabel('publish_up'); ?>
					<?php echo $this->form->getInput('publish_up'); ?></li>

					<li><?php echo $this->form->getLabel('publish_down'); ?>
					<?php echo $this->form->getInput('publish_down'); ?></li>

					<?php if ($this->item->modified_by) : ?>
						<li><?php echo $this->form->getLabel('modified_by'); ?>
						<?php echo $this->form->getInput('modified_by'); ?></li>

						<li><?php echo $this->form->getLabel('modified'); ?>
						<?php echo $this->form->getInput('modified'); ?></li>
					<?php endif; ?>

					<?php if ($this->item->version) : ?>
						<li><?php echo $this->form->getLabel('version'); ?>
						<?php echo $this->form->getInput('version'); ?></li>
					<?php endif; ?>

					<?php if ($this->item->hits) : ?>
						<li><?php echo $this->form->getLabel('hits'); ?>
						<?php echo $this->form->getInput('hits'); ?></li>
					<?php endif; ?>
				</ul>
			</fieldset>       
		<?php  endif; ?>    
    
    	
			<fieldset class="panelform metadata">
        <legend><?php echo JText::_('JGLOBAL_FIELDSET_METADATA_OPTIONS'); ?></legend>
				<?php echo $this->loadTemplate('metadata'); ?>
       	</fieldset>    	<div class="clr"></div>
    
    
		<?php  $fieldSets = $this->form->getFieldsets('attribs'); ?>
			<?php foreach ($fieldSets as $name => $fieldSet) : ?>
      
				<?php // If the parameter says to show the article options or if the parameters have never been set, we will
					  // show the article options. ?>

				<?php if ($params['show_article_options'] || (( $params['show_article_options'] == '' && !empty($editoroptions) ))): ?>
					<?php // Go through all the fieldsets except the configuration and basic-limited, which are
						  // handled separately below. ?>

					<?php if ($name != 'editorConfig' && $name != 'basic-limited') : ?>
						<?php echo JHtml::_('tabs.panel', JText::_($fieldSet->label), $name.'-options'); ?>
						<?php if (isset($fieldSet->description) && trim($fieldSet->description)) : ?>
							<p class="tip"><?php echo $this->escape(JText::_($fieldSet->description));?></p>
						<?php endif; ?>
						<fieldset class="panelform">
							<ul class="adminformlist article-options-tab">
							<?php foreach ($this->form->getFieldset($name) as $field) : ?>
								<li><?php echo $field->label; ?>
								<?php echo $field->input; ?></li>
							<?php endforeach; ?>
							</ul>
						</fieldset>
					<?php endif ?>
					<?php // If we are not showing the options we need to use the hidden fields so the values are not lost.  ?>
				<?php  elseif ($name == 'basic-limited'): ?>
						<?php foreach ($this->form->getFieldset('basic-limited') as $field) : ?>
							<?php  echo $field->input; ?>
						<?php endforeach; ?>

				<?php endif; ?>
			<?php endforeach; ?>
				<?php // We need to make a separate space for the configuration
				      // so that those fields always show to those wih permissions ?>
				<?php if ( $this->canDo->get('core.admin')   ):  ?>
					
						<fieldset  class="panelform article-options-tab" >
            	<legend> 	<?php echo JText::_('COM_CONTENT_SLIDER_EDITOR_CONFIG'); ?> </legend>
							<ul class="adminformlist">
							<?php foreach ($this->form->getFieldset('editorConfig') as $field) : ?>
								<li><?php echo $field->label; ?>
								<?php echo $field->input; ?></li>
							<?php endforeach; ?>
							</ul>
						</fieldset>
				<?php endif ?> 
        
        
    <?php if ($this->canDo->get('core.admin')): ?>    
    <?php echo JHtml::_('tabs.panel', JText::_('COM_CONTENT_FIELDSET_RULES'), 'access-rules'); ?>
			<fieldset class="panelform">
					<?php echo $this->form->getLabel('rules'); ?>
					<?php echo $this->form->getInput('rules'); ?>
				</fieldset>
    <?php endif; ?>

			<?php echo JHtml::_('tabs.end'); ?>   </div>
		
	<div>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="return" value="<?php echo JRequest::getCmd('return');?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>


