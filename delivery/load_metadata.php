<?php
include_once ("../script/mysqlclass.php");
$idImage = $_POST['idImage'];
$Connex = new db(0);
$Connex->connect();
$Connex->query("SELECT dmt_image.*,dmt_category.category_name,dmt_support.*,dmt_pathrow.* FROM `dbosfacdmt`.`dmt_image` INNER JOIN `dbosfacdmt`.`dmt_category` ON "
        . "(`dmt_image`.`id_category` = `dmt_category`.`id_category`) INNER JOIN `dbosfacdmt`.`dmt_support` "
        . "ON (`dmt_image`.`id_support` = `dmt_support`.`id_support`) INNER JOIN `dbosfacdmt`.`dmt_concern` "
        . "ON (`dmt_concern`.`id_image` = `dmt_image`.`id_image`) INNER JOIN `dbosfacdmt`.`dmt_pathrow` "
        . "ON (`dmt_concern`.`path_row` = `dmt_pathrow`.`path_row`) "
        . "WHERE (`dmt_image`.`id_image` = '$idImage') limit 1");
$numRow = $Connex->num_rows();
if ($numRow > 0) {
    ?>
    <table id="cartImagesShow" class="ui-widget ui-widget-content" style="width: 100%;">
        <thead>
            <tr class="ui-widget-header ">
                <th>Entity Attribute</th>   
                <th>Attribute Value</th>
            </tr>
        </thead>
        <?php
        while ($Connex->next_record()) {
            $id = $Connex->f("id_image");
            $entity_name = $Connex->f("image_name");
            $category_name = $Connex->f("category_name");
            $cc = $Connex->f("cloud_cover");
            ?>
            <tbody>
                <tr>
                    <td class="even">
                        <label>Category name</label>
                    </td>
                    <td class="even">
                        <label><?php echo $category_name; ?></label>
                    </td>
                </tr>
                <tr>
                    <td class="odd">
                        <label>ID</label>
                    </td>
                    <td class="odd">
                        <label><?php echo $id; ?></label>
                    </td>
                </tr>
                <tr>
                    <td class="even">
                        <label>Entity name</label>
                    </td>
                    <td class="even">
                        <label><?php echo $entity_name; ?></label>
                    </td>
                </tr>
                <?php
                if ($Connex->f("id_category") == 2) {
                    ?>
                    <tr>
                        <td class="odd">
                            <label>Path</label>
                        </td>
                        <td class="odd">
                            <label><?php echo $Connex->f("path"); ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td class="even">
                            <label>Row</label>
                        </td>
                        <td class="even">
                            <label><?php echo $Connex->f("row"); ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td class="odd">
                            <label>Scan Line Corrector (SLC)</label>
                        </td>
                        <td class="odd">
                            <label><?php echo $Connex->f("slc"); ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td class="even">
                            <label>Pre-Stack (3 Bands RGB)</label>
                        </td>
                        <td class="even">
                            <label><?php echo $Connex->f("stack"); ?></label>
                        </td>
                    </tr>
                    <?php
                }
                ?>                
                <tr>
                    <td class="odd">
                        <label>Center Longitude</label>
                    </td>
                    <td class="odd">
                        <label><?php echo $Connex->f("longitude"); ?></label>
                    </td>
                </tr>
                <tr>
                    <td class="even">
                        <label>Center Latitude</label>
                    </td>
                    <td class="even">
                        <label><?php echo $Connex->f("latitude"); ?></label>
                    </td>
                </tr>
                <tr>
                    <td class="odd">
                        <label>Format</label>
                    </td>
                    <td class="odd">
                        <label><?php echo $Connex->f("format"); ?></label>
                    </td>
                </tr>
                <tr>
                    <td class="even">
                        <label>Size</label>
                    </td>
                    <td class="even">
                        <label><?php echo $Connex->f("size"); ?> MB</label>
                    </td>
                </tr>
                <tr>
                    <td class="odd">
                        <label>Mission / Version</label>
                    </td>
                    <td class="odd">
                        <label><?php echo $Connex->f("mission"); ?></label>
                    </td>
                </tr>
                <tr>
                    <td class="even">
                        <label>Ortho rectified</label>
                    </td>
                    <td class="even">
                        <label><?php echo $Connex->f("ortho"); ?></label>
                    </td>
                </tr>
                <tr>
                    <td class="odd">
                        <label>Cloud cover</label>
                    </td>
                    <td class="odd">
                        <label><?php echo $cloudcover = ($cc > 0) ? $cc . '%' : "N/A"; ?></label>
                    </td>
                </tr>
                <tr>
                    <td class="even">
                        <label>Acquisition date</label>
                    </td>
                    <td class="even">
                        <label><?php echo strftime("%b %d, %Y", strtotime($Connex->f("date"))); ?></label>
                    </td>
                </tr>
            </tbody>
            <?php
        }
        ?>
    </table><?php
} else {
    ?>
    <label style="color: #660000;margin-top: 2px;">No information were found ...</label>
    <?php
}
