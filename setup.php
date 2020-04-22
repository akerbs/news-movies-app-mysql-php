<?php

use Doctrine\ORM\Tools\SchemaTool;

require_once 'inc/bootstrap.inc.php';

$schemaTool = new SchemaTool($em);

$factory = $em->getMetadataFactory();
$metadata = $factory->getAllMetadata();

try {
    $schemaTool->updateSchema($metadata);
} catch (PDOException $e) {
    echo 'ATTENTION: There was a problem updating the schema: ';
    echo $e->getMessage() . "<br />";
    if (preg_match("/Unknown database '(.*)'/", $e->getMessage(), $matches)) {
        die(
            sprintf(
                'Create the database% s with the collation utf8_general_ci!',
                $matches[1]
            )
        );
    }
}

?>
Das Schema-Tool wurde durchlaufen.
