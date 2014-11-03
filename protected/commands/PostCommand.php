<?php

class PostCommand extends CConsoleCommand {

    public function run($args) {

        $vk = new VkApi(Y::vkConfig());

        $public = Publics::getPublicForPost();

        // выбираем случайный пост
        $post = Posts::getPost();
          
        if (!empty($post->attachments)) {
            $attachments = $vk->upload_photo($public->public_id, array(Yii::app()->basePath . '/..' . $post->attachments));
            $array['attachments'] = 'photo14898834_' . $attachments[0];
        }

        if (isset($public->tags) && !empty($public->tags)) {
            $array['message'] = $public->tags ? $post->message . "\r\n" . $public->tags : $post->message;
        } else {
            $array['message'] = $post->message;
        }
                
        $array['owner_id'] = -1 * $public->public_id;
        $result = $vk->api('wall.post', $array);
               
        if (!isset($result['error'])) {
            // добавляем пост в историю
            $history = new History;
            $history->public_id = $public->public_id;
            $history->post_id = $post->id;
            $history->date = time();
            $history->save();
        }
    }

}
