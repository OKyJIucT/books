<?php

/**
 * Класс-ярлык для работы с кешем
 */
class C
{

    /**
     * @var array Кэш компонентов приложения
     * @since 1.2.0
     */
    private static $_componentsCache = array();

    /**
     * Возвращает cache-компонент приложения
     * @param string $cacheId ID кэш-компонента (@since 1.1.3)
     * @return ICache
     */
    public static function cache($cacheId = 'cache')
    {
        return self::_getComponent($cacheId);
    }

    /**
     * Удаляет кэш с ключом $id
     * @param string $id Имя ключа
     * @param string $cacheId ID кэш-компонента (@since 1.1.3)
     * @return boolean
     */
    public static function delete($id, $cacheId = 'cache')
    {
        return self::_getComponent($cacheId)->delete($id);
    }

    /**
     * Возвращает значение кэша с ключом $id
     * @param string $id Имя ключа
     * @param string $cacheId ID кэш-компонента (@since 1.1.3)
     * @return mixed
     */
    public static function get($id, $cacheId = 'cache')
    {
        return self::_getComponent($cacheId)->get($id);
    }

    /**
     * Сохраняет значение $value в кэш с ключом $id на время $expire (в секундах)
     * @param string $id Имя ключа
     * @param mixed $value Значение ключа
     * @param integer $expire Время хранения в секундах
     * @param ICacheDependency $dependency Смотри {@link ICacheDependency}
     * @param string $cacheId ID кэш-компонента (@since 1.1.3)
     * @return boolean
     */
    public static function set($id, $value, $expire = 900, $dependency = null, $cacheId = 'cache')
    {
        return self::_getComponent($cacheId)->set($id, $value, $expire, $dependency);
    }

    /**
     * Очистка кеша
     */
    public static function flush($cacheId = 'cache')
    {
        self::_getComponent($cacheId)->flush();
    }

    public static function prefix($data, $id = false)
    {
        switch ($data) {
            case 'profile':
                return 'profile::info::' . md5($id) . '::' . $id;
                break;

            case 'docs':
                return 'docs::view::' . md5($id) . '::' . $id;
                break;

            case 'relation':
                return 'relation::view::' . md5($id) . '::' . $id;
                break;

            case 'chapters':
                return 'chapters::view::' . md5($id) . '::' . $id;
                break;

            case 'getProcess':
                return 'getProcess::view::' . md5($id) . '::' . $id;
                break;

            case 'countTicketsSupport':
                return 'countTicketsSupport::view::' . md5($id) . '::' . $id;
                break;

            case 'countTicketsUser':
                return 'countTicketsUser::view::' . md5($id) . '::' . $id;
                break;

            default:
                break;
        }
    }

    /**
     * Возвращает компонтент приложения
     * Экономит лишние вызовы методов для получения компонентов путем кэширования компонентов
     * @param string $componentName Имя компонента приложения
     * @return CComponent
     * @since 1.2.0
     */
    private static function _getComponent($componentName)
    {
        if (!isset(self::$_componentsCache[$componentName])) {
            self::$_componentsCache[$componentName] = Yii::app()->getComponent($componentName);
        }

        return self::$_componentsCache[$componentName];
    }

    /**
     * Удаление кеша по тегу
     * @param type $tag
     */
    public static function clear($tag, $cacheId = 'cache')
    {
        self::_getComponent($cacheId)->clear($tag);
    }

}
