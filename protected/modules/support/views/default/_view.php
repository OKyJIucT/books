<div class="mail-item <?= Y::ticketStatus($data); ?>">
    <a href="<?= Y::url('/support/default/view', array('id' => $data->id)); ?>"
       class="mail-text"><?= $data->name; ?></a>

    <div class="mail-date"><?= date('d M Y, H:i', $data->last_update); ?></div>
</div> 