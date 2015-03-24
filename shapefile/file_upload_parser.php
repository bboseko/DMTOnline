<?php

$fileName = $_FILES["shpFile"]["name"]; //The file name
$fileTmpLoc = $_FILES["shpFile"]["tmp_name"]; //File in the php tmp folder
$fileType = $_FILES["shpFile"]["type"];
$fileSize = $_FILES["shpFile"]["size"];
$fileErrorMsg = $_FILES["shpFile"]["error"];
if (!$fileTmpLoc) {
    echo "ERROR: Please browse for a file before clicking the upload button.";
    exit();
}
if (move_uploaded_file($fileTmpLoc, "../tmp/$fileName")) {
    $fileNameDbf = $_FILES["dbfFile"]["name"]; //The file name
    $fileTmpLoc = $_FILES["dbfFile"]["tmp_name"]; //File in the php tmp folder
    if (move_uploaded_file($fileTmpLoc, "../tmp/$fileNameDbf")) {
        require_once('shapefile.php');
        try {
            $ShapeFile = new ShapeFile('../tmp/' . $fileName);
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
    } else {
        echo "move_uploaded_file_function_failed";
    }
} else {
    echo "move_uploaded_file_function_failed";
}
