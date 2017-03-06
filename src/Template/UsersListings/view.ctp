<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Users Listing'), ['action' => 'edit', $usersListing->users_listing_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Users Listing'), ['action' => 'delete', $usersListing->users_listing_id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersListing->users_listing_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users Listings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Users Listing'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users Listings'), ['controller' => 'UsersListings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Users Listing'), ['controller' => 'UsersListings', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Listings'), ['controller' => 'Listings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Listing'), ['controller' => 'Listings', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="usersListings view large-9 medium-8 columns content">
    <h3><?= h($usersListing->users_listing_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Users Listing') ?></th>
            <td><?= $usersListing->has('users_listing') ? $this->Html->link($usersListing->users_listing->users_listing_id, ['controller' => 'UsersListings', 'action' => 'view', $usersListing->users_listing->users_listing_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $usersListing->has('user') ? $this->Html->link($usersListing->user->name, ['controller' => 'Users', 'action' => 'view', $usersListing->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Listing') ?></th>
            <td><?= $usersListing->has('listing') ? $this->Html->link($usersListing->listing->title, ['controller' => 'Listings', 'action' => 'view', $usersListing->listing->id]) : '' ?></td>
        </tr>
    </table>
</div>
