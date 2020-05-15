<?php

namespace Sioweb\Oxid\Api\Model;

use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\Registry;
use \OxidEsales\Eshop\Core\Field;
use OxidEsales\Eshop\Core\TableViewNameGenerator;
use OxidEsales\Eshop\Application\Model\Vendor AS OxidVendor;

class Vendor extends Vendor_parent
{
    public function fetch($sOXID = null)
    {
        if($sOXID === null) {
            $sOXID = $this->getId();
        }
        $ViewNameGenerator = Registry::get(TableViewNameGenerator::class);
        $VendorView = $ViewNameGenerator->getViewName('oxvendor');
        $Database = DatabaseProvider::getDb(DatabaseProvider::FETCH_MODE_ASSOC);
        $rs = $Database->getRow("SELECT * FROM $VendorView WHERE OXID = ?", (array)$sOXID);

        
        $Vendor = oxNew(OxidVendor::class);
        $Vendor->assign($rs);

        $Raw = [];
        
        $fieldsList = $Vendor->_getAllFields(true);
        foreach($fieldsList as $fieldName => $fieldData) {
            $longFieldName = $Vendor->_getFieldLongName($fieldName);
            if(!empty($Vendor->{$longFieldName}->value))
                $Raw[$fieldName] = $Vendor->{$longFieldName}->value;
        }

        return $Raw;
    }
}