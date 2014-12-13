<?php
include ('../phpdocparser.php');

include('testclass.php');
include('testclass2.php');

/*
$a = new TestClass();
$rm = new ReflectionMethod($a,'sql_count');

$pdp = new PhpDocParser($rm->getDocComment());
//$pdp->debug();
//echo "<br /><br />";
//var_dump($pdp->getDocument());
$pdp->registerFormater('param',new ParamFormater());

//var_dump($pdp->getFormatedTag('param'));
//var_dump($pdp->getTag('param',1));
var_dump($pdp->getFormatedTags());
*/

$a = new TestClass2();
$ro = new ReflectionObject($a);
$pdp = new PhpDocParser($ro->getDocComment());

//var_dump($pdp->getFormatedTags());
$pdp->debug('getFormatedTags');
echo "<br/>";
foreach($ro->getProperties() as $property){
  echo "<br/>";
  echo $property->getName()."<br/>";
  $pdp->setDocument($property->getDocComment());
  $pdp->debug('getFormatedTags');
  echo "<br/>";
}

$pdp->debug('getFormatedTags');
echo "<br/>";
foreach($ro->getMethods() as $method){
  echo "<br/>";
  echo $method->getName()."<br/>";
  $pdp->setDocument($method->getDocComment());
  $pdp->debug('getFormatedTags');
  echo "<br/>";
}
?>
