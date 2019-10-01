<?php
    use yii\helpers\Url;
?>

<div class="admin-default-index">
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Контент</h3>
                </div>

                <div class="panel-body">

                </div>
            </div>
        </div>


        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Последние зарегистрированные пользователи</h3>
                </div>

                <div class="panel-body">
                    <? foreach ($last_users as $user): ?>
                    <div class="media">
                        <a href="<?= Url::to(['user/view', 'id' => $user->id]) ?>" target="_blank">
                            <div class="media-body">
                                <h4 class="media-heading"><?= $user->email ?></h4>
                                <?= $user->first_name ?>
                            </div>
                        </a>
                    </div>
                    <? endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>