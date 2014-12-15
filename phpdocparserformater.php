<?php
interface PhpDocParserFormaterInterface
{
  public function format(array $lines);
}

class DefaultFormater implements PhpDocParserFormaterInterface
{
  public function format(array $lines){
    return implode('</br>',$lines);
  }
}

class ParamFormater implements PhpDocParserFormaterInterface
{
  public function format(array $lines){
    if(isset($lines[0])){
      //Type is the first word
      $type ="";
      if(preg_match("/^([^\s]+)/",$lines[0],$matches)){
        $type = $matches[1];
        $preg_type = str_replace(")","\)",str_replace("(","\(",str_replace("|","\|",$type)));
        $lines[0] = trim(preg_replace("/^".$preg_type."/","",$lines[0]));
      }
      //Name of param
      $name ="";
      if(preg_match("/^(\\$\w+)/",$lines[0],$matches)){
        $name = $matches[1];
        $lines[0] = trim(preg_replace("/^\\".$name."/","",$lines[0]));
      }
      return array("type"=>$type,"name"=>$name,"desc"=>implode('<br/>',$lines));
    }
    return $lines;
  }
}

class ReturnFormater implements PhpDocParserFormaterInterface
{
  public function format(array $lines){
    if(isset($lines[0])){
      //Type is the first word
      $type ="";
      if(preg_match("/^([^\s]+)/",$lines[0],$matches)){
        $type = $matches[1];
        $preg_type = str_replace(")","\)",str_replace("(","\(",str_replace("|","\|",$type)));
        $lines[0] = trim(preg_replace("/^".$preg_type."/","",$lines[0]));
      }
      return array("type"=>$type,"desc"=>implode('<br/>',$lines));
    }
    return $lines;
  }
}
?>
