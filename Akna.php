<?php
/**
 * Akna.php
 *
 * PHP version 5
 *
 * @category Akna
 * @package  Akna
 * @author   Pedro Padron <ppadron@w3p.com.br>
 * @license  BSD <http://www.opensource.org/licenses/bsd-license.php>
 * @link     http://github.com/w3p/akna-client-php
 * @see      http://www.akna.com.br/
 */

require_once 'Akna/Container.php';

/**
 * Proxy class that provides access to all other modules.
 *
 * @category Akna
 * @package  Akna
 * @author   Pedro Padron <ppadron@w3p.com.br>
 * @license  BSD <http://www.opensource.org/licenses/bsd-license.php>
 * @link     http://github.com/w3p/akna-client-php
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