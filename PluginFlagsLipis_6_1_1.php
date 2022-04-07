<?php
class PluginFlagsLipis_6_1_1{
  public function widget_include($data){
    $element = new PluginWfYml(__DIR__.'/element/'.__FUNCTION__.'.yml');
    wfDocument::renderElement($element);
  }
  public function getFlagElement($name){
    /**
     * Rewrite $name if not corresponds to this plugin.
     */
    if(wfGlobals::get("settings/i18n/lable/$name")){
      if($name=='sv' && wfGlobals::get("settings/i18n/lable/$name")=='Swedish'){
        $name = 'se';
      }elseif($name=='en' && wfGlobals::get("settings/i18n/lable/$name")=='English'){
        $name = 'gb';
      }
    }
    /**
     * Element.
     */
    $flag = wfDocument::createHtmlElement('span', null, array('class' => "fi fi-".$name));
    /**
     * 
     */
    return $flag;
  }
}