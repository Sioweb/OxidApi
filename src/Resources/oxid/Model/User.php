<?php

namespace Sioweb\Oxid\Api\Legacy\Model;

use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\TableViewNameGenerator;
use OxidEsales\Eshop\Application\Model\User AS OxidUser;

class User extends User_parent
{
    

    /**
     * Performs user login by username and password. Fetches user data from DB.
     * Registers in session. Returns true on success, FALSE otherwise.
     *
     * @param string $sUser     User username
     * @param string $sPassword User password
     * @param bool   $blCookie  (default false)
     *
     * @throws object
     * @throws oxCookieException
     * @throws oxUserException
     *
     * @return bool
     */
    public function tokenLogin($sToken, $blCookie = false)
    {
        if ($this->isAdmin() && !count(Registry::getUtilsServer()->getOxCookie())) {
            /** @var \OxidEsales\Eshop\Core\Exception\CookieException $oEx */
            $oEx = oxNew(\OxidEsales\Eshop\Core\Exception\CookieException::class);
            $oEx->setMessage('ERROR_MESSAGE_COOKIE_NOCOOKIE');
            throw $oEx;
        }

        $oConfig = $this->getConfig();

        if ($sToken) {
            $this->_dbTokenLogin($sToken, $oConfig->getShopId());
        }

        $this->onTokenLogin($sToken);

        //login successful?
        if ($this->oxuser__oxid->value) {
            // yes, successful login

            //resetting active user
            $this->setUser(null);

            if ($this->isAdmin()) {
                Registry::getSession()->setVariable('auth', $this->oxuser__oxid->value);
            } else {
                Registry::getSession()->setVariable('usr', $this->oxuser__oxid->value);
            }

            // cookie must be set ?
            if ($blCookie && $oConfig->getConfigParam('blShowRememberMe')) {
                Registry::getUtilsServer()->setUserCookie($this->oxuser__oxusername->value, $this->oxuser__oxpassword->value, $oConfig->getShopId(), 31536000, $this->oxuser__oxpasssalt->value);
            }

            return true;
        } else {
            /** @var \OxidEsales\Eshop\Core\Exception\UserException $oEx */
            $oEx = oxNew(\OxidEsales\Eshop\Core\Exception\UserException::class);
            $oEx->setMessage('ERROR_MESSAGE_USER_NOVALIDLOGIN');
            throw $oEx;
        }
    }

    protected function onTokenLogin($sToken)
    {
    }

    /**
     * Initiates user login against data in DB.
     *
     * @param string $sUser     User
     * @param string $sPassword Password
     * @param string $sShopID   Shop id
     *
     * @throws object
     */
    protected function _dbTokenLogin($sToken, $sShopID)
    {
        $blOldHash = false;
        $oDb = \OxidEsales\Eshop\Core\DatabaseProvider::getDb();
        
        $sUserOxId = $oDb->getOne($this->_getTokenLoginQuery($sToken, $sShopID, $this->isAdmin()));

        if ($sUserOxId) {
            if (!$this->load($sUserOxId)) {
                /** @var \OxidEsales\Eshop\Core\Exception\UserException $oEx */
                $oEx = oxNew(\OxidEsales\Eshop\Core\Exception\UserException::class);
                $oEx->setMessage('ERROR_MESSAGE_USER_NOVALIDLOGIN');
                throw $oEx;
            } elseif ($blOldHash && $this->getId()) {
                $this->setPassword($sToken);
                $this->save();
            }
        }
    }

    protected function _getTokenLoginQuery($sToken, $sShopID, $blAdmin)
    {
        $oDb = \OxidEsales\Eshop\Core\DatabaseProvider::getDb();
        $sShopSelect = $this->formQueryPartForAdminView($sShopID, $blAdmin);
        $sSelect = "select `oxid` from oxuser where oxuser.oxactive = 1 and oxuser.apitoken = '{$sToken}' {$sShopSelect} ";
        return $sSelect;
    }
}