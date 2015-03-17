<?php
include ("../languages/include_lang_file.php");
include_once ("../script/mysqlclass.php");
$idImage = $_POST['idImage'];
$Connex = new db(0);
$Connex->connect();
$Connex->query("SELECT dmt_image.*,dmt_category.category_name,dmt_support.*,dmt_pathrow.* FROM dmt_image INNER JOIN dmt_category ON "
        . "(`dmt_image`.`id_category` = `dmt_category`.`id_category`) INNER JOIN dmt_support "
        . "ON (`dmt_image`.`id_support` = `dmt_support`.`id_support`) INNER JOIN dmt_concern "
        . "ON (`dmt_concern`.`id_image` = `dmt_image`.`id_image`) INNER JOIN dmt_pathrow "
        . "ON (`dmt_concern`.`path_row` = `dmt_pathrow`.`path_row`) "
        . "WHERE (`dmt_image`.`id_image` = '$idImage') limit 1");
$numRow = $Connex->num_rows();
if ($numRow > 0) {
    ?>
    <table id="cartImagesShow" class="ui-widget ui-widget-content" style="width: 100%;">
        <thead>
            <tr class="ui-widget-header ">
                <th><?php echo $lang['entity-attribute']; ?></th>   
                <th><?php echo $lang['attribute-value']; ?></th>
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
                        <label><?php echo $lang['category-name']; ?></label>
                    </td>
                    <td class="even">
                        <label><?php echo $category_name; ?></label>
                    </td>
                </tr>
                <tr>
                    <td class="odd">
                        <label><?php echo $lang['id']; ?></label>
                    </td>
                    <td class="odd">
                        <label><?php echo $id; ?></label>
                    </td>
                </tr>
                <tr>
                    <td class="even">
                        <label><?php echo $lang['entity-name']; ?></label>
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
                            <label><?php echo $lang['path']; ?></label>
                        </td>
                        <td class="odd">
                            <label><?php echo $Connex->f("path"); ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td class="even">
                            <label><?php echo $lang['row']; ?></label>
                        </td>
                        <td class="even">
                            <label><?php echo $Connex->f("row"); ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td class="odd">
                            <label><?php echo $lang['slc-text']; ?></label>
                        </td>
                        <td class="odd">
                            <label><?php echo $Connex->f("slc"); ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td class="even">
                            <label><?php echo $lang['pre-statck-text']; ?></label>
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
                        <label><?php echo $lang['center-longitude']; ?></label>
                    </td>
                    <td class="odd">
                        <label><?php echo $Connex->f("longitude"); ?></label>
                    </td>
                </tr>
                <tr>
                    <td class="even">
                        <label><?php echo $lang['center-latitude']; ?></label>
                    </td>
                    <td class="even">
                        <label><?php echo $Connex->f("latitude"); ?></label>
                    </td>
                </tr>
                <tr>
                    <td class="odd">
                        <label><?php echo $lang['format']; ?></label>
                    </td>
                    <td class="odd">
                        <label><?php echo $Connex->f("format"); ?></label>
                    </td>
                </tr>
                <tr>
                    <td class="even">
                        <label><?php echo $lang['size']; ?></label>
                    </td>
                    <td class="even">
                        <label><?php echo $Connex->f("size"); ?></label>
                    </td>
                </tr>
                <tr>
                    <td class="odd">
                        <label><?php echo $lang['mission-version']; ?></label>
                    </td>
                    <td class="odd">
                        <label><?php echo $Connex->f("mission"); ?></label>
                    </td>
                </tr>
                <tr>
                    <td class="even">
                        <label><?php echo $lang['ortho-rectified']; ?></label>
                    </td>
                    <td class="even">
                        <label><?php echo $Connex->f("ortho"); ?></label>
                    </td>
                </tr>
                <tr>
                    <td class="odd">
                        <label><?php echo $lang['cloud-cover']; ?></label>
                    </td>
                    <td class="odd">
                        <label><?php echo $cloudcover = ($cc > 0) ? $cc . '%' : "N/A"; ?></label>
                    </td>
                </tr>
                <tr>
                    <td class="even">
                        <label><?php echo $lang['acquisition-date']; ?></label>
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
    <label style="color: #660000;margin-top: 2px;"><?php echo $lang['no-information-found']; ?></label>
    <?php
}
