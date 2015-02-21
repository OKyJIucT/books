<?php $v = 102; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- Import google fonts - Heading first/ text second -->
        <link rel='stylesheet' type='text/css'
              href='http://fonts.googleapis.com/css?family=Open+Sans:400,700|Droid+Sans:400,700'/>
        <!--[if lt IE 9]>
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet" type="text/css"/>
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:700" rel="stylesheet" type="text/css"/>
        <link href="http://fonts.googleapis.com/css?family=Droid+Sans:400" rel="stylesheet" type="text/css"/>
        <link href="http://fonts.googleapis.com/css?family=Droid+Sans:700" rel="stylesheet" type="text/css"/>
        <![endif]-->
        <?php
        Yii::app()->clientScript->registerCssFile(
            Yii::app()->assetManager->publish(
                Yii::app()->request->baseUrl . 'static/css/main.min.css'
            )
        );

        Yii::app()->clientScript->registerScriptFile(
            Yii::app()->assetManager->publish(
                Yii::app()->request->baseUrl . 'static/plugins/core/pace/pace.min.js'
            ), CClientScript::POS_END
        );

        Yii::app()->clientScript->registerScriptFile(
            Yii::app()->assetManager->publish(
                Yii::app()->request->baseUrl . 'static/js/pages/login.js'
            ), CClientScript::POS_END
        );
        ?>
        <!--[if lt IE 9]>
        <script type="text/javascript" src="/static/js/libs/excanvas.min.js"></script>
        <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script type="text/javascript" src="/static/js/libs/respond.min.js"></script>
        <![endif]-->

        <link rel="icon" href="/favicon.ico" type="image/png">

        <title><?php echo CHtml::encode($this->pageTitle . ' - ' . Yii::app()->name); ?></title>
    </head>
    <body class="login-page pace-done">
        <?php echo $content; ?>
        <!-- Yandex.Metrika counter -->
        <script src="//mc.yandex.ru/metrika/watch.js" type="text/javascript"></script>
        <script type="text/javascript">try {
                var yaCounter27399752 = new Ya.Metrika({id: 27399752});
            } catch (e) {
            }</script>
        <noscript>
            <div><img src="//mc.yandex.ru/watch/27399752" style="position:absolute; left:-9999px;" alt=""/></div>
        </noscript>
        <!-- /Yandex.Metrika counter -->
    </body>
</html>
