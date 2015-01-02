<div class="container animated fadeInDown">
    <h1 class="error-number"><?php echo $code; ?></h1>

    <h1 class="text-center mb25"><?php echo CHtml::encode($message); ?></h1>

    <div class="text-center mt25">
        <div class="btn-group">
            <a href="javascript: history.go(-1)" class="btn btn-default btn-lg"><i class="en-arrow-left8"></i> Вернуться
                назад</a>
            <a href="/" class="btn btn-default btn-lg"><i class="im-home"></i> На главную</a>
        </div>
    </div>
</div>