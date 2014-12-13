<?php
/**
 * Short description for file
 *
 * Long description for file (if any)...
 *
 * PHP version 5
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category   CategoryName
 * @package    PackageName
 * @author     Original Author <author@example.com>
 * @author     Another Author <another@example.com>
 * @copyright  1997-2005 The PHP Group
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    SVN: $Id$
 * @link       http://pear.php.net/package/PackageName
 * @see        NetOther, Net_Sample::Net_Sample()
 * @since      File available since Release 1.2.0
 * @deprecated File deprecated in Release 2.0.0
 */


/**
* Example_Class is a sample class for demonstrating PHPDoc
*
* Example_Class is a class that has no real actual code, but merely
* exists to help provide people with an understanding as to how the
* various PHPDoc tags are used.
*
* Example usage:
* if (Example_Class::example()) {
*    print "I am an example.";
* }
*
* @package  Example
* @author   David Sklar <david@example.com>
* @author   Adam Trachtenberg <adam@example.com>
* @version  $Revision: 1.3 $
* @access   public
* @see      http://www.example.com/pear
*/
class TestClass
{
  
  /**
   * Retourne le nombre de lignes d’une ressource de sélection obtenue
   * avec `sql_select()`
   * 
   * this is the long description
   *
   * @api
   * @see sql_select()
   * @see sql_countsel()
   *
   * @param Ressource $res
   * Ressource SQL
   * @param string $serveur
   * Nom du connecteur
   * @param bool|string $option
   * Peut avoir 2 valeurs :
   *
   * - true -> executer la requete
   * - continue -> ne pas echouer en cas de serveur sql indisponible
   * @return bool|string
   * - int Nombre de lignes,
   * - false en cas d'erreur.
  **/
  function sql_count($res, $serveur='', $option=true) {
  }
  
  /**
    * returns the sample data
    *
    * @param  string  $sample the sample data
    * @return array   all of the exciting sample options
    * @access private
    */
    function _sampleMe($sample)
    {
    }
    
    /**
     * DocBlock for function foo?
     *
     * No, this will be for the constant aklo!
     */
    //define('aklo',2);
    function foo($param = aklo)
    {
    }
}
