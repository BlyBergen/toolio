

<div class="card" style="width:400px; margin-left:auto; margin-right:auto;">
  <?= $this->Form->create() ?>
      <fieldset>
          <legend><?= __('Please Sign In') ?></legend>
          <?= $this->Form->input('email', ['label' => false, 'placeholder' => 'Email', 'class' => 'form-control']) ?>
          <?= $this->Form->input('password', ['label' => false, 'placeholder' => 'Password', 'class' => 'form-control']) ?>
      </fieldset>
      <!-- <?= $this->Flash->render('bad_login') ?> -->
          <?= $this->Form->button(__('Sign In'),['class' => "btn btn-lg btn-block"]); ?>
  <?= $this->Form->end() ?>
</div>
