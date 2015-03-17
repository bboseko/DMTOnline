<?php
include_once ("mysqlclass.php");

function connectdb() {
//Remote database settings
//    $hostname = "dbosfacdmtdev.db.8487892.hostedresource.com";
//    $databasename = "dbosfacdmtdev";
//    $username = "dbosfacdmtdev";
//    $password = "Osf@cL@b01";
//    Local database settings
    $hostname = "localhost";
    $databasename = "dbosfacdmt";
    $username = "root";
    $password = "ustopudie";

    mysql_pconnect($hostname, $username, $password) or die("Connection failed:" . mysql_error()); // connexion persistante au serveur
    mysql_select_db($databasename) or die("Database selection failed:" . mysql_error());
}

function loadComboboxCategory() {
    $Connex = new db(0);
    $Connex->connect();
    $Connex->query("SELECT id_category,category_name FROM dmt_category ORDER BY category_name");
    if ($Connex->num_rows() >= 1) {
        while ($Connex->next_record()) {
            $id = $Connex->f("id_category");
            $value = $Connex->f("category_name");
            ?><a><input type="checkbox" value="<?php echo $id; ?>" name="categoryBoxes" checked="checked" /> <?php echo $value; ?></a><?php
        }
    }
    $Connex->free();
}

function loadComboboxPath() {
    $Connex = new db(0);
    $Connex->connect();
    $Connex->query("SELECT distinct path FROM dmt_pathrow where path_row in(select path_row from dmt_concern where id_image in (select id_image from dmt_image where id_category=2)) order by path asc");
    if ($Connex->num_rows() >= 1) {
        while ($Connex->next_record()) {
            $id = $Connex->f("path");
            $value = $Connex->f("path");
            ?><option value="<?php echo $id; ?>"><?php echo $value; ?></option><?php
            }
        }
        $Connex->free();
    }

    function loadComboboxRow() {
        $Connex = new db(0);
        $Connex->connect();
        $Connex->query("SELECT distinct row FROM dmt_pathrow where path_row in(select path_row from dmt_concern where id_image in (select id_image from dmt_image where id_category=2)) order by row asc");
        if ($Connex->num_rows() >= 1) {
            while ($Connex->next_record()) {
                $id = $Connex->f("row");
                $value = $Connex->f("row");
                ?><option value="<?php echo $id; ?>"><?php echo $value; ?></option><?php
        }
    }
    $Connex->free();
}

function loadComboboxYear() {
    $Connex = new db(0);
    $Connex->connect();
    $Connex->query("SELECT distinct year(date) as year FROM dmt_image ORDER BY year");
    if ($Connex->num_rows() >= 1) {
        while ($Connex->next_record()) {
            $id = $Connex->f("year");
            $value = $Connex->f("year");
            ?><option value="<?php echo $id; ?>"><?php echo $value; ?></option><?php
            }
        }
        $Connex->free();
    }

    function loadComboboxYearTo() {
        $Connex = new db(0);
        $Connex->connect();
        $Connex->query("SELECT distinct year(date) as year FROM dmt_image ORDER BY year");
        if ($Connex->num_rows() >= 1) {
            $i = 1;
            while ($Connex->next_record()) {
                $id = $Connex->f("year");
                $value = $Connex->f("year");
                if ($i == $Connex->num_rows()) {
                    ?><option value="<?php echo $id; ?>" selected="selected"><?php echo $value; ?></option><?php
                } else {
                    ?><option value="<?php echo $id; ?>"><?php echo $value; ?></option><?php
                }
                $i++;
            }
        }
        $Connex->free();
    }

    function loadComboboxOrtho() {
        $Connex = new db(0);
        $Connex->connect();
        $Connex->query("SELECT distinct ortho FROM dmt_image where ortho <> '' order by ortho desc");
        if ($Connex->num_rows() >= 1) {
            while ($Connex->next_record()) {
                $id = $Connex->f("ortho");
                $value = $Connex->f("ortho");
                ?><option value="<?php echo $id; ?>"><?php echo $value; ?></option><?php
            }
        }
        $Connex->free();
    }

    function loadComboboxStack() {
        $Connex = new db(0);
        $Connex->connect();
        $Connex->query("SELECT distinct stack FROM dmt_image where stack <> '' order by stack desc");
        if ($Connex->num_rows() >= 1) {
            while ($Connex->next_record()) {
                $id = $Connex->f("stack");
                $value = $Connex->f("stack");
                ?><option value="<?php echo $id; ?>"><?php echo $value; ?></option><?php
            }
        }
        $Connex->free();
    }

    function loadComboboxSLC() {
        $Connex = new db(0);
        $Connex->connect();
        $Connex->query("SELECT distinct slc FROM dmt_image where slc <> '' order by slc desc");
        if ($Connex->num_rows() >= 1) {
            while ($Connex->next_record()) {
                $id = $Connex->f("slc");
                $value = $Connex->f("slc");
                ?><option value="<?php echo $id; ?>"><?php echo $value; ?></option><?php
            }
        }
        $Connex->free();
    }

    function loadComboboxMissionLandsat() {
        $Connex = new db(0);
        $Connex->connect();
        $Connex->query("SELECT distinct mission FROM dmt_image where id_category =2 and mission <> '' order by mission");
        if ($Connex->num_rows() >= 1) {
            while ($Connex->next_record()) {
                $id = $Connex->f("mission");
                $value = $Connex->f("mission");
                ?><option value="<?php echo $id; ?>"><?php echo $value; ?></option><?php
            }
        }
        $Connex->free();
    }

    function loadComboboxMissionSRTM() {
        $Connex = new db(0);
        $Connex->connect();
        $Connex->query("SELECT distinct mission FROM dmt_image where id_category =3 and mission <> '' order by mission");
        if ($Connex->num_rows() >= 1) {
            while ($Connex->next_record()) {
                $id = $Connex->f("mission");
                $value = $Connex->f("mission");
                ?><option value="<?php echo $id; ?>"><?php echo $value; ?></option><?php
            }
        }
        $Connex->free();
    }

    function loadComboboxMissionSPOT() {
        $Connex = new db(0);
        $Connex->connect();
        $Connex->query("SELECT distinct mission FROM dmt_image where id_category =6 and mission <> '' order by mission");
        if ($Connex->num_rows() >= 1) {
            while ($Connex->next_record()) {
                $id = $Connex->f("mission");
                $value = $Connex->f("mission");
                ?><option value="<?php echo $id; ?>"><?php echo $value; ?></option><?php
            }
        }
        $Connex->free();
    }

    function loadComboboxProvince() {
        $Connex = new db(0);
        $Connex->connect();
        $Connex->query("SELECT id_province,province_name FROM dmt_province order by province_name");
        if ($Connex->num_rows() >= 1) {
            while ($Connex->next_record()) {
                $id = $Connex->f("id_province");
                $value = $Connex->f("province_name");
                ?><option value="<?php echo $id; ?>"><?php echo $value; ?></option><?php
            }
        }
        $Connex->free();
    }

    function loadComboboxDistrict($idProvince) {
        $Connex = new db(0);
        $Connex->connect();
        $Connex->query("SELECT id_district,district_name FROM dmt_district where id_province = " . $idProvince . " order by district_name");
        if ($Connex->num_rows() >= 1) {
            while ($Connex->next_record()) {
                $id = $Connex->f("id_district");
                $value = $Connex->f("district_name");
                ?><option value="<?php echo $id; ?>"><?php echo $value; ?></option><?php
            }
        }
        $Connex->free();
    }

    function loadComboboxTerritory() {
        $Connex = new db(0);
        $Connex->connect();
        $Connex->query("SELECT id_territory,territory_name FROM dmt_territory order by territory_name");
        if ($Connex->num_rows() >= 1) {
            while ($Connex->next_record()) {
                $id = $Connex->f("id_territory");
                $value = $Connex->f("territory_name");
                ?><option value="<?php echo $id; ?>"><?php echo $value; ?></option><?php
            }
        }
        $Connex->free();
    }

    function loadComboboxSector() {
        $Connex = new db(0);
        $Connex->connect();
        $Connex->query("SELECT id_sector,sector_name FROM dmt_sector order by sector_name");
        if ($Connex->num_rows() >= 1) {
            while ($Connex->next_record()) {
                $id = $Connex->f("id_sector");
                $value = $Connex->f("sector_name");
                ?><option value="<?php echo $id; ?>"><?php echo $value; ?></option><?php
            }
        }
        $Connex->free();
    }

    function loadComboboxLocality() {
        $Connex = new db(0);
        $Connex->connect();
        $Connex->query("SELECT id_locality,locality_name FROM dmt_locality order by locality_name");
        if ($Connex->num_rows() >= 1) {
            while ($Connex->next_record()) {
                $id = $Connex->f("id_locality");
                $value = $Connex->f("locality_name");
                ?><option value="<?php echo $id; ?>"><?php echo $value; ?></option><?php
            }
        }
        $Connex->free();
    }

    function loadComboboxCloudCover() {
        $Connex = new db(0);
        $Connex->connect();
        $Connex->query("SELECT distinct cloud_cover FROM dmt_image where cloud_cover <> '' and cloud_cover > 0 order by cloud_cover desc");
        if ($Connex->num_rows() >= 1) {
            while ($Connex->next_record()) {
                $value = $Connex->f("cloud_cover");
                ?><option value="<?php echo $value; ?>"><?php echo $value; ?>%</option><?php
        }
    }
    $Connex->free();
}

function getTotalSize($idss) {
    $size = 0;
    $Connex = new db(0);
    $Connex->connect();
    for ($i = 0; $i < count($idss); $i++) {
        $Connex->query("SELECT size FROM dmt_image where id_image = " . $idss[$i]);
        if ($Connex->num_rows() >= 1 && $Connex->next_record()) {
            $size += $Connex->f("size");
        }
    }
    $Connex->free();
    return bytesToSize($size * 1024 * 1024);
}

function bytesToSize($bytes) {
    $precision = 2;
    $kilobyte = 1024;
    $megabyte = $kilobyte * 1024;
    $gigabyte = $megabyte * 1024;
    $terabyte = $gigabyte * 1024;

    if (($bytes >= 0) && ($bytes < $kilobyte)) {
        return $bytes . ' B';
    } elseif (($bytes >= $kilobyte) && ($bytes < $megabyte)) {
        return round($bytes / $kilobyte, $precision) . ' KB';
    } elseif (($bytes >= $megabyte) && ($bytes < $gigabyte)) {
        return round($bytes / $megabyte, $precision) . ' MB';
    } elseif (($bytes >= $gigabyte) && ($bytes < $terabyte)) {
        return round($bytes / $gigabyte, $precision) . ' GB';
    } elseif ($bytes >= $terabyte) {
        return round($bytes / $terabyte, $precision) . ' TB';
    } else {
        return $bytes . ' B';
    }
}
