<div class="clubExceptions view">
    <h2><?php echo __('Club Exception');?></h2>
    <dl><?php $i = 0; $class = ' class="altrow"';?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $clubException['ClubException']['id']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Club'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $this->Html->link($clubException['Club']['club_name'], array('controller' => 'clubs', 'action' => 'view', $clubException['Club']['id'])); ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Exception Date'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $clubException['ClubException']['exception_date']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Exception Name'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $clubException['ClubException']['exception_name']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Open Time'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $clubException['ClubException']['open_time']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Close Time'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $clubException['ClubException']['close_time']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Status'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $clubException['ClubException']['status']; ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Edit Club Exception'), array('action' => 'edit', $clubException['ClubException']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__('Delete Club Exception'), array('action' => 'delete', $clubException['ClubException']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $clubException['ClubException']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__('List Club Exceptions'), array('action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Club Exception'), array('action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Clubs'), array('controller' => 'clubs', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Club'), array('controller' => 'clubs', 'action' => 'add')); ?> </li>
    </ul>
</div>
