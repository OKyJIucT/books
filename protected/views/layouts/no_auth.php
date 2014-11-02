<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/bootstrap/css/theme-default.css'); ?>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>
    <body>
        <?php echo $content; ?>
    </body>
</html>
