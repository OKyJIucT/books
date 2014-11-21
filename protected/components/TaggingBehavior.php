<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TaggingBehavior extends CBehavior {

    const PREFIX = '__tag__';

    /**
     * Инвалидирует данные, помеченные тегом(ами)
     *
     * @param $tags
     * @return void
     */
    public function clear($tags) {

        foreach ((array) $tags as $tag) {
            $this->owner->set(self::PREFIX . $tag, time());
        }
    }

}
