<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\TestModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="test-model-form">

    <?php $form = ActiveForm::begin([
	    'id' => 'test-backend-model-id',
	    'enableAjaxValidation' => true,
	    'validationUrl' => Url::toRoute(['validate-form']),
	]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
