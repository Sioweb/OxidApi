<?php

namespace Sioweb\Oxid\Api\Core;

use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\DbMetaDataHandler;

class Events
{
    public function onActivate()
    {
        $Database = DatabaseProvider::getDb();
        $dbMetaDataHandler = oxNew(DbMetaDataHandler::class);

        $tableFields = [
            ['oxuser', 'APITOKEN', "blob NULL"],
        ];

        $Export = [];
        foreach ($tableFields as $fieldData) {
            if (!$dbMetaDataHandler->fieldExists($fieldData[1], $fieldData[0])) {
                $Export[] = "ALTER TABLE `{$fieldData[0]}` ADD `{$fieldData[1]}` {$fieldData[2]};";
            }
        }

        if(!empty($Export)) {
            $Database->execute(implode("\n", $Export));
        }
    }

    public function onDeactivate()
    {

    }
}