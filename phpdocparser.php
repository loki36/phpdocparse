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

class PhpDocParser
{
  /**
   * regular expresssion for phpdoc tag
   *
   * @var string
   * @access protected
   */
  protected $tagRegex = '/@[a-zA-Z0-9]*/';
  
  /**
   * Phpdoc to analyse
   *
   * @var string
   * @access protected
   */
  protected $document;
  
  /**
   * Working array used to analyses the document
   *
   * @var array
   * @access protected
   */  
  protected $rows;
  
  /**
   * The parsed document with all tags
   *
   * @var array
   * @access protected
   */  
  protected $tags;
  
  /**
   * Array of formater for tag and the default formater in index 'default_formater' 
   *
   * @var array
   * @access protected
   */  
  protected $formater;
  
  /**
   * Class constructor 
   *
   * @param string $document (optional) Php document string
   * @access public
   */  
  public function __construct($document=null){
    $this->registerDefaultFormater(new DefaultFormater());
    if($document!==null){
      $this->setDocument($document);
    }
  }
  
  /**
   * Set Php document string and process analyse
   *
   * @param string $document Php document string
   * @access public
   */
  public function setDocument($document){
    unset($this->document);
    unset($this->rows);
    unset($this->tags);
    $this->document = $document;
    $this->process();
  }

  /**
   * Get Php document string
   *
   * @return string
   * @access public
   */  
  public function getDocument(){
    return $this->document;
  }

  /**
   * Get an array of tags
   *
   * @return array
   * @access public
   */   
  public function getTags(){
    return $this->tags;
  }
  
  /**
   * Get an array of all elements for a tag or the element of tag on the given index
   *
   * @param string $tagName (require) Name of tag
   * @param int $index (optional) Index in tag to return
   * @return array|false Return an array or false if empty
   * @access public
   */  
  public function getTag($tagName,$index=false){
    if(isset($this->tags[$tagName])){
      if($index===false){
        return $this->tags[$tagName];
      }else if(isset($this->tags[$tagName][$index])){
        return $this->tags[$tagName][$index];
      }
    }
    return false;
  }

  /**
   * Register a formater for a tag
   *
   * @param string $tagName (require) Name of tag
   * @param PhpDocParserFormaterInterface $index (require) Object formater (should be an implementation of PhpDocParserFormaterInterface)
   * @access public
   */   
  public function registerFormater($tagName,PhpDocParserFormaterInterface $formaterObject){
    $this->formater[$tagName] = $formaterObject;
  }

  /**
   * Register a formater using as default if no formater found for a tag
   *
   * @param PhpDocParserFormaterInterface $index (require) Object formater (should be an implementation of PhpDocParserFormaterInterface)
   * @access public
   */   
  public function registerDefaultFormater(PhpDocParserFormaterInterface $formaterObject){
    $this->registerFormater('default_formater',$formaterObject);
  }

  /**
   * Get an array using formater, of all elements for a tag or the element of tag on the given index
   *
   * @param string $tagName (require) Name of tag
   * @param int $index (optional) Index in tag to return
   * @return array|false Return an array or false if empty
   * @access public
   */  
  public function getFormatedTag($tagName,$index=false){
    $array = $this->getTag($tagName,$index);
    if($array!==false){
      if(array_key_exists($tagName,$this->formater)){
        $formaterObject = $this->formater[$tagName];
      }else{
        $formaterObject = $this->formater['default_formater'];
      }
      if($index===false){
        foreach($array as $key=>$tag){
          $array[$key]=$formaterObject->format($tag);
        }
      }else{
        $array = $formaterObject->format($array);
      }
      return $array;
    }
    return false;
  }
  
  /**
   * Get an array of tags with apply formater
   *
   * @return array
   * @access public
   */   
  public function getFormatedTags(){
    $array = $this->getTags();
    foreach($array as $key=>$value){
      $array[$key] = $this->getFormatedTag($key);
    } 
    return $array;
  }
      
 
   /**
   * Delete empty line
   * 
   * @access protected
   */  
  protected function deleteFirstEmptyLine(){
    // delete first empty line
    while(isset($this->rows[0]) && $this->rows[0]=="" && count($this->rows)>1){
      array_shift($this->rows);
    }
  }

   /**
   * Process analyse
   * 
   * @access protected
   */   
  protected function process(){
    //we split document by line in an array
    $lines = explode(PHP_EOL, $this->document);
    foreach ($lines as $line)
    {
      // we delete /** and * in each begening line and the **/ at the end of document
      $line=trim(preg_replace("/^\/\*\*|\*\*\/$|^\*/","",trim($line)));
      
      $this->rows[] = $line ;
    }
    
    $this->deleteFirstEmptyLine();
    
    //var_dump($this->rows);
    $this->extractDescription();
    $this->extractTags();
  }

   /**
   * Extract short and long description
   * 
   * @access protected
   */  
  protected function extractDescription(){
    
    // search for short description
    foreach($this->rows as $line){
      if(preg_match("/^@|^$/",$line)){
        break;
      }
      $shortDesc[] = $line;
      array_shift($this->rows);
    }
    if(isset($shortDesc)){
      $this->tags['short_desc'] = array($shortDesc);
    }
    
    $this->deleteFirstEmptyLine();
    
    // search for long description
    foreach($this->rows as $line){
      if(preg_match("/^@/",$line)){
        break;
      }
      $longDesc[] = $line;
      array_shift($this->rows);
    }
    if(isset($longDesc)){
      $this->tags['long_desc'] = array($longDesc);
    }
    
    $this->deleteFirstEmptyLine();
  }

   /**
   * Extract all tags
   * 
   * @access protected
   */   
  protected function extractTags(){
    $tagName = "";
    foreach($this->rows as $line){
      if(preg_match($this->tagRegex, $line, $matches)){
        $tagName = str_replace('@', '', $matches[0]); 
        $line = str_replace($matches[0], '', $line);
        if(isset($this->tags[$tagName])){
          $index=count($this->tags[$tagName]);
        }else{
          $index=0;
        }
        $this->tags[$tagName][$index][] = trim($line);
      }
    }
  }
  
  /**
   * print_r of result function in parameter
   * 
   * @param strinf $method method to debug
   * @access public
   */   
  public function debug($method){
    //var_dump($this->tags);
    echo nl2br(str_replace(' ', '&nbsp;', print_r($this->$method(),true)));
  }
    
}
?>
