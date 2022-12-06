
<h1>Create an account</h1>

<hr>

<?php $form = \App\form\Form::start('', 'post') ?>

  <div class="row">

    <?= $form->field($model, 'firstName') ?>

    <?= $form->field($model, 'lastName') ?>

  </div>

  <?= $form->field($model, 'email') ?>
  
  <?= $form->field($model, 'password')->passwordField() ?>
  
  <?= $form->field($model, 'confirmPassword')->passwordField() ?>

  <button type="submit" class="btn btn-primary">Submit</button>

<?php \App\form\Form::end() ?>

