<?php

class ThemedFilter extends sfFilter {

    public function execute($filterChain) {
	if ($this->isFirstCall()) {
	    
	    // add stylesheet
	    $response = $this->getContext()->getResponse();

	    $stylesheet = sfConfig::get('app_view_theme') .
		    '-' . $this->context->getConfiguration()->getApplication() .
		    '.css';
	    $stylesheetDefault = 'default' .
		    '-' . $this->context->getConfiguration()->getApplication() .
		    '.css';
	    
	    if (is_readable(sfConfig::get('sf_web_dir') . '/css/' . $stylesheet)) {
		$response->addStylesheet($stylesheet);
	    } else {
		$response->addStylesheet($stylesheetDefault);
	    }
	    
	    // set view classes
	    sfConfig::set('mod_post_view_class', 'Themed');
	    sfConfig::set('mod_post_partial_view_class', 'Themed');
	}

	$filterChain->execute();
    }

}