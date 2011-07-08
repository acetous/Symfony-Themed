<?php

class ThemedSetupTask extends sfBaseTask
{
    private $themesDirectory, $cssDirectory;
    
    protected function configure()
    {
	$this->addArgument('theme', sfCommandArgument::OPTIONAL, 'The name of the theme');
	
	$this->namespace = 'themed';
	$this->name = 'setup';
	$this->briefDescription = 'Setup a theme.';
	
	$this->detailedDescription = <<<EOF
The [themed:setup|INFO] task can be used to setup a specific theme:

By default you can setup all present themes:

  [./symfony themed:setup|INFO]

If you only want to setup a specific theme, e.g. [mytheme|COMMENT], name it:

  [./symfony themed:setup mytheme|INFO]
EOF;
	
	$this->themesDirectory = sfConfig::get('sf_root_dir') . '/themes';
	$this->cssDirectory = sfConfig::get('sf_web_dir') . '/css';
    }
    
    protected function execute($arguments = array(), $options = array())
    {
	if (!is_writable($this->cssDirectory))
		throw new sfException(sprintf('CSS-Directory "%s" is not writeable.', $this->cssDirectory));
		
	if (empty($arguments['theme'])) {
	    $this->logSection('themed', 'Starting setup for all themes');
	    foreach (scandir($this->themesDirectory) as $theme) {
		if (substr($theme, 0, 1) == '.' || !is_dir($this->themesDirectory . '/' . $theme))
		    continue;
		$this->setupTheme($theme);
	    }
	} else {
	    $this->setupTheme($arguments['theme']);
	}
    }
    
    private function setupTheme($theme) {
	$this->logSection($theme, sprintf('Starting setup for theme "%s"', $theme));
	$this->preCheck($theme);
	$this->copyCss($theme);
    }
    
    private function preCheck($theme) {
	if (!is_readable($this->themesDirectory . '/' . $theme))
		throw new sfException(sprintf('Theme "%s" cannot be read.', $theme));
    }
    
    private function copyCss($theme) {
	foreach(scandir($this->themesDirectory . '/' . $theme) as $file) {
	    if (substr($file, -4) == '.css') {
		if (copy($this->themesDirectory . '/' . $theme . '/' . $file, $this->cssDirectory . '/' . $file)) {
		    $this->logSection($theme, sprintf('Copied "%s" to web-dir.', $file));
		} else {
		    $this->logSection($theme, sprintf('Could not copy "%s" to web-dir.', $file, null, 'ERROR'));
		}
	    }
	}
    }
}
