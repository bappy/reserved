<div class="clubExceptions index">
    <h2><?php echo __('Club Exceptions');?></h2>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('id');?></th>
            <th><?php echo $this->Paginator->sort('club_id');?></th>
            <th><?php echo $this->Paginator->sort('exception_date');?></th>
            <th><?php echo $this->Paginator->sort('exception_name');?></th>
            <th><?php echo $this->Paginator->sort('open_time');?></th>
            <th><?php echo $this->Paginator->sort('close_time');?></th>
            <th><?php echo $this->Paginator->sort('status');?></th>
            <th class="actions"><?php echo __('Actions');?></th>
        </tr>
        <?php
        $i = 0;
        foreach ($clubExceptions as $clubException):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
            ?>
            <tr<?php echo $class;?>>
                <td><?php echo $clubException['ClubException']['id']; ?>&nbsp;</td>
                <td>
                    <?php echo $this->Html->link($clubException['Club']['club_name'], array('controller' => 'clubs', 'action' => 'view', $clubException['Club']['id'])); ?>
                </td>
                <td><?php echo $clubException['ClubException']['exception_date']; ?>&nbsp;</td>
                <td><?php echo $clubException['ClubException']['exception_name']; ?>&nbsp;</td>
                <td><?php echo $clubException['ClubException']['open_time']; ?>&nbsp;</td>
                <td><?php echo $clubException['ClubException']['close_time']; ?>&nbsp;</td>
                <td><?php echo $clubException['ClubException']['status']; ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $clubException['ClubException']['id'])); ?>
                    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $clubException['ClubException']['id'])); ?>
                    <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $clubException['ClubException']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $clubException['ClubException']['id'])); ?>
                </td>
            </tr>
            <?php endforeach; ?>
    </table>
    <p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
        ));
        ?>    </p>

    <div class="paging">
        <?php echo $this->Paginator->prev('<< ' . __('previous'), array(), null, array('class' => 'disabled'));?>
        |     <?php echo $this->Paginator->numbers();?>
        |
        <?php echo $this->Paginator->next(__('next') . ' >>', array(), null, array('class' => 'disabled'));?>
    </div>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('New Club Exception'), array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__('List Clubs'), array('controller' => 'clubs', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Club'), array('controller' => 'clubs', 'action' => 'add')); ?> </li>
    </ul>
</div>