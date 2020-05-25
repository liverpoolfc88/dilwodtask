<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = 'My CV / Resume';
if (Yii::$app->user->identity->id == $model->id)  $guest = true;
else $guest = false;
?>
<div class="site-index">
    <div class="bs-example" data-example-id="hoverable-table">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Middle name</th>
                <?php if ($guest): ?>
                <th>Actions</th>
                <?php endif;?>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?=$model->first?></td>
                    <td><?=$model->last?></td>
                    <td><?=$model->middle_name?></td>
                    <?php if ($guest): ?>
                        <td>
                            <a href="<?=Url::to(['site/profile-update']);?>" title="Update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                        </td>
                    <?php endif;?>
                </tr>
            </tbody>
        </table>
        <?php if ($model):?>
        <div class="badge">Educations | <a href="<?=Url::to(['site/education']);?>" class="alert-danger" title="Add Education">Add</a> </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>University</th>
                <th>Location</th>
                <th>From</th>
                <th>To</th>
                <?php if ($guest): ?>
                <th>Actions</th>
                <?php endif;?>
            </tr>
            </thead>
            <tbody>
            <?php $i=0; foreach ($model->education as $item): $i++;?>
                <tr>
                    <th scope="row"><?=$i?></th>
                    <td><?=$item->university?></td>
                    <td><?=$item->location?></td>
                    <td><?=$item->from_date?></td>
                    <td><?=$item->to_date?></td>
                    <?php if ($guest): ?>
                        <td>
                            <a href="<?=Url::to(['site/education-update','id'=>$item->id]);?>" title="Update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a> |
                            <a href="<?=Url::to(['site/education-remove','id'=>$item->id]);?>" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Are you sure you want to delete this item?" data-method="post"><span class="glyphicon glyphicon-trash"></span></a>
                        </td>
                    <?php endif;?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <div class="badge">Skills | <a href="<?=Url::to(['site/skill']);?>" class="alert-danger" title="Add Skill">Add</a></div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Rate</th>
                <?php if ($guest): ?>
                <th>Actions</th>
                <?php endif;?>
            </tr>
            </thead>
            <tbody>
            <?php $i=0; foreach ($model->skill as $item): $i++;?>
                <tr>
                    <th scope="row"><?=$i?></th>
                    <td><?=$item->name?></td>
                    <td><?=$item->rate?></td>
                    <?php if ($guest): ?>
                    <td>
                        <a href="<?=Url::to(['site/skill-update','id'=>$item->id]);?>" title="Update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a> |
                        <a href="<?=Url::to(['site/skill-remove','id'=>$item->id]);?>" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Are you sure you want to delete this item?" data-method="post"><span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                    <?php endif;?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif;?>
    </div>
</div>
