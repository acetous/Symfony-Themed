<?php

class ThemedView extends sfPHPView {

    public function configure() {
	parent::configure();
	
	$theme = sfConfig::get('app_view_theme', 'default');
	
	$baseDirectory = sfConfig::get('sf_root_dir') . "/themes";
	$themeDirectory = $baseDirectory . "/" . $theme;
	$themeDirectoryDefault = $baseDirectory . "/default";
	
	// set directory for template
	$relativeTemplateDirectory = "/" . $this->context->getConfiguration()->getApplication() .
		"/" . $this->moduleName;
	
	if (is_readable($themeDirectory . $relativeTemplateDirectory . "/" . $this->getTemplate())) {
	    $this->setDirectory($themeDirectory . $relativeTemplateDirectory);
	} else {
	    $this->setDirectory($themeDirectoryDefault . $relativeTemplateDirectory);
	}
	
	// set directory for decorator
	if (is_readable($themeDirectory . "/" . $this->context->getConfiguration()->getApplication() . "/" . $this->getDecoratorTemplate())) {
	    $this->setDecoratorDirectory($themeDirectory . "/" . $this->context->getConfiguration()->getApplication());
	} else {
	    $this->setDecoratorDirectory($themeDirectoryDefault . "/" . $this->context->getConfiguration()->getApplication());
	}
    }

}