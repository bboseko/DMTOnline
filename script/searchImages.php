<?php
header("content-type: text/html; charset=ISO-8859-1");
include_once ("mysqlclass.php");
$Connex = new db(0);
$Connex->connect();
$GLOBALS['num'] = $_POST['start'];
$host = "http://www.osfac.net";
$totalRecord = 0;
$limit = $_POST['limit'];
$landsat = $_POST['landsat'];
$srtm = $_POST['srtm'];
$spot = $_POST['spot'];
$aster = $_POST['aster'];
$asterdem = $_POST['asterdem'];
$other = $_POST['other'];
$category_name = '';

if ($landsat != '') {
    $Qlandsat = "select distinct * from dmt_category inner join dmt_image on dmt_category.id_category = dmt_image.id_category inner join 
    dmt_support on dmt_support.id_support = dmt_image.id_support where " . $landsat . " order by dmt_image.id_image";
    $Qlandsat = str_replace('\\', '', $Qlandsat);
    $Connex->query($Qlandsat);
    $totalRecord = $Connex->num_rows();
    $category_name = 'LANDSAT';
}
if ($srtm != '') {
    $Qsrtm = "select distinct * from dmt_category inner join dmt_image on dmt_category.id_category = dmt_image.id_category inner join 
    dmt_support on dmt_support.id_support = dmt_image.id_support where " . $srtm . " order by dmt_image.id_image";
    $Qsrtm = str_replace('\\', '', $Qsrtm);
    $Connex->query($Qsrtm);
    $totalRecord = $Connex->num_rows();
    $category_name = 'SRTM';
}
if ($spot != '') {
    $Qspot = "select distinct * from dmt_category inner join dmt_image on dmt_category.id_category = dmt_image.id_category inner join 
    dmt_support on dmt_support.id_support = dmt_image.id_support where " . $spot . " order by dmt_image.id_image";
    $Qspot = str_replace('\\', '', $Qspot);
    $Connex->query($Qspot);
    $totalRecord = $Connex->num_rows();
    $category_name = 'SPOT';
}
if ($aster != '') {
    $Qaster = "select distinct * from dmt_category inner join dmt_image on dmt_category.id_category = dmt_image.id_category inner join 
    dmt_support on dmt_support.id_support = dmt_image.id_support where " . $aster . " order by dmt_image.id_image";
    $Qaster = str_replace('\\', '', $Qaster);
    $Connex->query($Qaster);
    $totalRecord = $Connex->num_rows();
    $category_name = 'ASTER';
}
if ($asterdem != '') {
    $Qasterdem = "select distinct * from dmt_category inner join dmt_image on dmt_category.id_category = dmt_image.id_category inner join 
    dmt_support on dmt_support.id_support = dmt_image.id_support where " . $asterdem . " order by dmt_image.id_image";
    $Qasterdem = str_replace('\\', '', $Qasterdem);
    $Connex->query($Qasterdem);
    $totalRecord = $Connex->num_rows();
    $category_name = 'ASTER GDEM';
}
if ($other != '') {
    $Qother = "select distinct * from dmt_category inner join dmt_image on dmt_category.id_category = dmt_image.id_category inner join 
    dmt_support on dmt_support.id_support = dmt_image.id_support where " . $other . " order by dmt_image.id_image";
    $Qother = str_replace('\\', '', $Qother);
    $Connex->query($Qother);
    $totalRecord = $Connex->num_rows();
//    $category_name = '';
}
?>
<table border="0" style="width: 100%; display: table;border-collapse:collapse;" class="resultPageTable" cellspacing="5">
    <thead>
        <tr>
            <th colspan="3" style="padding: 5px;color: #000000;">&laquo;&nbsp;&nbsp;<?php echo $totalRecord; ?>&nbsp;<?php echo $category_name; ?> image(s) were found&nbsp;&nbsp;&raquo;</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($landsat != '') {
            $Connex->query($Qlandsat . $limit);
            loadRecord($Connex, $host);
        }
        if ($srtm != '') {
            $Connex->query($Qsrtm . $limit);
            loadRecord($Connex, $host);
        }
        if ($spot != '') {
            $Connex->query($Qspot . $limit);
            loadRecord($Connex, $host);
        }
        if ($aster != '') {
            $Connex->query($Qaster . $limit);
            loadRecord($Connex, $host);
        }
        if ($asterdem != '') {
            $Connex->query($Qasterdem . $limit);
            loadRecord($Connex, $host);
        }
        if ($other != '') {
            $Connex->query($Qother . $limit);
            loadRecord($Connex, $host);
        }
        ?>
    </tbody>
</table>
<?php

function loadRecord($Connex, $host) {
    while ($Connex->next_record()) {
        $idCategory = $Connex->f("id_category");
        $id = $Connex->f("id_image");
        $name = $Connex->f("image_name");
        $date = $Connex->f("date");
        $size = $Connex->f("size") . ' MB';
        $preview = $Connex->f("preview_path");
        if ($preview == '') {
            $preview = '/preview/nobrowse_small.png';
        }
        $evenOdd = ($GLOBALS['num'] % 2 == 0) ? 'even' : 'odd';
        ?>
        <tr id="resultRow_<?php echo $id; ?>">
            <td class="resultRowNum <?php echo $evenOdd; ?>">
                <span class="include"><?php echo++$GLOBALS['num']; ?><br></span>
            </td>
            <td class="resultRowContent <?php echo $evenOdd; ?>">
                <img title="Show Browse" id="preview_<?php echo $id; ?>" style="cursor: pointer;padding-left:4px;padding-right:4px;" alt="No Browse" src="<?php echo $host . $preview; ?>" 
                     width="80px" height="80px" onclick="quickLook('<?php echo $name; ?>', '<?php echo $preview; ?>');" />
            </td>
            <td nowrap="nowrap" class="resultRowContent <?php echo $evenOdd; ?>">
                <ul style="list-style-type: none;">
                    <li></li>
                    <li><strong>Entity ID:</strong> <?php echo $name; ?></li>
                    <li><strong>Acquisition date:</strong> <?php echo date("F d, Y", strtotime($date)); ?></li>
                    <li><?php ($idCategory == 2) ? isLandsat($id) : '' ?> <strong>Size:</strong> <?php echo $size; ?> </li>
                    <li>
                        <div class="iconContainer">

                            <script type="text/javascript">
                         var idEntity = '<?php echo $id; ?>';
                         var resultRow = $('#resultRow_' + idEntity);
                         if (hash[idEntity] == undefined) {
                             hash[idEntity] = true;
                         }
                         if (hash[idEntity] == true) {
                             $('#entity_' + idEntity).html('<input id="<?php echo $id; ?>" class="resultCheckBox" type="checkbox" title="Include/Exclude this image from results" checked />');
                             resultRow.removeClass('excludedResultRow');
                         }
                         else {
                             $('#entity_' + idEntity).html('<input id="<?php echo $id; ?>" class="resultCheckBox" type="checkbox" title="Include/Exclude this image from results" />');
                             resultRow.addClass('excludedResultRow');
                         }
                         if (arrayColorfp[idEntity] == undefined) {
                             arrayColorfp[idEntity] = 'transparent';
                         }
                         $('#fp_' + idEntity).css('background-color', arrayColorfp[idEntity]);
                            </script>
                            <span id="entity_<?php echo $id; ?>"></span>
                            <a id="fp_<?php echo $id; ?>" title="Show Footprint" class="footprint">
                                <span class="<?php getFootprint($id, $GLOBALS['num']) ?>"></span>
                                <div class="ee-icon ee-icon-footprint"></div>
                            </a>
                            <a title="Show Browse" onclick="quickLook('<?php echo $name; ?>', '<?php echo $preview; ?>');">
                                <div class="ee-icon ee-icon-image"></div>
                            </a>
                        </div>
                        <div style="clear:both;"></div>
                    </li>
                </ul>
            </td>
        </tr>    
        <?php
    }
}
?>
<script type="text/javascript">
                         $('input.resultCheckBox').change(function() {
                             var idIMG = $(this).attr('id');
                             var resultRow = $('#resultRow_' + idIMG);
                             hash[idIMG] = $(this).is(':checked');
                             if (!$(this).is(':checked')) {
                                 resultRow.addClass('excludedResultRow');
                             }
                             else {
                                 resultRow.removeClass('excludedResultRow');
                             }
                             var t = 0;
                             for (var id in hash) {
                                 if (hash[id] == true) {
                                     t++;
                                 }
                             }
//                             if (nRowResult >= 2) {
//                                 t = t - 2;
//                             }
//                             else {
//                                 t = t - 1;
//                             }
                             if (t > 0) {
                                 $('#submitButton').removeClass('disabled');
                             }
                             else {
                                 $('#submitButton').addClass('disabled');
                             }
                         });
</script>
<?php

function isLandsat($id) {
    $Connex = new db(0);
    $Connex->connect();
    $Connex->query("select * from dmt_pathrow inner join dmt_concern on dmt_pathrow.path_row = dmt_concern.path_row 
        where id_image = " . $id);
    while ($Connex->next_record()) {
        $path = $Connex->f("path");
        $row = $Connex->f("row");
    }
    echo "<strong>Path:</strong> $path &nbsp;&nbsp; <strong>Row:</strong> $row&nbsp;&nbsp;";
    return;
    $Connex->free();
}

function randomColor() {
    mt_srand((double) microtime() * 1000000);
    $color = '';
    while (strlen($color) < 6) {
        $color .= sprintf("%02X", mt_rand(0, 255));
    }
    return '#' . $color;
}

function getFootprint($id, $num) {
    $color = randomColor();
    $Connex = new db(0);
    $Connex->connect();
    $Connex->query("select asText(shape) as shape  from dmt_image where id_image = " . $id);
    while ($Connex->next_record()) {
        $shape = str_replace(';', ',', str_replace(" ", ",", str_replace(",", ";", str_replace("))", "", substr($Connex->f("shape"), 9)))));
    }
    $shapeTab = explode(',', $shape);
    $cat = '';
    for ($i = 1; $i < count($shapeTab) - 1; $i = $i + 2) {
        $cat .= $shapeTab[$i] . ',' . $shapeTab[$i - 1] . ',';
    }
    $shape = substr($cat, 0, -1);
    $luma = 0.33 * (0xff & (hexdec($color) >> 0x10)) +
            0.5 * (0xff & (hexdec($color) >> 0x8)) +
            0.16 * (0xff & hexdec($color));
    echo $id . ";" . $shape . ";" . $num . ";" . $color . ";" . $luma . ";" . "polygon";
    return;
    $Connex->free();
}

$Connex->free();
?>