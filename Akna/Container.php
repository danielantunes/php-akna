<?php
require_once 'Akna/Client.php';

/**
 * Base Container class that allows lazy instantiation of objects.
 *
 * This class is inherited by classes that acts as proxies to other objects
 * through the __get() magic method.
 *
 * The $resources property will contain the list of elements accessible by the
 * class.
 *
 * @category Akna
 * @package  Akna
 * @author   Pedro Padron <ppadron@w3p.com.br>
 * @license  BSD <http://www.opensource.org/licenses/bsd-license.php>
 * @link     http://github.com/w3p/php-akna
 * @version  0.1
 */
class Akna_Container extends Akna_Client
{
    /**
     * @var array List of elements accessible by this class.
     */
    protected $resources = array();

    /**
     * @var array Object instances.
     */
    protected $instances = array();

    /**
     * Allows lazy-loading resources.
     *
     * @since 0.1
     * 
     * @param string $name Resource name
     *
     * @return mixed Resource instance
     */
    public function __get($name)
    {
        if (!in_array($name, $this->resources)) {
            return null;
        }

        if (isset($instances[$name])) {
            return $instances[$name];
        }

        if (strpos(get_class($this), '_') === false) {
            $className = 'Akna_' . ucfirst($name);
            include_once 'Akna/' . ucfirst($name) . '.php';
        } else {
            $className = get_class($this) . '_' .  ucfirst($name);
            include_once str_replace('_', '/', $className) . '.php';
        }

        $instances[$name] = new $className(
            $this->username, $this->password, $this->company, $this->endpoint
        );

        return $instances[$name];
    }
}