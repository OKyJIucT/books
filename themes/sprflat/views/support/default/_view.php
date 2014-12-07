<tr>
    <td class="email-subject">
        <a href="<?= Y::url('/support/default/view', array('id' => $data->id)); ?>"><?= $data->name; ?></a>
    </td>
    <td class="email-date"><?= date('d M Y, H:i', $data->last_update); ?></td>
    <td class="email-intro">
        <?= Y::ticketStatus($data); ?>
    </td>
</tr>