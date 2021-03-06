<?php
namespace MelisCore\Form\View\Helper;
 
use Zend\Form\View\Helper\FormRow;
use Zend\Form\ElementInterface;
 
class MelisFieldRow extends FormRow
{
    const MELIS_TOGGLE_BUTTON_FACTORY = 'switch';
    const MELIS_SELECT_FACTORY        = 'select';
    const MELIS_MULTI_VAL_INPUT       = 'melis-multi-val-input';
    const MELIS_DRAGGABLE_INPUT       = 'melis-draggable-input';
    const MELIS_COMMERCE_DATE         = 'melis-commerce-date';
    const MELIS_COLOR_PICKER          = 'color-picker';
 
	public function render(ElementInterface $element, $labelPosition = null)
	{
	    $formElement = '';
	    if($this->getClass($element) == self::MELIS_TOGGLE_BUTTON_FACTORY)
	    {
	        // recreate checkbox to render into a toggle button
	        $markup = '<div class="make-switch" data-on="1" data-off="0"><input type="%s" class="switch" name="%s" id="%s" value="%s" onchange="%s" %s></div>';
	        $attrib = $element->getAttributes();
	        $value  = $element->getValue();
	        $isChecked = !empty($value) ? 'checked' : '';
	        $toggleButton = sprintf($markup, $attrib['type'], $attrib['name'], $attrib['id'], $value, $attrib['onchange'], $isChecked);
	        
	        // disect label and element so it would not be included in the switch feature
	        $formElement .= '<div class="form-group"><label for="'.$attrib['name'].'">'.$element->getLabel().'</label> '.$toggleButton.'</div>';
	    }
	    elseif($element->getAttribute('type') == self::MELIS_SELECT_FACTORY)
	    {
	        // render to bootstrap select element
    		$element->setAttribute('class', 'form-control');
    		$element->setLabelOption('class','col-sm-2 control-label');
    		$formElement .= '<div class="form-group">'. parent::render($element, $labelPosition).'</div>';
	    }
	    elseif($element->getAttribute('class') == self::MELIS_MULTI_VAL_INPUT)
	    {
	        // Get Value
	        $dataTags = $element->getValue();
	        // Set Input to Null value as default
	        $element->setAttribute('value', null);
	            
            $label = '<label for="tags">' . $element->getAttribute('data-label-text') . '</label>';
            $getTags = explode(',', $dataTags);
            $ulStart = '<ul class="multi-value-input clearfix">';
            $ulEnd   = '</ul>';
            $liSpan  = '<li><span>%s</span><a class="remove-tag fa fa-times"></a></li>';
            $liInput = '<li class="tag-creator">' . parent::render($element, $labelPosition) . '</li>';
            $tagItems= '';
            
            $multiValElement = $label . $ulStart.'';
            if(!empty($dataTags)) 
	            foreach($getTags as $tagValues) 
	                $tagItems .= sprintf($liSpan, $tagValues);

            $multiValElement .=  $tagItems . $liInput. $ulEnd;
            
            $formElement .= '<div class="form-group">' . $multiValElement . '</div>';
	    }
	    elseif (strpos($element->getAttribute('class'), self::MELIS_DRAGGABLE_INPUT))
	    {
	        $isDraggable = $element->getAttribute('data-draggable');
	        
	        if ($isDraggable)
	        {
	            $element->setLabel('');
	            $formElement = '<div class="input-group melis-draggable-input">
	                               '.parent::render($element, $labelPosition).'
                            	<span class="input-group-addon bg-primary"><i class="fa fa-arrows fa-lg" aria-hidden="true"></i></span>
                            </div>';
	        }
	        else 
	        {
	            $formElement .= '<div class="form-group">'. parent::render($element, $labelPosition).'</div>';
	        }
	    }
	    elseif (strpos($element->getAttribute('class'), self::MELIS_COMMERCE_DATE))
	    {
	        $element->setLabel('');
	        $attrib = $element->getAttributes();
	        $formElement = '<label for="">'.$attrib['dateLabel'].'</label>
	                        <div class="form-group input-group date '.$attrib['dateId'].'">
	                        '.parent::render($element).'
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>';
	    }
	    elseif ($element->getAttribute('class') == self::MELIS_COLOR_PICKER)
	    {
	        $attrib = $element->getAttributes();
	        $formElement = '<div class="form-group">
	                        <label for="">'.$element->getLabel().'</label>
	                        <div class="input-group colorpicker-component '.$attrib['name'].'">
                                 <input type="text" name="'.$attrib['name'].'" value="" class="form-control" />
                                <span class="input-group-addon"><i></i></span>
                            </div>
	                        </div>';
	    }
	    else 
	    {
	        
	        $formElement .= '<div class="form-group">'. parent::render($element, $labelPosition).'</div>';
	    }
	    
		return $formElement;
	}
	
	/**
	 * Returns the class attribute of the element
	 * @param ElementInterface $element
	 * @return String
	 */
	protected function getClass(ElementInterface $element)
	{
	    return $element->getAttribute('class');
	}
}