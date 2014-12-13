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
    return implode('<br/>',$lines);
  }
}
?>
