<?php

class GrabCommand extends CConsoleCommand {

    public function run($args) {

        $vk = new VkApi(Y::vkConfig());

        // выбираем случайный паблик
        $public = Publics::getPublic();

        // парсим стену паблика
        $response = Vk::getWall($vk, -1 * abs($public->public_id), 20, $public->offset);
		
		print_r($public->public_id);

        // обходим полученные элементы
        foreach ($response['items'] as $item) {

            $array['attachments'] = '';

            // если репост - пропускаем
            if (isset($item['copy_history']))
                continue;

            // если нет текста и картинки - пропускаем
            if (empty($item['text']) && empty($item['attachments']))
                continue;

            $criteria = new CDbCriteria();
            $criteria->condition = 'public_id = :public_id AND post_id = :post_id';
            $criteria->params = array(':public_id' => abs($item['from_id']), ':post_id' => $item['id']);
            $exists = Posts::model()->exists($criteria);

            // если не дубль
            if (!$exists) {

                // пропускаем, если в посте есть ссылка
                if (strripos($item['text'], 'http') === true)
                    continue;

                if (isset($item['attachments']) && !empty($item['attachments'])) {
			

                    // пропускаем, если есть прикрепленная страница
                    foreach ($item['attachments'] as $attach) {
                        if (isset($attach['page']))
                            continue;
                    }



                    // пропускаем, если больше 1 картинки
                    if (count($item['attachments']) > 1)
                        continue;

                    $url = $item['attachments'][0]['photo']['photo_604'];

                    $year = date('Y', time());
                    $month = date('m', time());
                    $day = date('d', time());

                    $dir = '/img/' . $year . '-' . $month . '-' . $day . '/';

                    $sub = Yii::app()->basePath . '/..' . $dir;

                    if (!is_dir($sub))
                        mkdir($sub, 0755, true);

                    $filename = md5(time() . rand(100000, 9999999) . date("r", (time() - rand(100000, 9999999)))) . '.jpg';

                    $path = $sub . $filename;

                    file_put_contents($path, file_get_contents($url));

                    $array['attachments'] = $dir . $filename;
                }

                $model = new Posts;
                $model->public_id = abs($public->public_id);
                $model->post_id = $item['id'];
                $model->message = $item['text'];
                $model->attachments = $array['attachments'];
                $model->date = time();
                $model->posted = 0;
                $model->save();

                echo $item['id'] . "\r\n" . PHP_EOL;
            }
        }

        $criteria = new CDbCriteria();
        $criteria->condition = 'public_id = :public_id';
        $criteria->params = array(':public_id' => $public->public_id);
        $attributes = array(
            'offset' => $public->offset - 20
        );
        Publics::model()->updateAll($attributes, $criteria);
    }

}
