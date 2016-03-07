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
        <?php
        $club['User']['email_address'] = $this->requestAction('/Users/Information/' . $club['Club']['user_id']);


        ?>
    </td>
    <td><?php echo $club['Club']['club_name']; ?>&nbsp;</td>
    <td>
        <?php
        $value = $this->requestAction('/ClubTypes/Information/' . $club['Club']['club_type_id']);
        $club['ClubType']['type_name'] = $value["type_name"];
        $club['ClubType']['id'] = $value["id"];
        echo $this->Html->link($club['ClubType']['type_name'], array('controller' => 'club_types', 'action' => 'view', $club['ClubType']['id'])); ?>
    </td>
    <td><?php echo $club['Club']['short_description']; ?>&nbsp;</td>
    <td><?php echo $club['Club']['create_date']; ?>&nbsp;</td>
    <td><?php echo $club['Club']['address']; ?>&nbsp;</td>
    <td><?php echo $club['Club']['latitude']; ?>&nbsp;</td>
    <td><?php echo $club['Club']['longitude']; ?>&nbsp;</td>
    <td><?php echo $club['Club']['approve_auto_purchase']; ?>&nbsp;</td>
    <td><?php echo $club['Club']['status']; ?>&nbsp;</td>

</tr>

<td class="actions">
    <?php echo $this->Html->link(__('View'), array('action' => 'view', $club['Club']['id'])); ?>
    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $club['Club']['id'])); ?>
    <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $club['Club']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $club['Club']['id'])); ?>
</td>
</tr>
<?php endforeach;

echo "<p>";


foreach ($photos as $photo):

    ?>
<tr>
    <td><?php echo $this->Html->image('profile/' . $photo["Photo"]["photos"], array('width' => '80', 'height' => '
'));//$photo['Photo']['photo_type']; ?>&nbsp;</td>
    <td>
</tr><?php echo $photo['Photo']['profile_picture']; ?>&nbsp;</td>
<?php endforeach; ?>
</table>