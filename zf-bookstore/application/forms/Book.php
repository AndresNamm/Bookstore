<?php

class Application_Form_Book extends Zend_Form
{
    public function init()
    {
        // Set the method for the display form to POST
        $this->setMethod('post');

        // Add an name element
        $this->addElement('text', 'name', array(
            'label'      => 'Title:',
            'required'   => true,   
            'value'   => "lamppp",
			'validators' => array(
                array('validator' => 'StringLength', 'options' => array(5, 50))
                )     
        ));
        
        
		
		// Add an author element
        $this->addElement('text', 'author', array(
            'label'      => 'Author:',
            'value'   => "lamppp",
            'required'   => true,
            
        ));
		
		// Add an publisher element
        $this->addElement('text', 'publisher', array(
            'label'      => 'Publisher:',
            'value'   => "lamppp",
            'required'   => true,
        ));
	
		// Add an isbn element
        $this->addElement('text', 'isbn', array(
            'label'      => 'ISBN:',
            'value'   => "lamppp",
            'required'   => true,
        ));
		
			// Add an price element
        $this->addElement('text', 'price', array(
            'label'      => 'Price:',
            'value'   => "lamppp",
            'required'   => true,
        ));
	
		// Add an category id element
        $this->addElement('text', 'categoryId', array(
            'label'      => 'Category:',
            'value'   => "lamppp",
            'required'   => true,
        ));
	
		// Add an imageUrl element
        $this->addElement('text', 'imageUrl', array(
            'label'      => 'Image (URL):',
            'value'   => "lamppp",
            'required'   => true,
        ));
	
        // Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Add Book',
        ));
    }
}
