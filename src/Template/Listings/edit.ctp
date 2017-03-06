<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $listing->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $listing->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Listings'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Ratings'), ['controller' => 'Ratings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Rating'), ['controller' => 'Ratings', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="listings form large-9 medium-8 columns content">
    <?= $this->Form->create($listing) ?>
    <fieldset>
        <legend><?= __('Edit Listing') ?></legend>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('category');
            echo $this->Form->input('description');
            echo $this->Form->input('add1');
            echo $this->Form->input('add2');
            echo $this->Form->input('city');
            echo $this->Form->input('state');
            echo $this->Form->input('zipcode');
            echo $this->Form->input('price');
            echo $this->Form->input('time_unit');
            echo $this->Form->input('rating');
            echo $this->Form->input('photo_url');
            echo $this->Form->input('contact');
            echo $this->Form->input('item_workshop');
            echo $this->Form->input('pickup_onsite');
            echo $this->Form->input('saved');
            echo $this->Form->input('views');
            echo $this->Form->input('user_id');
            echo $this->Form->input('users._ids', ['options' => $users]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
