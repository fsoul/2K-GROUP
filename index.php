<?php
    require_once 'config.php';
    require_once 'classes/db.php';

    // get all station and quantity of associated dealers
    $queryStr = '
      SELECT *, COUNT(metro_station_id) AS dealers_qty
      FROM metro_station
      LEFT JOIN metro_dealer
      ON id = metro_station_id
      GROUP BY metro_station_id
    ';

    // get database instance
    $db = Db::getInstance();
    $stmt = $db->prepare($queryStr);
    //  return data as associative array
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    $result = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Test Case</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/images/blog.ico" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" href="/css/main.css">

</head>
<body>
    <section id="left">
        <img src="images/moscow-metro-800.png" alt="Moscow Metro" usemap="#moscow_metro">
        <map name="moscow_metro">
            <?php
                foreach($result as $val){
                    $coords = explode(';', $val['metro_station_coords']);
                    $cirle = $coords[0];
                    $rect = $coords[1];
            ?>
            <area shape="circle" coords="<?php echo $cirle;?>" href="/metro/<?php echo $val['id'];?>.html" alt="<?php echo $val['metro_station_name'];?>">
            <area shape="rect" coords="<?php echo $rect;?>" href="/metro/<?php echo $val['id'];?>.html" alt="<?php echo $val['metro_station_name'];?>">
            <?php
                }
            ?>
        </map>
    </section>
    <section id="right" >
        <table class="main_table" border="1">
            <tr>
                <th>Название станции</th>
                <th>Количество связанных диллеров</th>
            </tr>
            <?php
                foreach($result as $val){
                    $stationName = $val['metro_station_name'];
                    $dealersQty = $val['dealers_qty'];

            ?>
            <tr>
                <td><a href="/metro/<?php echo $val['id'];?>.html"><?php echo $stationName;?></td>
                <td class="table_qty"><?php echo $dealersQty;?></td>
            </tr>
            <?php
                }
            ?>
        </table>
        <form>
            <select class="metro_select" onchange="if(this.selectedIndex) window.location=(this.options[this.selectedIndex].value);">
                <option></option>
                <option value="/metro.php"><a href="metro.php">Все станции</a></option>
                <?php
                    foreach($result as $val){
                ?>
                <option value="/metro/<?php echo $val['id'];?>.html"><?php echo $val['metro_station_name'];?></option>
                <?php
                    }
                ?>
            </select>
        </form>
        <p class="all_dealers_link">
            <a href="/metro.php">Полный список диллеров</a>
        </p>
    </section>
</body>
</html>



