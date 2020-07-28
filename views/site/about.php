<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\components\helper;
use yii\helpers\Url;

//** Judul page */
$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="about">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        //** menerima data dari controller/siteController.php */
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            //** Menampilkan Post id */
            'post_id',
            //** Menapilkan Judul */
            'post_title',
            //** */
            // 'image_url',
            //!!
            [
                'attribute'=>'image_url',
                'format'=>'html',
                'value'=>function($data)
                {
                    return Html::img($data['image_url'],
                    ['width' => '80px']);
                }
            ],
            //!!
            //** Menapilkan Content */
            [
                'attribute'=>'post_content',
                'format'=>'html',
                'value'=>function($data)
                {
                    return strip_tags($data['post_content']);
                    // return helper::wpCall();
                }
            ],
            //** menampilkan link yang website */
            'link',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);

    ?>
</div>