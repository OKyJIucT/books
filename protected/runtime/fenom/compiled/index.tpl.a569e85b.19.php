<?php 
/** Fenom template '/views/site/index.tpl' compiled at 2014-11-01 13:37:22 */
return new Fenom\Render($fenom, function ($var, $tpl) {
?><div class="col-md-12">
    <h1>Fenom</h1>
    <ul>
        <?php
/* /views/site/index.tpl:4: {foreach $citys as $city} */
  if(!empty($var["citys"])) {  foreach($var["citys"] as $var["city"]) {  ?>
            <li><a href="#<?php
/* /views/site/index.tpl:5: {$city.id} */
 echo $var["city"]["id"]; ?>"><?php
/* /views/site/index.tpl:5: {$city.username} */
 echo $var["city"]["username"]; ?></li>
            <?php
/* /views/site/index.tpl:6: {foreachelse} */
   } } else { ?>
            <li>Empty</li>
            <?php
/* /views/site/index.tpl:8: {/foreach} */
 } ?>
    </ul>
</div>
<?php
}, array(
	'options' => 128,
	'provider' => false,
	'name' => '/views/site/index.tpl',
	'base_name' => '/views/site/index.tpl',
	'time' => 1414838240,
	'depends' => array (
  0 => 
  array (
    '/views/site/index.tpl' => 1414838240,
  ),
),
	'macros' => array(),

        ));
