<div class="col-md-12">
    <div class="error-container">
        <div class="error-code"><?php echo $code; ?></div>
        <div class="error-text"><?php echo CHtml::encode($message); ?></div>
        <div class="error-subtext">К сожалению, у нас возникают проблемы с загрузкой страницы, которую вы ищете. Пожалуйста, повторите через некоторое время снова, или воспользуйтесь кнопками ниже.</div>
        <div class="error-actions">                                
            <div class="row">
                <div class="col-md-6">
                    <button class="btn btn-info btn-block btn-lg" onclick="document.location.href = '/';">Перейти на главную</button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary btn-block btn-lg" onclick="history.back();">Вернуться назад</button>
                </div>
            </div>                                
        </div>
    </div>
</div>