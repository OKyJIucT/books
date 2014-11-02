<?php
$this->breadcrumbs = array(
    'Профиль ' . $profile->username,
);
?>

<div class="col-md-12">
    <div class="row">
        <div class="col-md-6">
            <h2>Данные профиля</h2>
        </div>
        <div class="col-md-6">
            <h2>Коды приглашений</h2>
            <?php
            if (isset($profile->invites)) :
                foreach ($profile->invites as $key => $invite) :
                    ?>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Код приглашения" value="<?= $invite->code; ?>" />
                            <span class="input-group-btn">
                                <button class="btn btn-default" id="element_<?= $key; ?>" data-clipboard-text="<?= $invite->code; ?>" type="button">Скопировать!</button>
                            </span>
                        </div>
                        <script>
                            var client<?= $key; ?> = new ZeroClipboard(document.getElementById("element_<?= $key; ?>"));
                            client<?= $key; ?>.on("aftercopy", function (event) {
                                $("#element_<?= $key; ?>").html("Скопировано!");
                                $("#element_<?= $key; ?>").addClass("btn-success");
                            });
                        </script>
                    </div>
            <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>

<?php Y::stats(); ?>
</div>

