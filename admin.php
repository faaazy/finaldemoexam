<?php
require_once("init.php");
requireAdmin();

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $status = $_POST["status"];
    $idApp = intval($_POST["idApp"]);

    $conn->query("UPDATE app SET status='$status' WHERE id='$idApp'");

    $_SESSION["msg"] = "Статус успешно обновлен";
    header("Location: admin.php");
    exit;
}

// get parameters
$page = max(1, intval($_GET["page"] ?? 1));
$sort = $_GET["sort"] ?? "id";
$filter = $_GET['filter'] ?? "";
$order = $_GET["order"] ?? "ASC";

// shortcut to not check everytime
$where = $filter ? "WHERE status='$filter'" : "";

// pagination
$perPage = 5;
$total = $conn->query("SELECT id FROM app $where")->num_rows;
$totalPages = ceil($total / $perPage);
// if 3rd page we go to previous and multiply by perPage so 2 * 5 = 10 thats where we start to 3rd page
$start = (($page - 1) * $perPage);

$apps = $conn->query("SELECT * FROM app $where ORDER BY $sort $order LIMIT $start, $perPage");

function sortLink($col) {
    global $order, $sort, $filter;
    // if sort === current column that got clicked we change ORDER 
    $nextOrder = ($sort === $col && $order === "ASC") ? "DESC" : "ASC";
    // if current column === sort column than we check if Order parameter === ASC and just do reverse
    $arrow = $sort === $col ? ($order === "ASC" ? "/\\" : "\/") : "";

    return "<a href='?sort=$col&order=$nextOrder&filter=$filter'>$col $arrow</a>";
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

    <h1>Админ панель</h1>

    <main>

    <form method="get">
        <select name="filter">
            <option value="">Все статусы</option>
            <?php foreach ($statuses as $status): ?>
                <!-- if current filter status === status then its selected -->
                <option <?= $filter === $status ? "selected" : "" ?>><?= $status ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Фильтр</button>
    </form>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th><?= sortLink("id") ?></th>
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
                        <td><?= $row["place"] ?></td>
                        <td><?= $row["date_start"] ?></td>
                        <td><?= $row["payment_method"] ?></td>
                        <td>
                            <form action="admin.php" method="post">
                                <input type="hidden" name="idApp" value="<?= $row["id"] ?>">
                                <select name="status">
                                    <?php foreach($statuses as $status): ?>
                                        <option <?= $row["status"] === $status ? "selected" : "" ?>><?= $status ?></option>
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
        <?php for ($i=1; $i < $totalPages; $i++): ?>
            <a href="?page=<?= $i ?>&sort=<?= $sort ?>&order=<?= $order ?>&filter=<?= $filter ?>"><?= $i ?></a>
        <?php endfor; ?>
    </div>

    </main>

    <?php showMessage(); ?>
</body>
</html>