<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use common\models\BlogModel;
use common\models\CategoryModel;

/* @var $this yii\web\View */
/* @var $model common\models\BlogModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'is_delete')->dropDownList( BlogModel::dropDownList('is_delete') ) ?>

    <?= $form->field($model, 'category')->label('栏目')->checkboxList(CategoryModel::dropDownList()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
