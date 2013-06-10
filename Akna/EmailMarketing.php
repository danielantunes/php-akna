<?php
/**
 * EmailMarketing.php
 *
 * PHP version 5
 *
 * @category Akna
 * @package  Akna_EmailMarketing
 * @author   Pedro Padron <ppadron@w3p.com.br>
 * @license  BSD <http://www.opensource.org/licenses/bsd-license.php>
 * @link     http://github.com/w3p/akna-client-php
 * @see      http://www.akna.com.br/
 */

require_once 'Akna/Container.php';

/**
 * Proxy class that provides access to all emailmarketing-related resources.
 *
 * @category Akna
 * @package  Akna_EmailMarketing
 * @author   Pedro Padron <ppadron@w3p.com.br>
 * @license  BSD <http://www.opensource.org/licenses/bsd-license.php>
 * @link     http://github.com/w3p/akna-client-php
 *
 * @property Akna_EmailMarketing_Contacts $contacts Contacts API client.
 */
class Akna_EmailMarketing extends Akna_Container
{
    /**
     * @var array List of elements accessible by this class.
     */
    protected $resources = array( 'contacts', 'messages', 'campaigns' );
}