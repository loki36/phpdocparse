phpdocparser
============

This classes are to provid an easy way to extract information of a given PhpDoc

all tags are accesible in an indexed array or using getTag($tagName) or getFormatedTag($tagName)
all tags are an array of elements and each element can contains multi lines (or rows)
you can use a formater (and create your own) call when using  getFormatedTag or getFormatedTags

tips : short and long description are stored in tag short_desc and long_desc

```
Array
(
    [short_desc] => Array
        (
            [0] => Registers the status of foo's universe
        )

    [long_desc] => Array
        (
            [0] => Summaries for methods should use 3rd person declarative rather
than 2nd person imperative, beginning with a verb phrase.

Summaries should add description beyond the method's name. The
best method names are "self-documenting", meaning they tell you
basically what the method does.  If the summary merely repeats
the method name in sentence form, it is not providing more
information.

Summary Examples:
+ Sets the label              (preferred)
+ Set the label               (avoid)
+ This method sets the label  (avoid)
        )

    [param] => Array
        (
            [0] => string $arg1 the string to quote
            [1] => int    $arg2 an integer of how many problems happened.
        )

    [return] => Array
        (
            [0] => int the integer of the set mode used. FALSE if foo
        )

    [throws] => Array
        (
            [0] => exceptionclass [description]
        )

    [access] => Array
        (
            [0] => public
        )

    [static] => Array
        (
            [0] => 
        )

    [see] => Array
        (
            [0] => Net_Sample::$foo, Net_Other::someMethod()
        )

    [since] => Array
        (
            [0] => Method available since Release 1.2.0
        )

    [deprecated] => Array
        (
            [0] => Method deprecated in Release 2.0.0
        )

)
```



example :
``` 
include ('../phpdocparser.php');

include('testclass.php');
include('testclass2.php');

// Php Doc for class PhpDocParser
$pdp = new PhpDocParser();
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
``` 

output :
``` 
Array
(
    [long_desc] => Array
        (
            [0] => 
        )

)


Property : tagRegex
Array
(
    [short_desc] => Array
        (
            [0] => regular expresssion for phpdoc tag
        )

    [var] => Array
        (
            [0] => string
        )

    [access] => Array
        (
            [0] => protected
        )

)


Property : document
Array
(
    [short_desc] => Array
        (
            [0] => Phpdoc to analyse
        )

    [var] => Array
        (
            [0] => string
        )

    [access] => Array
        (
            [0] => protected
        )

)


Property : rows
Array
(
    [short_desc] => Array
        (
            [0] => Working array used to analyses the document
        )

    [var] => Array
        (
            [0] => array
        )

    [access] => Array
        (
            [0] => protected
        )

)


Property : tags
Array
(
    [short_desc] => Array
        (
            [0] => The parsed document with all tags
        )

    [var] => Array
        (
            [0] => array
        )

    [access] => Array
        (
            [0] => protected
        )

)


Property : formater
Array
(
    [short_desc] => Array
        (
            [0] => Array of formater for tag and the default formater in index 'default_formater'
        )

    [var] => Array
        (
            [0] => array
        )

    [access] => Array
        (
            [0] => protected
        )

)

Array
(
    [short_desc] => Array
        (
            [0] => Array of formater for tag and the default formater in index 'default_formater'
        )

    [var] => Array
        (
            [0] => array
        )

    [access] => Array
        (
            [0] => protected
        )

)


Method : __construct
Array
(
    [short_desc] => Array
        (
            [0] => Class constructor
        )

    [param] => Array
        (
            [0] => string $document (optional) Php document string
        )

    [access] => Array
        (
            [0] => public
        )

)


Method : setDocument
Array
(
    [short_desc] => Array
        (
            [0] => Set Php document string and process analyse
        )

    [param] => Array
        (
            [0] => string $document Php document string
        )

    [access] => Array
        (
            [0] => public
        )

)


Method : getDocument
Array
(
    [short_desc] => Array
        (
            [0] => Get Php document string
        )

    [return] => Array
        (
            [0] => string
        )

    [access] => Array
        (
            [0] => public
        )

)


Method : getTags
Array
(
    [short_desc] => Array
        (
            [0] => Get an array of tags
        )

    [return] => Array
        (
            [0] => array
        )

    [access] => Array
        (
            [0] => public
        )

)


Method : getTag
Array
(
    [short_desc] => Array
        (
            [0] => Get an array of all elements for a tag or the element of tag on the given index
        )

    [param] => Array
        (
            [0] => string $tagName (require) Name of tag
            [1] => int $index (optional) Index in tag to return
        )

    [return] => Array
        (
            [0] => array|false Return an array or false if empty
        )

    [access] => Array
        (
            [0] => public
        )

)


Method : registerFormater
Array
(
    [short_desc] => Array
        (
            [0] => Register a formater for a tag
        )

    [param] => Array
        (
            [0] => string $tagName (require) Name of tag
            [1] => PhpDocParserFormaterInterface $index (require) Object formater (should be an implementation of PhpDocParserFormaterInterface)
        )

    [access] => Array
        (
            [0] => public
        )

)


Method : registerDefaultFormater
Array
(
    [short_desc] => Array
        (
            [0] => Register a formater using as default if no formater found for a tag
        )

    [param] => Array
        (
            [0] => PhpDocParserFormaterInterface $index (require) Object formater (should be an implementation of PhpDocParserFormaterInterface)
        )

    [access] => Array
        (
            [0] => public
        )

)


Method : getFormatedTag
Array
(
    [short_desc] => Array
        (
            [0] => Get an array using formater, of all elements for a tag or the element of tag on the given index
        )

    [param] => Array
        (
            [0] => string $tagName (require) Name of tag
            [1] => int $index (optional) Index in tag to return
        )

    [return] => Array
        (
            [0] => array|false Return an array or false if empty
        )

    [access] => Array
        (
            [0] => public
        )

)


Method : getFormatedTags
Array
(
    [short_desc] => Array
        (
            [0] => Get an array of tags with apply formater
        )

    [return] => Array
        (
            [0] => array
        )

    [access] => Array
        (
            [0] => public
        )

)


Method : deleteFirstEmptyLine
Array
(
    [short_desc] => Array
        (
            [0] => Delete empty line
        )

    [access] => Array
        (
            [0] => protected
        )

)


Method : process
Array
(
    [short_desc] => Array
        (
            [0] => Process analyse
        )

    [access] => Array
        (
            [0] => protected
        )

)


Method : extractDescription
Array
(
    [short_desc] => Array
        (
            [0] => Extract short and long description
        )

    [access] => Array
        (
            [0] => protected
        )

)


Method : extractTags
Array
(
    [short_desc] => Array
        (
            [0] => Extract all tags
        )

    [access] => Array
        (
            [0] => protected
        )

)


Method : debug
Array
(
    [short_desc] => Array
        (
            [0] => print_r of result function in parameter
        )

    [param] => Array
        (
            [0] => strinf $method method to debug
        )

    [access] => Array
        (
            [0] => public
        )

)
``` 
