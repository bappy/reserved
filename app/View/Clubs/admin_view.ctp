<div class="clubs view">
    <h2><?php echo __('Club');?></h2>
    <dl><?php $i = 0; $class = ' class="altrow"';?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $club['Club']['id']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('User'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $this->Html->link($club['User']['email_address'], array('controller' => 'users', 'action' => 'view', $club['User']['id'])); ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Club Name'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $club['Club']['club_name']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Club Type'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $this->Html->link($club['ClubType']['type_name'], array('controller' => 'club_types', 'action' => 'view', $club['ClubType']['id'])); ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Short Description'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $club['Club']['short_description']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Create Date'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $club['Club']['create_date']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Address'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $club['Club']['address']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Latitude'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $club['Club']['latitude']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Longitude'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $club['Club']['longitude']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Approve Auto Purchase'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $club['Club']['approve_auto_purchase']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Status'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $club['Club']['status']; ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Edit Club'), array('action' => 'edit', $club['Club']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__('Delete Club'), array('action' => 'delete', $club['Club']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $club['Club']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__('List Clubs'), array('action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Club'), array('action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Club Types'), array('controller' => 'club_types', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Club Type'), array('controller' => 'club_types', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Bookings'), array('controller' => 'bookings', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Booking'), array('controller' => 'bookings', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Club Bottles'), array('controller' => 'club_bottles', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Club Bottle'), array('controller' => 'club_bottles', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Club Exceptions'), array('controller' => 'club_exceptions', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Club Exception'), array('controller' => 'club_exceptions', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Club Open Days'), array('controller' => 'club_open_days', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Club Open Day'), array('controller' => 'club_open_days', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Club Tables'), array('controller' => 'club_tables', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Club Table'), array('controller' => 'club_tables', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Deals'), array('controller' => 'deals', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Deal'), array('controller' => 'deals', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Photos'), array('controller' => 'photos', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Photo'), array('controller' => 'photos', 'action' => 'add')); ?> </li>
    </ul>
</div>
<div class="related">
    <h3><?php echo __('Related Bookings');?></h3>
    <?php if (!empty($club['Booking'])): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo __('Id'); ?></th>
            <th><?php echo __('User Id'); ?></th>
            <th><?php echo __('Club Id'); ?></th>
            <th><?php echo __('Club Table Id'); ?></th>
            <th><?php echo __('Guys'); ?></th>
            <th><?php echo __('Girls'); ?></th>
            <th><?php echo __('Arrival Time'); ?></th>
            <th><?php echo __('Arrival Date'); ?></th>
            <th><?php echo __('Booking Price'); ?></th>
            <th><?php echo __('Booking Method'); ?></th>
            <th><?php echo __('Booking Time'); ?></th>
            <th><?php echo __('Status'); ?></th>
            <th><?php echo __('Client Name'); ?></th>
            <th><?php echo __('Client Phone'); ?></th>
            <th class="actions"><?php echo __('Actions');?></th>
        </tr>
        <?php
        $i = 0;
        foreach ($club['Booking'] as $booking):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
            ?>
            <tr<?php echo $class;?>>
                <td><?php echo $booking['id'];?></td>
                <td><?php echo $booking['user_id'];?></td>
                <td><?php echo $booking['club_id'];?></td>
                <td><?php echo $booking['club_table_id'];?></td>
                <td><?php echo $booking['guys'];?></td>
                <td><?php echo $booking['girls'];?></td>
                <td><?php echo $booking['arrival_time'];?></td>
                <td><?php echo $booking['arrival_date'];?></td>
                <td><?php echo $booking['booking_price'];?></td>
                <td><?php echo $booking['booking_method'];?></td>
                <td><?php echo $booking['booking_time'];?></td>
                <td><?php echo $booking['status'];?></td>
                <td><?php echo $booking['client_name'];?></td>
                <td><?php echo $booking['client_phone'];?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('controller' => 'bookings', 'action' => 'view', $booking['id'])); ?>
                    <?php echo $this->Html->link(__('Edit'), array('controller' => 'bookings', 'action' => 'edit', $booking['id'])); ?>
                    <?php echo $this->Html->link(__('Delete'), array('controller' => 'bookings', 'action' => 'delete', $booking['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $booking['id'])); ?>
                </td>
            </tr>
            <?php endforeach; ?>
    </table>
    <?php endif; ?>

    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('New Booking'), array('controller' => 'bookings', 'action' => 'add'));?> </li>
        </ul>
    </div>
</div>
<div class="related">
    <h3><?php echo __('Related Club Bottles');?></h3>
    <?php if (!empty($club['ClubBottle'])): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo __('Id'); ?></th>
            <th><?php echo __('User Id'); ?></th>
            <th><?php echo __('Club Id'); ?></th>
            <th><?php echo __('Category Id'); ?></th>
            <th><?php echo __('Bottle Name'); ?></th>
            <th><?php echo __('Bottle Price'); ?></th>
            <th><?php echo __('Upsell'); ?></th>
            <th><?php echo __('Upsell Type'); ?></th>
            <th><?php echo __('Status'); ?></th>
            <th class="actions"><?php echo __('Actions');?></th>
        </tr>
        <?php
        $i = 0;
        foreach ($club['ClubBottle'] as $clubBottle):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
            ?>
            <tr<?php echo $class;?>>
                <td><?php echo $clubBottle['id'];?></td>
                <td><?php echo $clubBottle['user_id'];?></td>
                <td><?php echo $clubBottle['club_id'];?></td>
                <td><?php echo $clubBottle['category_id'];?></td>
                <td><?php echo $clubBottle['bottle_name'];?></td>
                <td><?php echo $clubBottle['bottle_price'];?></td>
                <td><?php echo $clubBottle['upsell'];?></td>
                <td><?php echo $clubBottle['upsell_type'];?></td>
                <td><?php echo $clubBottle['status'];?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('controller' => 'club_bottles', 'action' => 'view', $clubBottle['id'])); ?>
                    <?php echo $this->Html->link(__('Edit'), array('controller' => 'club_bottles', 'action' => 'edit', $clubBottle['id'])); ?>
                    <?php echo $this->Html->link(__('Delete'), array('controller' => 'club_bottles', 'action' => 'delete', $clubBottle['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $clubBottle['id'])); ?>
                </td>
            </tr>
            <?php endforeach; ?>
    </table>
    <?php endif; ?>

    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('New Club Bottle'), array('controller' => 'club_bottles', 'action' => 'add'));?> </li>
        </ul>
    </div>
</div>
<div class="related">
    <h3><?php echo __('Related Club Exceptions');?></h3>
    <?php if (!empty($club['ClubException'])): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo __('Id'); ?></th>
            <th><?php echo __('Club Id'); ?></th>
            <th><?php echo __('Exception Date'); ?></th>
            <th><?php echo __('Exception Name'); ?></th>
            <th><?php echo __('Open Time'); ?></th>
            <th><?php echo __('Close Time'); ?></th>
            <th><?php echo __('Status'); ?></th>
            <th class="actions"><?php echo __('Actions');?></th>
        </tr>
        <?php
        $i = 0;
        foreach ($club['ClubException'] as $clubException):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
            ?>
            <tr<?php echo $class;?>>
                <td><?php echo $clubException['id'];?></td>
                <td><?php echo $clubException['club_id'];?></td>
                <td><?php echo $clubException['exception_date'];?></td>
                <td><?php echo $clubException['exception_name'];?></td>
                <td><?php echo $clubException['open_time'];?></td>
                <td><?php echo $clubException['close_time'];?></td>
                <td><?php echo $clubException['status'];?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('controller' => 'club_exceptions', 'action' => 'view', $clubException['id'])); ?>
                    <?php echo $this->Html->link(__('Edit'), array('controller' => 'club_exceptions', 'action' => 'edit', $clubException['id'])); ?>
                    <?php echo $this->Html->link(__('Delete'), array('controller' => 'club_exceptions', 'action' => 'delete', $clubException['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $clubException['id'])); ?>
                </td>
            </tr>
            <?php endforeach; ?>
    </table>
    <?php endif; ?>

    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('New Club Exception'), array('controller' => 'club_exceptions', 'action' => 'add'));?> </li>
        </ul>
    </div>
</div>
<div class="related">
    <h3><?php echo __('Related Club Open Days');?></h3>
    <?php if (!empty($club['ClubOpenDay'])): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo __('Id'); ?></th>
            <th><?php echo __('Club Id'); ?></th>
            <th><?php echo __('Days'); ?></th>
            <th><?php echo __('Open Time'); ?></th>
            <th><?php echo __('Close Time'); ?></th>
            <th><?php echo __('Status'); ?></th>
            <th class="actions"><?php echo __('Actions');?></th>
        </tr>
        <?php
        $i = 0;
        foreach ($club['ClubOpenDay'] as $clubOpenDay):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
            ?>
            <tr<?php echo $class;?>>
                <td><?php echo $clubOpenDay['id'];?></td>
                <td><?php echo $clubOpenDay['club_id'];?></td>
                <td><?php echo $clubOpenDay['days'];?></td>
                <td><?php echo $clubOpenDay['open_time'];?></td>
                <td><?php echo $clubOpenDay['close_time'];?></td>
                <td><?php echo $clubOpenDay['status'];?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('controller' => 'club_open_days', 'action' => 'view', $clubOpenDay['id'])); ?>
                    <?php echo $this->Html->link(__('Edit'), array('controller' => 'club_open_days', 'action' => 'edit', $clubOpenDay['id'])); ?>
                    <?php echo $this->Html->link(__('Delete'), array('controller' => 'club_open_days', 'action' => 'delete', $clubOpenDay['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $clubOpenDay['id'])); ?>
                </td>
            </tr>
            <?php endforeach; ?>
    </table>
    <?php endif; ?>

    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('New Club Open Day'), array('controller' => 'club_open_days', 'action' => 'add'));?> </li>
        </ul>
    </div>
</div>
<div class="related">
    <h3><?php echo __('Related Club Tables');?></h3>
    <?php if (!empty($club['ClubTable'])): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo __('Id'); ?></th>
            <th><?php echo __('User Id'); ?></th>
            <th><?php echo __('Club Id'); ?></th>
            <th><?php echo __('Table Name'); ?></th>
            <th><?php echo __('Category Id'); ?></th>
            <th><?php echo __('Minimum Price'); ?></th>
            <th><?php echo __('Table Min Guy'); ?></th>
            <th><?php echo __('Table Min Girls'); ?></th>
            <th><?php echo __('Max Guys1'); ?></th>
            <th><?php echo __('Max Guys1 Price'); ?></th>
            <th><?php echo __('Max Guys2'); ?></th>
            <th><?php echo __('Max Guys2 Price'); ?></th>
            <th><?php echo __('Create Date'); ?></th>
            <th><?php echo __('Status'); ?></th>
            <th class="actions"><?php echo __('Actions');?></th>
        </tr>
        <?php
        $i = 0;
        foreach ($club['ClubTable'] as $clubTable):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
            ?>
            <tr<?php echo $class;?>>
                <td><?php echo $clubTable['id'];?></td>
                <td><?php echo $clubTable['user_id'];?></td>
                <td><?php echo $clubTable['club_id'];?></td>
                <td><?php echo $clubTable['table_name'];?></td>
                <td><?php echo $clubTable['category_id'];?></td>
                <td><?php echo $clubTable['minimum_price'];?></td>
                <td><?php echo $clubTable['table_min_guy'];?></td>
                <td><?php echo $clubTable['table_min_girls'];?></td>
                <td><?php echo $clubTable['max_guys1'];?></td>
                <td><?php echo $clubTable['max_guys1_price'];?></td>
                <td><?php echo $clubTable['max_guys2'];?></td>
                <td><?php echo $clubTable['max_guys2_price'];?></td>
                <td><?php echo $clubTable['create_date'];?></td>
                <td><?php echo $clubTable['status'];?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('controller' => 'club_tables', 'action' => 'view', $clubTable['id'])); ?>
                    <?php echo $this->Html->link(__('Edit'), array('controller' => 'club_tables', 'action' => 'edit', $clubTable['id'])); ?>
                    <?php echo $this->Html->link(__('Delete'), array('controller' => 'club_tables', 'action' => 'delete', $clubTable['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $clubTable['id'])); ?>
                </td>
            </tr>
            <?php endforeach; ?>
    </table>
    <?php endif; ?>

    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('New Club Table'), array('controller' => 'club_tables', 'action' => 'add'));?> </li>
        </ul>
    </div>
</div>
<div class="related">
    <h3><?php echo __('Related Deals');?></h3>
    <?php if (!empty($club['Deal'])): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo __('Id'); ?></th>
            <th><?php echo __('Club Id'); ?></th>
            <th><?php echo __('Club Table Id'); ?></th>
            <th><?php echo __('Deal Amount'); ?></th>
            <th><?php echo __('Deal Now'); ?></th>
            <th><?php echo __('Deal Date'); ?></th>
            <th><?php echo __('Recur'); ?></th>
            <th><?php echo __('Status'); ?></th>
            <th class="actions"><?php echo __('Actions');?></th>
        </tr>
        <?php
        $i = 0;
        foreach ($club['Deal'] as $deal):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
            ?>
            <tr<?php echo $class;?>>
                <td><?php echo $deal['id'];?></td>
                <td><?php echo $deal['club_id'];?></td>
                <td><?php echo $deal['club_table_id'];?></td>
                <td><?php echo $deal['deal_amount'];?></td>
                <td><?php echo $deal['deal_now'];?></td>
                <td><?php echo $deal['deal_date'];?></td>
                <td><?php echo $deal['recur'];?></td>
                <td><?php echo $deal['status'];?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('controller' => 'deals', 'action' => 'view', $deal['id'])); ?>
                    <?php echo $this->Html->link(__('Edit'), array('controller' => 'deals', 'action' => 'edit', $deal['id'])); ?>
                    <?php echo $this->Html->link(__('Delete'), array('controller' => 'deals', 'action' => 'delete', $deal['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $deal['id'])); ?>
                </td>
            </tr>
            <?php endforeach; ?>
    </table>
    <?php endif; ?>

    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('New Deal'), array('controller' => 'deals', 'action' => 'add'));?> </li>
        </ul>
    </div>
</div>
<div class="related">
    <h3><?php echo __('Related Events');?></h3>
    <?php if (!empty($club['Event'])): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo __('Id'); ?></th>
            <th><?php echo __('Club Id'); ?></th>
            <th><?php echo __('Category Id'); ?></th>
            <th><?php echo __('Performer'); ?></th>
            <th><?php echo __('Price Multiplier'); ?></th>
            <th><?php echo __('Recur Week'); ?></th>
            <th><?php echo __('Event Date'); ?></th>
            <th class="actions"><?php echo __('Actions');?></th>
        </tr>
        <?php
        $i = 0;
        foreach ($club['Event'] as $event):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
            ?>
            <tr<?php echo $class;?>>
                <td><?php echo $event['id'];?></td>
                <td><?php echo $event['club_id'];?></td>
                <td><?php echo $event['category_id'];?></td>
                <td><?php echo $event['performer'];?></td>
                <td><?php echo $event['price_multiplier'];?></td>
                <td><?php echo $event['recur_week'];?></td>
                <td><?php echo $event['event_date'];?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('controller' => 'events', 'action' => 'view', $event['id'])); ?>
                    <?php echo $this->Html->link(__('Edit'), array('controller' => 'events', 'action' => 'edit', $event['id'])); ?>
                    <?php echo $this->Html->link(__('Delete'), array('controller' => 'events', 'action' => 'delete', $event['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $event['id'])); ?>
                </td>
            </tr>
            <?php endforeach; ?>
    </table>
    <?php endif; ?>

    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add'));?> </li>
        </ul>
    </div>
</div>
<div class="related">
    <h3><?php echo __('Related Photos');?></h3>
    <?php if (!empty($club['Photo'])): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo __('Id'); ?></th>
            <th><?php echo __('User Id'); ?></th>
            <th><?php echo __('Club Id'); ?></th>
            <th><?php echo __('Photos'); ?></th>
            <th><?php echo __('Photo Type'); ?></th>
            <th><?php echo __('Profile Picture'); ?></th>
            <th class="actions"><?php echo __('Actions');?></th>
        </tr>
        <?php
        $i = 0;
        foreach ($club['Photo'] as $photo):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
            ?>
            <tr<?php echo $class;?>>
                <td><?php echo $photo['id'];?></td>
                <td><?php echo $photo['user_id'];?></td>
                <td><?php echo $photo['club_id'];?></td>
                <td><?php echo $photo['photos'];?></td>
                <td><?php echo $photo['photo_type'];?></td>
                <td><?php echo $photo['profile_picture'];?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('controller' => 'photos', 'action' => 'view', $photo['id'])); ?>
                    <?php echo $this->Html->link(__('Edit'), array('controller' => 'photos', 'action' => 'edit', $photo['id'])); ?>
                    <?php echo $this->Html->link(__('Delete'), array('controller' => 'photos', 'action' => 'delete', $photo['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $photo['id'])); ?>
                </td>
            </tr>
            <?php endforeach; ?>
    </table>
    <?php endif; ?>

    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('New Photo'), array('controller' => 'photos', 'action' => 'add'));?> </li>
        </ul>
    </div>
</div>
