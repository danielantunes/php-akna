<?php
/**
 * Akna
 *
 * @category Akna
 * @package  Akna
 * @author   Pedro Padron <ppadron@w3p.com.br>
 * @author 
 * @license  BSD <http://www.opensource.org/licenses/bsd-license.php>
 * @link     https://github.com/w3p/php-akna
 * @see      http://www.akna.com.br/
 * @version  0.2
 */

require_once 'Akna/Container.php';

/**
 * Proxy class that provides access to all other modules.
 *
 * @category Akna
 * @package  Akna
 * @author   Pedro Padron <ppadron@w3p.com.br>
 * @license  BSD <http://www.opensource.org/licenses/bsd-license.php>
 * @link     https://github.com/w3p/php-akna
 * @version  0.1
 * 
 * @property Akna_EmailMarketing $emailMarketing
 */
class Akna extends Akna_Container
{
    /**
     * @var array List of elements accessible by this class.
     */
    protected $resources = array( 'emailMarketing' );
}