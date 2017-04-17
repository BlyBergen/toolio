<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Logout'), ['action' => 'logout']) ?></li>
        <li><?= $this->Html->link(__('New Listing'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Ratings'), ['controller' => 'Ratings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Rating'), ['controller' => 'Ratings', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="listings index large-9 medium-8 columns content">
    <h3><?= __('My Listings') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('category') ?></th>
                <th scope="col"><?= $this->Paginator->sort('city') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rating') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listings as $listing): ?>
            <tr>
                <td><?= h($listing->title) ?></td>
                <td><?= h($listing->category) ?></td>
                <td><?= h($listing->city) ?></td>
                <td>$<?= $this->Number->format($listing->price) ?>/<?= h($listing->time_unit) ?></td>
                <td><?= $this->Number->format($listing->rating) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $listing->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $listing->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $listing->id], ['confirm' => __('Are you sure you want to delete # {0}?', $listing->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h3><?= __('Saved Listings') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('category') ?></th>
                <th scope="col"><?= $this->Paginator->sort('city') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rating') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($favorites as $favorite): ?>
            <tr>
                <!-- <td><?= $this->Number->format($favorite->id) ?></td> -->
                <td><?= h($favorite->title) ?></td>
                <td><?= h($favorite->category) ?></td>
                <td><?= h($favorite->city) ?></td>
                <td>$<?= $this->Number->format($favorite->price) ?>/<?= h($listing->time_unit) ?></td>
                <td><?= $this->Number->format($favorite->rating) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $listing->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $listing->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $listing->id], ['confirm' => __('Are you sure you want to delete # {0}?', $listing->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
