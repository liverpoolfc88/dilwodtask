<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = 'My CV / Resume';
?>
<div class="site-index">
    <div class="bs-example" data-example-id="hoverable-table">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=0; foreach ($model as $item): $i++; ?>
            <tr>
                <th scope="row"><?=$i?></th>
                <td><a href="<?=Url::to(['site/profile', 'id' => $item->id]);?>"><?=$item->first?></a></td>
                <td><a href="<?=Url::to(['site/profile', 'id' => $item->id]);?>"><?=$item->last?></a></td>
                <td><a href="<?=Url::to(['site/profile', 'id' => $item->id]);?>">@<?=$item->username?></a></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
