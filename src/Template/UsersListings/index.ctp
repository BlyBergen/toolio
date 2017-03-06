<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Users Listing'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Listings'), ['controller' => 'Listings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Listing'), ['controller' => 'Listings', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="usersListings index large-9 medium-8 columns content">
    <h3><?= __('Users Listings') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('users_listing_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('listing_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usersListings as $usersListing): ?>
            <tr>
                <td><?= $usersListing->has('users_listing') ? $this->Html->link($usersListing->users_listing->users_listing_id, ['controller' => 'UsersListings', 'action' => 'view', $usersListing->users_listing->users_listing_id]) : '' ?></td>
                <td><?= $usersListing->has('user') ? $this->Html->link($usersListing->user->name, ['controller' => 'Users', 'action' => 'view', $usersListing->user->id]) : '' ?></td>
                <td><?= $usersListing->has('listing') ? $this->Html->link($usersListing->listing->title, ['controller' => 'Listings', 'action' => 'view', $usersListing->listing->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $usersListing->users_listing_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $usersListing->users_listing_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $usersListing->users_listing_id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersListing->users_listing_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
