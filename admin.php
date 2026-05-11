<?php
require_once("init.php");
requireAdmin();

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_app = intval($_POST["idApp"]);
    $status = $_POST["status"];
    $conn->query("UPDATE app SET status='$status' WHERE id='$id_app'");

    $_SESSION["msg"] = "Статус успешно обновлен";
    header("Location: admin.php");
    exit;
}

$page = max(1, intval($_GET["page"] ?? 1));
$sort = $_GET["sort"] ?? "id";
$order = $_GET["order"] ?? "ASC";
$filter = $_GET["filter"] ?? "";

$where = $filter ? "WHERE status='$filter'" : "";

$perPage = 5;
$total = $conn->query("SELECT id FROM app $where")->num_rows;
$totalPages = ceil($total / $perPage);
$start = ($page - 1) * $perPage;

$apps = $conn->query("SELECT * FROM app $where ORDER BY $sort $order LIMIT $start, $perPage");

function sortLink($column) {
    global $sort, $order, $filter;
    $nextOrder = ($sort === $column && $order === "ASC") ? "DESC" : "ASC";
    $arrow = $sort === $column ? ($order === "ASC" ? "/\\" : "\/") : "";
    return "<a href='?sort=$column&order=$nextOrder&filter=$filter'>$column $arrow</a>";
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
    <?php include("header.php"); ?>

    <h1>Админ-панель</h1>

    <!-- filter -->
     <form method="get">
        <select name="filter">
            <option value="">Все статусы</option>
            <?php foreach ($statuses as $status): ?>
                <option <?= $filter === $status ? "selected" : "" ?>><?= $status ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Фильтр</button>
     </form>

    <div class="table-wrap">
        <table border="1">
            <thead>
                <tr>
                    <th><?= sortLink("id") ?></th>
                    <th><?= sortLink("id_user") ?></th>
                    <th><?= sortLink("place") ?></th>
                    <th><?= sortLink("date_start") ?></th>
                    <th>Способ оплаты</th>
                    <th><?= sortLink("status") ?></th>
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
                                    <?php foreach ($statuses as $status): ?>
                                        <option <?= $row["status"] === $status ? "selected" : "" ?>><?= $status ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="submit">Сохранить</button>
                            </form>
                        </td>
                    </tr>

                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>&sort=<?= $sort ?>&order=<?= $order ?>&filter=<?= $filter ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
        </div>
    </div>

    <?php showMessage(); ?>

</body>
</html>