<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/core/core.php');

$search = new Search;
$results = $search->searchString($_GET['s']);
if (!empty($results)) {
?>
<table class="table table-striped">
    <tbody data-link="row" class="rowlink">
        <tr>
            <th>#</th>
            <th>Local</th>
            <th>Nome</th>
        </tr>

    <?php
    foreach ($results as $row) {
    ?>

        <tr id="search-<?=$row['id']?>">
            <td><a href="#"><?php echo $row['id']; ?></a></td>
            <td class="search-local"><?php echo $row['id']; ?></td>
            <td class="search-name"><?php echo $row['name']; ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php
} else {

    echo '<h3><i>Nada foi encontrado!</i></h3>';

}
?>
