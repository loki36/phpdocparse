<?php
include ('../phpdocparser.php');

include('testclass.php');
include('testclass2.php');

// Php Doc for class PhpDocParser
$pdp = new PhpDocParser();
$pdp->registerFormater('param',new ParamFormater());
$pdp->registerFormater('return',new ReturnFormater());
$ro = new ReflectionObject($pdp);
$pdp->setDocument($ro->getDocComment());
$pdp->debug('getFormatedTags');
echo "<br/>";

// Php Doc for properties of class PhpDocParser
foreach($ro->getProperties() as $property){
  echo "<br/>";
  echo "Property : ".$property->getName()."<br/>";
  $pdp->setDocument($property->getDocComment());
  $pdp->debug('getFormatedTags');
  echo "<br/>";
}
$pdp->debug('getFormatedTags');
echo "<br/>";

// Php Doc for methods of class PhpDocParser
foreach($ro->getMethods() as $method){
  echo "<br/>";
  echo "Method : ".$method->getName()."<br/>";
  $pdp->setDocument($method->getDocComment());
  $pdp->debug('getFormatedTags');
  echo "<br/>";
}

// Php Doc for class TestClass2
$a = new TestClass2();
$ro = new ReflectionObject($a);
$pdp = new PhpDocParser($ro->getDocComment());
$pdp->debug('getFormatedTags');

// Php Doc for properties of class TestClass2
echo "<br/>";
foreach($ro->getProperties() as $property){
  echo "<br/>";
  echo "Property : ".$property->getName()."<br/>";
  $pdp->setDocument($property->getDocComment());
  $pdp->debug('getFormatedTags');
  echo "<br/>";
}
$pdp->debug('getFormatedTags');
echo "<br/>";

// Php Doc for methods of class TestClass2
foreach($ro->getMethods() as $method){
  echo "<br/>";
  echo "Method : ".$method->getName()."<br/>";
  $pdp->setDocument($method->getDocComment());
  $pdp->debug('getFormatedTags');
  echo "<br/>";
}

// Php Doc for class TestClass
$a = new TestClass();
$ro = new ReflectionObject($a);
$pdp = new PhpDocParser($ro->getDocComment());
$pdp->debug('getFormatedTags');

// Php Doc for properties of class TestClass
echo "<br/>";
foreach($ro->getProperties() as $property){
  echo "<br/>";
  echo "Property : ".$property->getName()."<br/>";
  $pdp->setDocument($property->getDocComment());
  $pdp->debug('getFormatedTags');
  echo "<br/>";
}
$pdp->debug('getFormatedTags');
echo "<br/>";

// Php Doc for methods of class TestClass
foreach($ro->getMethods() as $method){
  echo "<br/>";
  echo "Method : ".$method->getName()."<br/>";
  $pdp->setDocument($method->getDocComment());
  $pdp->debug('getFormatedTags');
  echo "<br/>";
}
?>
