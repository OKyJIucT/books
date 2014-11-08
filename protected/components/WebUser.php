<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class WebUser extends CWebUser {

    private $_model = null;
    private $_access = array();

    function getRole() {
        if ($user = $this->getModel()) {
            // в таблице User есть поле role
            return $user->role;
        }
    }

    private function getModel() {
        if (!$this->isGuest && $this->_model === null) {
            $this->_model = Users::model()->findByPk($this->id, array('select' => 'role'));
        }
        return $this->_model;
    }

    public function checkAccess($operation, $params = array(), $allowCaching = true) {
        $cachId = Yii::app()->user->id . $operation;

        if (!isset($this->_access[$operation]) && Yii::app()->cache->get($cachId) === false) {
            $access = Yii::app()->getAuthManager()->checkAccess($operation, $this->getId(), $params);
            C::set($cachId, (int) $access, 60 * 60 * 10);
            return $this->_access[$operation] = $access;
        }

        if (!isset($this->_access[$operation])) {
            $access = (boolean) C::get($cachId);
            $this->_access[$operation] = $access;
            return $access;
        }

        return $this->_access[$operation];
    }

}
