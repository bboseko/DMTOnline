<?php
include ("../languages/include_lang_file.php");
include_once ("../script/mysqlclass.php");
if (isset($_COOKIE["id"])) {
    $id_user = $_COOKIE['id'];
    $Connex = new db(0);
    $Connex->connect();
    $query = "select * from dmt_criteria where id_user ='$id_user'";
    $Connex->query($query);
    $numRow = $Connex->num_rows();
    if ($numRow > 0) {
        ?>
        <table class="ui-widget ui-widget-content" style="width: 100%;">
            <thead>
                <tr class="ui-widget-header ">
                    <th><?php echo $lang['date']; ?></th>
                    <th><?php echo $lang['criteria-name']; ?></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <?php
            while ($Connex->next_record()) {
                $id = $Connex->f("id_criteria");
                $criteria_name = $Connex->f("criteria_name");
                $register_date = strftime("%b %d, %Y %I:%M:%S", strtotime($Connex->f("register_date")));
                ?>
                <tbody>
                    <tr>
                        <td style="width: 150px;">
                            <label><?php echo $register_date; ?></label>
                        </td>
                        <td>
                            <label><?php echo $criteria_name; ?></label>
                        </td>
                        <td style="text-align: center;">
                            <a title="<?php echo $lang['load-result']; ?>" onclick="loadCriteria(<?php echo $id ?>)">
                                <div class="ee-icon ee-icon-load"></div>
                            </a>
                        </td>
                        <td style="text-align: center;">
                            <a title="<?php echo $lang['delete-saved-criteria']; ?>" onclick="deleteCriteria(<?php echo $id ?>)">
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
        <label style="color: #660000;margin-top: 2px;"><?php echo $lang['no-criteria-found']; ?></label>
        <?php
    }
    ?>

    <?php
}


