<?php
class PluginFlagsLipis_6_1_1{
  public function widget_include($data){
    $element = new PluginWfYml(__DIR__.'/element/'.__FUNCTION__.'.yml');
    wfDocument::renderElement($element);
  }
}