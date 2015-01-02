<?php $v = 102; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <meta name="description"
          content="sprFlat admin template - new premium responsive admin template. This template is designed to help you build the site administration without losing valuable time.Template contains all the important functions which must have one backend system.Build on great twitter boostrap framework"
        />
    <meta name="keywords"
          content="admin, admin template, admin theme, responsive, responsive admin, responsive admin template, responsive theme, themeforest, 960 grid system, grid, grid theme, liquid, jquery, administration, administration template, administration theme, mobile, touch , responsive layout, boostrap, twitter boostrap"
        />
    <meta name="application-name" content="sprFlat admin template"/>
    <!-- Import google fonts - Heading first/ text second -->
    <link rel='stylesheet' type='text/css'
          href='http://fonts.googleapis.com/css?family=Open+Sans:400,700|Droid+Sans:400,700'/>
    <!--[if lt IE 9]>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet" type="text/css"/>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:700" rel="stylesheet" type="text/css"/>
    <link href="http://fonts.googleapis.com/css?family=Droid+Sans:400" rel="stylesheet" type="text/css"/>
    <link href="http://fonts.googleapis.com/css?family=Droid+Sans:700" rel="stylesheet" type="text/css"/>
    <![endif]-->
    <!-- Css files -->
    <?php
    Yii::app()->clientScript->registerCssFile('/static/css/main.min123.css?' . $v);

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
    <script src="http://yastatic.net/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://yastatic.net/jquery-ui/1.11.2/jquery-ui.min.js"></script>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/assets/js/libs/excanvas.min.js"></script>
    <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script type="text/javascript" src="/assets/js/libs/respond.min.js"></script>
    <![endif]-->
    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="/static/img/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="/static/staticimg/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/static/img/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/static/img/ico/apple-touch-icon-57-precomposed.png">
    <link rel="icon" href="/static/img/ico/favicon.ico" type="image/png">

    <meta name="msapplication-TileColor" content="#3399cc"/>
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
