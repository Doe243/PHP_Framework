<?

/** @var $model \App\models\User */

 ?>

<h1>Login</h1>

<hr>

<?php $form = \App\form\Form::start('', 'post') ?>


  <?= $form->field($model, 'email') ?>
  
  <?= $form->field($model, 'password')->passwordField() ?>

  <button type="submit" class="btn btn-primary">Submit</button>

<?php \App\form\Form::end() ?>


