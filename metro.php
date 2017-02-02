<?php
require_once 'config.php';
require_once 'classes/db.php';

$metroStationId = $_REQUEST["id"];  // Id of requested metro station

if ($metroStationId) {
    // query string that filtering response by station id
    $queryStr = '
          SELECT *
          FROM dealer
          LEFT JOIN metro_dealer
          ON id = dealer_id
          WHERE metro_station_id = ' . $metroStationId;
} else {
    // get all dealers
    $queryStr = '
            SELECT *, COUNT(dealer_id) AS station_qty
            FROM dealer
            LEFT JOIN metro_dealer
            ON id = dealer_id
            GROUP BY dealer_id
        ';
}

$db = Db::getInstance();
$stmt = $db->prepare($queryStr);
//  return data as associative array
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$result = $stmt->fetchAll();

if (!empty($result)) {
    if (!$_REQUEST["id"]) {
        ?>
        <table border="1">
            <tr>
                <th>Id</th>
                <th>Имя диллера</th>
                <th>Адрес</th>
                <th>Телефон</th>
                <th>Количество станций</th>
            </tr>
            <?php
            foreach ($result as $val) {
                ?>
                <tr>
                    <td><?php echo $val['id']; ?></td>
                    <td><?php echo $val['dealer_name']; ?></td>
                    <td><?php echo $val['address']; ?></td>
                    <td><?php echo $val['phone']; ?></td>
                    <td><?php echo $val['station_qty']; ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <p><a href="/">Вернуться на главную</a></p>
        <?php
    } else {
        ?>
        <table border="1">
            <tr>
                <th>Id</th>
                <th>Имя диллера</th>
                <th>Адрес</th>
                <th>Телефон</th>
            </tr>
            <?php
            foreach ($result as $val) {
                ?>
                <tr>
                    <td><?php echo $val['id']; ?></td>
                    <td><?php echo $val['dealer_name']; ?></td>
                    <td><?php echo $val['address']; ?></td>
                    <td><?php echo $val['phone']; ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <p><a href="/metro.php">Отобразить полный список диллеров</a></p>
        <p><a href="/">Вернуться на главную</a></p>
        <?php
    }
} else {
    ?>
    <p>Для данной станции нет диллеров</p>
    <p><a href="/metro.php">Отобразить полный список диллеров</a></p>
    <p><a href="/">Вернуться на главную</a></p>
    <?php
}