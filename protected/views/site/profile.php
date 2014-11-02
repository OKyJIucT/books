<?php
$this->breadcrumbs = array(
    'Профиль ' . $profile->username,
);
?>

<div class="col-md-12">

    <div class="col-md-6">
        <h2>Данные профиля</h2>
        <form class="form-horizontal" role="form">                                    
            <div class="form-group">
                <label class="col-md-3 control-label">Ник</label>
                <div class="col-md-9">
                    <p class="form-control-static"><?= $profile->username; ?></p>
                </div>
            </div>          
            <?php if ($profile->id == Yii::app()->user->id || Y::hasAccess('administrator')) : ?>
                <div class="form-group">
                <label class="col-md-3 control-label">Email</label>
                <div class="col-md-9">
                    <p class="form-control-static"><?= $profile->email; ?></p>
                </div>
            </div> 
            <?php endif; ?>      
            <?php if ($profile->id == Yii::app()->user->id || Y::hasAccess('administrator')) : ?>
                <div class="form-group">
                <label class="col-md-3 control-label">Дата регистрации</label>
                <div class="col-md-9">
                    <p class="form-control-static"><?= date('d.m.Y', $profile->reg_date); ?></p>
                </div>
            </div> 
            <?php endif; ?>
        </form>
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

    <?php Y::stats(); ?>
</div>

