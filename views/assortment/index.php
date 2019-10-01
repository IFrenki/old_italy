<?php

use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Асортимент';
?>
<div id="assortment">
<?php Pjax::begin(); ?>
        <div class="side_filter">
            <span class="filter-toggle">Скрыть фильтры</span>
            <?php echo $this->render('_search', ['model' => $searchModel]) ?>
        </div>

        <?php if (!empty($user_query)): ?>
            <h2 id="search_title">Поиск по запросу <span>«<?= $user_query ?>»</span></h2>
        <?php endif; ?>

        <?= ListView::widget([
            'dataProvider' => $products,
            'itemOptions' => ['class' => 'product'],
            'itemView' => '_products',
            'layout' => "{summary}<div class='list_products'>{items}</div>\n{pager}",
            'summary' => '<span class="assortment-summary">{totalCount} товаров</span>',
            'pager' => [
                'nextPageLabel' => 'Следующая',
                'prevPageLabel' => 'Предыдущая',
                'maxButtonCount' => 3,
            ],
        ]) ?>
<?php Pjax::end(); ?>
</div>

