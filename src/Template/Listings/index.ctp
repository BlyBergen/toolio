<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Listing'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Ratings'), ['controller' => 'Ratings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Rating'), ['controller' => 'Ratings', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="listings index large-9 medium-8 columns content">
    <h3><?= __('Listings') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('category') ?></th>
                <th scope="col"><?= $this->Paginator->sort('add1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('add2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('city') ?></th>
                <th scope="col"><?= $this->Paginator->sort('state') ?></th>
                <th scope="col"><?= $this->Paginator->sort('zipcode') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('time_unit') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rating') ?></th>
                <th scope="col"><?= $this->Paginator->sort('photo_url') ?></th>
                <th scope="col"><?= $this->Paginator->sort('contact') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_workshop') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pickup_onsite') ?></th>
                <th scope="col"><?= $this->Paginator->sort('saved') ?></th>
                <th scope="col"><?= $this->Paginator->sort('views') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listings as $listing): ?>
            <tr>
                <td><?= $this->Number->format($listing->id) ?></td>
                <td><?= h($listing->title) ?></td>
                <td><?= h($listing->category) ?></td>
                <td><?= h($listing->add1) ?></td>
                <td><?= h($listing->add2) ?></td>
                <td><?= h($listing->city) ?></td>
                <td><?= h($listing->state) ?></td>
                <td><?= $this->Number->format($listing->zipcode) ?></td>
                <td><?= $this->Number->format($listing->price) ?></td>
                <td><?= h($listing->time_unit) ?></td>
                <td><?= $this->Number->format($listing->rating) ?></td>
                <td><?= h($listing->photo_url) ?></td>
                <td><?= h($listing->contact) ?></td>
                <td><?= h($listing->item_workshop) ?></td>
                <td><?= h($listing->pickup_onsite) ?></td>
                <td><?= $this->Number->format($listing->saved) ?></td>
                <td><?= $this->Number->format($listing->views) ?></td>
                <td><?= $this->Number->format($listing->user_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $listing->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $listing->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $listing->id], ['confirm' => __('Are you sure you want to delete # {0}?', $listing->id)]) ?>
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
