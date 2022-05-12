<?php
class PluginFlagsLipis_6_1_1{
  private $flags_file = null;
  private $flags_dir = null;
  function __construct() {
    wfPlugin::includeonce('wf/yml');
    $this->flags_file = __DIR__.'/data/flags.yml';
    $this->flags_dir = '/development/flags/4x3';
    wfPlugin::enable('flags/lipis_6_1_1');
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
    $flag = wfDocument::createWidget('flags/lipis_6_1_1', 'flag', array('flag' => $name));
    /**
     * 
     */
    return $flag;
  }
  public function page_create_file(){
    $this->webmaster_check();
    $scan = wfFilesystem::getScandir(__DIR__.$this->flags_dir);
    $scan_count = sizeof($scan);
    $flags = new PluginWfYml($this->flags_file);
    foreach($scan as $v){
      $c = wfFilesystem::getContents('/plugin/flags/lipis_6_1_1'.$this->flags_dir.'/'.$v);
      $k = str_replace('.svg', '', $v);
      /**
       * Malformed data...
       * Working in development environment but not in production server.
       */
      if($k=='do'){
        $c = '<span>('.$k.')</span>';
      }
      /**
       * 
       */
      $flags->set("flags/$k", $c);
    }
    $flags->save();
    wfHelp::print("$scan_count flags was saved to file $this->flags_file!", true);
  }
  /**
   * Webmaster widget test page.
   */
  public function page_flag(){
    $this->webmaster_check();
    /**
     * 
     */
    wfPlugin::enable('flags/lipis_6_1_1');
    $element = new PluginWfYml(__DIR__.'/element/'.__FUNCTION__.'.yml');
    wfDocument::renderElement($element);
  }
  private function webmaster_check(){
    if(!wfUser::hasRole('webmaster')){
      exit('Only for webmaster!');
    }
    return null;
  }
  public function widget_flag($data){
    $data = new PluginWfArray($data);
    $flag = $data->get('data/flag');
    if(!$flag){
      throw new Exception(__CLASS__.' says: Param flag is missing in widget flag.');
    }
    $flags = new PluginWfYml($this->flags_file);
    $content = $flags->get("flags/$flag");
    if(!$content){
      $content = "(flag $flag missing)";
    }
    $content = str_replace("<svg", '<svg width="16"', $content);
    $element = new PluginWfYml(__DIR__.'/element/'.__FUNCTION__.'.yml');
    $element->setByTag(array('content' => $content));
    wfDocument::renderElement($element);
  }
}
