<?php echo $this->element('main_nav', array('selected_nav' => 'club')); ?>
<?php echo $this->element('Clubs/sidebar'); ?>

<div class="clubs index">
    <h2><?php echo __('Clubs');?></h2>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('id');?></th>
            <th><?php echo $this->Paginator->sort('user_id');?></th>
            <th><?php echo $this->Paginator->sort('club_name');?></th>
            <th><?php echo $this->Paginator->sort('club_type_id');?></th>
            <th><?php echo $this->Paginator->sort('short_description');?></th>
            <th><?php echo $this->Paginator->sort('create_date');?></th>
            <th><?php echo $this->Paginator->sort('address');?></th>
            <th><?php echo $this->Paginator->sort('latitude');?></th>
            <th><?php echo $this->Paginator->sort('longitude');?></th>
            <th><?php echo $this->Paginator->sort('approve_auto_purchase');?></th>
            <th><?php echo $this->Paginator->sort('status');?></th>
            <th class="actions"><?php echo __('Actions');?></th>
        </tr>
        <?php
        $i = 0;
        foreach ($clubs as $club):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
            ?>
            <tr<?php echo $class;?>>
                <td><?php echo $club['Club']['id']; ?>&nbsp;</td>
                <td>
                    <?php echo $this->Html->link($club['User']['email_address'], array('controller' => 'users', 'action' => 'view', $club['User']['id'])); ?>
                </td>
                <td><?php echo $club['Club']['club_name']; ?>&nbsp;</td>
                <td>
                    <?php echo $this->Html->link($club['ClubType']['type_name'], array('controller' => 'club_types', 'action' => 'view', $club['ClubType']['id'])); ?>
                </td>
                <td><?php echo $club['Club']['short_description']; ?>&nbsp;</td>
                <td><?php echo $club['Club']['create_date']; ?>&nbsp;</td>
                <td><?php echo $club['Club']['address']; ?>&nbsp;</td>
                <td><?php echo $club['Club']['latitude']; ?>&nbsp;</td>
                <td><?php echo $club['Club']['longitude']; ?>&nbsp;</td>
                <td><?php echo $club['Club']['approve_auto_purchase']; ?>&nbsp;</td>
                <td><?php echo $club['Club']['status']; ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $club['Club']['id'])); ?>
                    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $club['Club']['id'])); ?>
                    <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $club['Club']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $club['Club']['id'])); ?>
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
