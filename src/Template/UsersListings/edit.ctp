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
                ['action' => 'delete', $usersListing->users_listing_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $usersListing->users_listing_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Users Listings'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users Listings'), ['controller' => 'UsersListings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Users Listing'), ['controller' => 'UsersListings', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Listings'), ['controller' => 'Listings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Listing'), ['controller' => 'Listings', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="usersListings form large-9 medium-8 columns content">
    <?= $this->Form->create($usersListing) ?>
    <fieldset>
        <legend><?= __('Edit Users Listing') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('listing_id', ['options' => $listings]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
