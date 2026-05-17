<?php 
require_once("init.php");

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $idApp = intval($_POST['idApp']);
    $status = $_POST["status"];

    $conn->query("UPDATE app SET status='$status' WHERE id='$idApp'");

    redirectMsg("Статус успешно обновлен", "admin.php");
}

$page = max(1, intval($_GET["page"] ?? 1));
$sort = $_GET["sort"] ?? "id";
$order = $_GET["order"] ?? "ASC";
$filterStatus = $_GET["filterStatus"] ?? "";

$where = $filterStatus ? "WHERE status='$filterStatus'" : "";

$perPage = 2;
$totalPages = ceil($conn->query("SELECT id FROM app $where")->num_rows / $perPage);
$start = ($page - 1) * $perPage;

$apps = $conn->query("SELECT * FROM app $where ORDER BY $sort $order LIMIT $start, $perPage");

function sortLink($col, $label) {
    global $sort, $order, $filterStatus;

    $nextOrder = ($col === $sort && $order === "ASC") ? "DESC" : "ASC";
    $arrow = $col === $sort ? ($order === "ASC" ? "/\\" : "\/") : "";

    return "<a href='?sort=$col&order=$nextOrder&filterStatus=$filterStatus'>$label $arrow</a>";
}

$statuses = ["Новая", "Банкет назначен", "Банкет завершен"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include("header.php") ?>

    <h1>Админ панель</h1>

    <main>
        <form method="get">
            <select name="filterStatus">
                <option value="">Все статусы</option>
                <?php foreach($statuses as $status): ?>
                    <option <?= $status === $filterStatus ? "selected" : "" ?>><?= $status ?></option>
                <?php endforeach ?>
            </select>
            <button type="submit">Отфильтровать</button>
        </form>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th><?= sortLink("id", "ID") ?></th>
                        <th><?= sortLink("id_user", "ID польз.") ?></th>
                        <th><?= sortLink("place", "Место") ?></th>
                        <th><?= sortLink("date_start", "Дата начала") ?></th>
                        <th>Способ оплаты</th>
                        <th><?= sortLink("status", "Статус") ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $apps->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row["id"] ?></td>
                            <td><?= $row["id_user"] ?></td>
                            <td><?= $row["place"] ?></td>
                            <td><?= $row["date_start"] ?></td>
                            <td><?= $row["payment_method"] ?></td>
                            <td>
                                <form action="admin.php" method="post">
                                    <input type="hidden" name="idApp" value="<?= $row["id"] ?>">
                                    <select name="status">
                                        <?php foreach($statuses as $status): ?>
                                            <option <?= $status === $row["status"] ? "selected" : "" ?>><?= $status ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <button type="submit">Обновить</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <div class="pagination">
            <?php for ($i=1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>&sort=<?= $sort ?>&order=<?= $order ?>&filterStatus=<?= $filterStatus ?>"><?= $i ?></a>
            <?php endfor; ?>
        </div>
    </main>


    <?php showMessage(); ?>
</body>
</html>