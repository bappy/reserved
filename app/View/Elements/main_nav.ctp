<div class="actions">	
    <ul>
        <li><a>Reserved</a></li>
        <li><?php echo $this->Html->link(__('Earnings'), array('controller' => 'users', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('Reservations'), array('controller' => 'users', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('Orders'), array('controller' => 'club_types', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('Menu & Pricing'), array('controller' => 'club_types', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('Night Details'), array('controller' => 'bookings', 'action' => 'index')); ?> </li>
        <li>
            <?php
            if ($selected_nav == "club") {
                echo $this->Html->link(__('Club Settings'), array('controller' => 'clubs', 'action' => 'index'), array('class' => 'active'));
            } else {
                echo $this->Html->link(__('Club Settings'), array('controller' => 'clubs', 'action' => 'index'));
            }
            ?> </li>
            <?php if ($this->Session->read('Auth.User.id')) : ?>
            <li><?php echo $this->Html->link(__d('users', 'Logout'), array('action' => 'logout')); ?>
            <li><?php echo $this->Html->link(__d('users', 'My Account'), array('action' => 'edit')); ?>
            <li><?php echo $this->Html->link(__d('users', 'Change password'), array('action' => 'change_password')); ?>
            <?php endif ?>

    </ul>
</div>