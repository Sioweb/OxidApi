<?php

namespace Sioweb\Oxid\Api\Legacy\Model;

use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\Registry;
use \OxidEsales\Eshop\Core\Field;
use OxidEsales\Eshop\Core\TableViewNameGenerator;
use OxidEsales\Eshop\Application\Model\Manufacturer AS OxidManufacturer;

class Manufacturer extends Manufacturer_parent
{
    public function fetch($sOXID = null)
    {
        if($sOXID === null) {
            $sOXID = $this->getId();
        }
        $ViewNameGenerator = Registry::get(TableViewNameGenerator::class);
        $ManufacturerView = $ViewNameGenerator->getViewName('oxmanufacturers');
        $Database = DatabaseProvider::getDb(DatabaseProvider::FETCH_MODE_ASSOC);
        $rs = $Database->getRow("SELECT * FROM $ManufacturerView WHERE OXID = ?", (array)$sOXID);

        
        $Manufacturer = oxNew(OxidManufacturer::class);
        $Manufacturer->assign($rs);

        $Raw = [];
        
        $fieldsList = $Manufacturer->_getAllFields(true);
        foreach($fieldsList as $fieldName => $fieldData) {
            $longFieldName = $Manufacturer->_getFieldLongName($fieldName);
            if(!empty($Manufacturer->{$longFieldName}->value))
                $Raw[$fieldName] = $Manufacturer->{$longFieldName}->value;
        }

        return $Raw;
    }
}