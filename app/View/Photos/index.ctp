<div class="photos index">
    <h2><?php echo __('Photos');?></h2>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('id');?></th>
            <th><?php echo $this->Paginator->sort('user_id');?></th>
            <th><?php echo $this->Paginator->sort('club_id');?></th>
            <th><?php echo $this->Paginator->sort('photos');?></th>
            <th><?php echo $this->Paginator->sort('photo_type');?></th>
            <th><?php echo $this->Paginator->sort('profile_picture');?></th>
            <th class="actions"><?php echo __('Actions');?></th>
        </tr>
        <?php
        $i = 0;
        foreach ($photos as $photo):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
            ?>
            <tr<?php echo $class;?>>
                <td><?php echo $photo['Photo']['id']; ?>&nbsp;</td>
                <td>
                    <?php echo $this->Html->link($photo['User']['email_address'], array('controller' => 'users', 'action' => 'view', $photo['User']['id'])); ?>
                </td>
                <td>
                    <?php echo $this->Html->link($photo['Club']['club_name'], array('controller' => 'clubs', 'action' => 'view', $photo['Club']['id'])); ?>
                </td>
                <td><?php echo $photo['Photo']['photos']; ?>&nbsp;</td>
                <td><?php echo $photo['Photo']['photo_type']; ?>&nbsp;</td>
                <td><?php echo $photo['Photo']['profile_picture']; ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $photo['Photo']['id'])); ?>
                    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $photo['Photo']['id'])); ?>
                    <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $photo['Photo']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $photo['Photo']['id'])); ?>
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
        <li><?php echo $this->Html->link(__('New Photo'), array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Clubs'), array('controller' => 'clubs', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Club'), array('controller' => 'clubs', 'action' => 'add')); ?> </li>
    </ul>
</div>