<?php
require_once 'Akna/Container.php';

/**
 * Proxy class that provides access to all emailmarketing-related resources.
 *
 * @category Akna
 * @package  Akna_EmailMarketing
 * @author   Pedro Padron <ppadron@w3p.com.br>
 * @author 	 Daniel Antunes <daniel.antunes.rocha@gmail.com>
 * @license  BSD <http://www.opensource.org/licenses/bsd-license.php>
 * @link     http://github.com/w3p/php-akna
 * @version  0.1
 *
 * @property Akna_EmailMarketing_Campaigns $campaigns Campaigns API client.
 * @property Akna_EmailMarketing_Contacts $contacts Contacts API client.
 * @property Akna_EmailMarketing_Messages $messages Messages API client.
 */
class Akna_EmailMarketing extends Akna_Container
{
    /**
     * @var array List of elements accessible by this class.
     */
    protected $resources = array( 'contacts', 'messages', 'campaigns' );
}