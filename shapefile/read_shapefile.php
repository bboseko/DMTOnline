<?php

require_once('shapefile.php');
$shpFile = $_POST["shpFile"];
try {
    $ShapeFile = new ShapeFile('../tmp/' . $shpFile);
    while ($record = $ShapeFile->getRecord(ShapeFile::GEOMETRY_WKT)) {
        if ($record['dbf']['deleted']) {
            continue;
        }
        // Geometry
        $result = $record['shp'];
    }

    $size = count(explode(", ", $result));
    if ($size > 20) {
        echo 'Max_of_points_reached';
    } else {
        if ($ShapeFile->getShapeType() == 5) {
            $result = substr(substr($result, 9), 0, - 2);
            echo $result;
        } else if ($ShapeFile->getShapeType() == 1) {
            $result = substr(substr($result, 6), 0, - 1);
            echo $result;
        } else if ($ShapeFile->getShapeType() == 3) {
            $result = substr(substr($result, 11), 0, - 1);
            echo $result;
        } else {
            echo 'Type_not_allowed';
        }
    }
} catch (ShapeFileException $e) {
    exit('Error ' . $e->getCode() . ': ' . $e->getMessage());
}