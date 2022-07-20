<?php

// Protection against direct access
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Installer\InstallerAdapter;

jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');

/**
 * @package     JoomShopping
 * @subpackage  Plugins - ConcordPay
 * @package     JoomShopping
 * @subpackage  Payment
 * @author      ConcordPay
 * @link        https://concordpay.concord.ua
 * @copyright   2021 ConcordPay
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @since       3.0
 */
class plgJoomshoppingConcordpayInstallerScript
{
    /**
     * @var string
     */
    protected $installPath;

    /**
     * @var string[]
     */
    protected $files = [
        'adminparamsform.php',
        'concordpay.png',
        'index.html',
        'paymentform.php',
        'pm_concordpay.php',
        'language' => [
            'en-GB.php',
            'ru-RU.php',
            'uk-UK.php',
        ]
    ];

    /**
     * Constructor
     *
     * @param InstallerAdapter $adapter The object responsible for running this script
     * @since 3.6
     */
    public function __construct(InstallerAdapter $adapter)
    {
        $this->installPath = JPATH_ROOT . '/components/com_jshopping/payments/pm_concordpay';
    }

    /**
     * Called before any type of action
     *
     * @param string $route Which action is happening (install|uninstall|discover_install|update)
     * @param InstallerAdapter $adapter The object responsible for running this script
     *
     * @return  boolean  True on success
     * @since 3.6
     */
    public function preflight($route, InstallerAdapter $adapter)
    {
        return true;
    }

    /**
     * Called after any type of action
     *
     * @param string $route Which action is happening (install|uninstall|discover_install|update)
     * @param InstallerAdapter $adapter The object responsible for running this script
     *
     * @return  boolean  True on success
     * @since 3.6
     */
    public function postflight($route, $adapter)
    {
        return true;
    }

    /**
     * Called on installation
     *
     * @param InstallerAdapter $adapter The object responsible for running this script
     *
     * @return  boolean  True on success
     * @since 3.6
     */
    public function install(InstallerAdapter $adapter)
    {
        // JoomShopping ConcordPay plugin install path.
        self::makeDir($this->installPath);
        self::makeDir($this->installPath  . '/language');

        foreach ($this->files as $filename) {
            if (is_array($filename)) {
                foreach ($filename as $language) {
                    copy(
                        JPATH_PLUGINS . "/joomshopping/concordpay/language/$language",
                        $this->installPath . "/language/$language"
                    );
                }
            } else {
                copy(
                    JPATH_PLUGINS . "/joomshopping/concordpay/$filename",
                    $this->installPath . "/$filename"
                );
            }
        }

        // Checking for the existence of a payment method.
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->select($db->quoteName('payment_code'))
            ->from($db->quoteName('#__jshopping_payment_method'))
            ->where($db->quoteName('payment_code') . ' = '. $db->quote('Concordpay'));
        $db->setQuery($query);
        $isCodeExist = $db->loadResult();
        $query->clear();

        if ($isCodeExist !== null) {
            return true;
        }

        // Add new payment method in database.
        $extractdir = JPATH_PLUGINS . '/joomshopping/concordpay/sql';
        if (file_exists($extractdir . '/install.sql')) {
            $lines = file($extractdir . '/install.sql');
            $fullline = implode(' ', $lines);
            $queryes = $db->splitSql($fullline);
            foreach ($queryes as $query) {
                if (trim($query) !== '') {
                    $db->setQuery($query);
                    $db->query();
                    if ($db->getErrorNum()) {
                        JFactory::getApplication()->enqueueMessage($db->stderr());
                        saveToLog("install.log", "Update - " . $db->stderr());
                    }
                }
            }
        }

        return true;
    }

    /**
     * Called on update
     *
     * @param InstallerAdapter $adapter The object responsible for running this script
     *
     * @return  boolean  True on success
     * @since 3.6
     */
    public function update(InstallerAdapter $adapter)
    {
        return true;
    }

    /**
     * Called on uninstallation
     *
     * @param InstallerAdapter $adapter The object responsible for running this script
     * @since 3.6
     */
    public function uninstall(InstallerAdapter $adapter)
    {
        if (file_exists($this->installPath)
            && is_dir($this->installPath)
            && self::deleteDir($this->installPath)
        ) {
            return true;
        }

        throw new \RuntimeException(sprintf('Directory "%s" was not deleted', $this->installPath));
    }

    /**
     * @param $path
     */
    public static function makeDir($path)
    {
        if (!file_exists($path)
            && !mkdir($path, 0777, true)
            && !is_dir($path)
        ) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $path));
        }
    }

    /**
     * @param $dirPath
     */
    public static function deleteDir($dirPath)
    {
        if (! is_dir($dirPath)) {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) !== '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);

        return true;
    }
}
