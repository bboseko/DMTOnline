<?php
include_once ("../script/mysqlclass.php");
if (isset($_COOKIE["id"])) {
    $id_user = $_COOKIE['id'];
    $Connex = new db(0);
    $Connex->connect();
    $Connex->query("SELECT `dmt_image`.*, dmt_deliver.id_delivery as delivery,`dmt_support`.`preview_path` FROM `dbosfacdmt`.`dmt_deliver` "
            . "INNER JOIN `dbosfacdmt`.`dmt_image` ON (`dmt_deliver`.`id_image` = `dmt_image`.`id_image`) "
            . "INNER JOIN `dbosfacdmt`.`dmt_delivery` "
            . "ON (`dmt_deliver`.`id_delivery` = `dmt_delivery`.`id_delivery`) INNER JOIN `dbosfacdmt`.`dmt_support` "
            . "ON (`dmt_image`.`id_support` = `dmt_support`.`id_support`) WHERE "
            . "(`dmt_delivery`.`id_user` = '$id_user') and dmt_deliver.downloaded = '0';");
    $numRow = $Connex->num_rows();
    if ($numRow > 0) {
        $count = 0;
        ?>
        <table id="cartImagesShow" class="ui-widget ui-widget-content" style="width: 100%;">
            <thead>
                <tr class="ui-widget-header ">
                    <th>ID</th>
                    <th>Entity name</th>   
                    <th>Version</th>
                    <th>Acquisition date</th>
                    <th>Size (MB)</th>
                    <th>Cloud cover</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <?php
            while ($Connex->next_record()) {
                $id = $Connex->f("id_image");
                $entity_name = $Connex->f("image_name");
                $mission = $Connex->f("mission");
                $acquisition_date = strftime("%b %d, %Y", strtotime($Connex->f("date")));
                $size = $Connex->f("size");
                $cc = $Connex->f("cloud_cover");
                $delivery = $Connex->f("delivery");
                $preview = $Connex->f("preview_path");
                if ($preview == '') {
                    $preview = '/preview/nobrowse_small.png';
                }
                $evenOdd = ( ++$count % 2 == 0) ? 'even' : 'odd';
                ?>
                <tbody>
                    <tr>
                        <td class="<?php echo $evenOdd; ?>" style="width: 50px;">
                            <label><?php echo $id; ?></label>
                        </td>
                        <td class="<?php echo $evenOdd; ?>">
                            <label><?php echo $entity_name; ?></label>
                        </td>
                        <td class="<?php echo $evenOdd; ?>">
                            <label><?php echo $mission; ?></label>
                        </td>
                        <td class="<?php echo $evenOdd; ?>">
                            <label><?php echo $acquisition_date; ?></label>
                        </td>
                        <td class="<?php echo $evenOdd; ?>" style="width: 70px;">
                            <label><?php echo $size; ?></label>
                        </td>
                        <td class="<?php echo $evenOdd; ?>">
                            <label><?php echo $cloudcover = ($cc <= 100) ? $cc . '%' : "N/A"; ?></label>
                        </td>
                        <td class="<?php echo $evenOdd; ?>" style="text-align: center;">
                            <a title="Show metadata" onclick="loadMetadata(<?php echo $id ?>)">
                                <div class="ee-icon ee-icon-info"></div>
                            </a>
                        </td>
                        <td class="<?php echo $evenOdd; ?>" style="text-align: center;">
                            <a title="Show browse" onclick="quickLook('<?php echo $entity_name; ?>', '<?php echo $preview; ?>');">
                                <div class="ee-icon ee-icon-image"></div>
                            </a>
                        </td>
                        <td class="<?php echo $evenOdd; ?>" style="text-align: center;">
                            <a title="Download this image" onclick="downloadImage(<?php echo $id ?>)">
                                <div class="ee-icon ee-icon-download"></div>
                            </a>
                        </td>
                        <td class="<?php echo $evenOdd; ?>" style="text-align: center;">
                            <a title="Delete this image in my cart" onclick="deleteImage('<?php echo $id; ?>','<?php echo $delivery; ?>')">
                                <div class="ee-icon ee-icon-delete"></div>
                            </a>
                        </td>
                    </tr>
                </tbody>
                <?php
            }
            ?>
        </table><?php
    } else {
        ?>
        <label style="color: #660000;margin-top: 2px;">Your cart is empty ...</label>
        <?php
    }
    ?>

    <?php
}