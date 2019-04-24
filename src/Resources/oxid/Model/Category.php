<?php

namespace Sioweb\Oxid\Api\Legacy\Model;

use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\TableViewNameGenerator;
use OxidEsales\Eshop\Application\Model\Category AS OxidCategory;

class Category extends Category_parent
{
    
    public function fetch($sOXID)
    {
        if($sOXID === null) {
            $sOXID = $this->getId();
        }

        $config = $this->getConfig();
        $ViewNameGenerator = Registry::get(TableViewNameGenerator::class);
        $CategoryView = $ViewNameGenerator->getViewName('oxcategories');
        $Database = DatabaseProvider::getDb(DatabaseProvider::FETCH_MODE_ASSOC);
        $rs = $Database->getRow("SELECT " . implode(', ', $this->getFetchableFields()) . " FROM $CategoryView WHERE OXID = ?", (array)$sOXID);

        $Category = oxNew(OxidCategory::class);
        $Category->assign($rs);

        $index = 0;
        foreach($Category->getFetchableFields() as $fieldName) {
            $longFieldName = $Category->_getFieldLongName($fieldName);
            if(!empty($Category->{$longFieldName}->value) && $Category->{$longFieldName}->value !== "''") {
                yield $fieldName => $Category->{$longFieldName}->value;
            }
        }

        yield 'link' => $Category->getLink();
    }

    public function fetchAll()
    {
        $ViewNameGenerator = Registry::get(TableViewNameGenerator::class);
        $CategoryView = $ViewNameGenerator->getViewName('oxcategories');
        $Database = DatabaseProvider::getDb(DatabaseProvider::FETCH_MODE_ASSOC);
        $rs = $Database->select("SELECT OXID FROM $CategoryView LIMIT 0, 100");

        if ($rs != false && $rs->count() > 0) {
            while (!$rs->EOF) {
                yield iterator_to_array($this->fetch($rs->getFields()['OXID']), true);
                $rs->fetchRow();
            }
        }
    }

    protected function getFetchableFields()
    {
        return [
            'OXID',
            'OXPARENTID',
            'OXLEFT',
            'OXRIGHT',
            'OXROOTID',
            'OXSORT',
            'OXACTIVE',
            'OXHIDDEN',
            'OXSHOPID',
            'OXTITLE',
            'OXDESC',
            'OXLONGDESC',
            'OXTHUMB',
            'OXEXTLINK',
            'OXTEMPLATE',
            'OXDEFSORT',
            'OXDEFSORTMODE',
            'OXPRICEFROM',
            'OXPRICETO',
            'OXICON',
            'OXPROMOICON',
            'OXVAT',
            'OXSKIPDISCOUNTS',
            'OXSHOWSUFFIX',
            'OXTIMESTAMP',
        ];
    }
}