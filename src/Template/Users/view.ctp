<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Ratings'), ['controller' => 'Ratings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Rating'), ['controller' => 'Ratings', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Listings'), ['controller' => 'Listings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Listing'), ['controller' => 'Listings', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($user->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Zipcode') ?></th>
            <td><?= $this->Number->format($user->zipcode) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Ratings') ?></h4>
        <?php if (!empty($user->ratings)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Rating') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Listing Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->ratings as $ratings): ?>
            <tr>
                <td><?= h($ratings->id) ?></td>
                <td><?= h($ratings->title) ?></td>
                <td><?= h($ratings->description) ?></td>
                <td><?= h($ratings->rating) ?></td>
                <td><?= h($ratings->user_id) ?></td>
                <td><?= h($ratings->listing_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Ratings', 'action' => 'view', $ratings->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Ratings', 'action' => 'edit', $ratings->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Ratings', 'action' => 'delete', $ratings->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ratings->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Listings') ?></h4>
        <?php if (!empty($user->listings)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Category') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Add1') ?></th>
                <th scope="col"><?= __('Add2') ?></th>
                <th scope="col"><?= __('City') ?></th>
                <th scope="col"><?= __('State') ?></th>
                <th scope="col"><?= __('Zipcode') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Time Unit') ?></th>
                <th scope="col"><?= __('Rating') ?></th>
                <th scope="col"><?= __('Photo Url') ?></th>
                <th scope="col"><?= __('Contact') ?></th>
                <th scope="col"><?= __('Item Workshop') ?></th>
                <th scope="col"><?= __('Pickup Onsite') ?></th>
                <th scope="col"><?= __('Saved') ?></th>
                <th scope="col"><?= __('Views') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->listings as $listings): ?>
            <tr>
                <td><?= h($listings->id) ?></td>
                <td><?= h($listings->title) ?></td>
                <td><?= h($listings->category) ?></td>
                <td><?= h($listings->description) ?></td>
                <td><?= h($listings->add1) ?></td>
                <td><?= h($listings->add2) ?></td>
                <td><?= h($listings->city) ?></td>
                <td><?= h($listings->state) ?></td>
                <td><?= h($listings->zipcode) ?></td>
                <td><?= h($listings->price) ?></td>
                <td><?= h($listings->time_unit) ?></td>
                <td><?= h($listings->rating) ?></td>
                <td><?= h($listings->photo_url) ?></td>
                <td><?= h($listings->contact) ?></td>
                <td><?= h($listings->item_workshop) ?></td>
                <td><?= h($listings->pickup_onsite) ?></td>
                <td><?= h($listings->saved) ?></td>
                <td><?= h($listings->views) ?></td>
                <td><?= h($listings->user_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Listings', 'action' => 'view', $listings->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Listings', 'action' => 'edit', $listings->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Listings', 'action' => 'delete', $listings->id], ['confirm' => __('Are you sure you want to delete # {0}?', $listings->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
