<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/core/core.php');

$_GET['p'] = (empty($_GET['p'])) ? 1 : $_GET['p'];

$categories = new Categories;
$c = $categories->_list(15, Pagination::getOffSet($_GET['p']));
$maximum = Pagination::getMaxPage('products_categories');

if(!empty($c)) {
?>
    <table class="table table-striped">
        <tbody data-link="row" class="rowlink">
            <tr>
                <th>#</th>
                <th>Nome</th>
            </tr>

            <?php foreach ($c as $row) { ?>
            <tr id="category-<?=$row['id']?>">
                <td><a data-toggle="modal" data-target="#modalView" data-id="<?php echo $row['id']; ?>" data-type="<?php echo $row['id']; ?>"><?php echo $row['id']; ?></a></td>
                <td class="category-name"><?php echo $row['name']; ?></td>
            </tr>
            <?php } ?>

        </tbody>
    </table>

    <nav>
      <ul class="pagination pull-left">
        <?php
        if($_GET['p'] == 1){
            echo '<li class="active"><a class="pagBtn" href="1"><span aria-hidden="true">&laquo;</span>Primeira página</a></li>';
        } else {
            echo '<li><a class="pagBtn" href="1"><span aria-hidden="true">&laquo;</span>Primeira página</a></li>';
        }

        For($i = 1; $i <= $maximum; $i++){
            $active = ($i == $_GET['p']) ? 'active' : '';
            echo '<li class="'.$active.'"><a class="pagBtn" href="'.$i.'">'.$i.'</a></li>';
        }

        if($_GET['p'] == $maximum){
            echo '<li class="active"><a class="pagBtn" href="'.$maximum.'">Última página<span aria-hidden="true">&raquo;</span></a></li>';
        } else {
            echo '<li><a class="pagBtn" href="'.$maximum.'">Última página<span aria-hidden="true">&raquo;</span></a></li>';
        }

        ?>
      </ul>
    </nav>
    <?php
    } else {
    ?>
        <div class="alert alert-dismissable alert-warning">
            <p><i class="mdi-alert-warning"></i> Não há categorias cadastrados!</p>
        </div>
    <?php
    }
    ?>
