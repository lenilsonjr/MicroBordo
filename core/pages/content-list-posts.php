<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/core/core.php');
$o = new Posts;
$l = $o->_list();

foreach ($l as $row): ?>
    <div class="post" id="post-<?=$row['id']?>">

        <br>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="text-default">#<?=$row['id']?> - <?=date("d/m/Y H:i:s", strtotime($row['date']));?></i></h3>
            </div>
            <div class="panel-body">
                <textarea disabled class="form-group"><?=$row['post']?></textarea>
            </div>
            <?php if (!empty($row['tags'])) : ?>
            <div class="panel-footer">
                <?php foreach ($o->tagStrArr($row['tags']) as $row): ?>
                    <a class="ptag"><i class="fa fa-tag"></i> <span class="pntag"><?=$row?></span></a>;&nbsp;
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>

<?php endforeach; ?>
<script type="text/javascript">
    $("textarea[disabled]").elastic();
</script>
