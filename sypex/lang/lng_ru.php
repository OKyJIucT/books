<?php
// Language File for Sypex Dumper 2
$LNG = array(

// Информация о файле локализации
'ver'				=> 20007, // Для какой версии предназначен файл
'translated'		=> 'zapimir (http://sypex.net/)', // Контакты переводчика
'name'				=> 'Русский', // Название языка

// Панель инструментов
'tbar_backup'		=> 'Экспорт',
'tbar_restore'		=> 'Импорт', 
'tbar_files'		=> 'Файлы',
'tbar_services'		=> 'Сервисы',
'tbar_options'		=> 'Опции',
'tbar_createdb'		=> 'Создать БД',
'tbar_connects'		=> 'Соединение',
'tbar_exit'			=> 'Выход',

// Названия объектов в дереве
'obj_tables'		=> 'Таблицы',
'obj_views'			=> 'Представления',
'obj_procs'			=> 'Процедуры',
'obj_funcs'			=> 'Функции',
'obj_trigs'			=> 'Триггеры',
'obj_events'		=> 'События',

// Экспорт
'zip_max'			=> 'максимум',
'zip_min'			=> 'минимум',
'zip_none'			=> 'Без сжатия',
'default'			=> 'по умолчанию',
'combo_db'			=> 'База данных:', 
'combo_charset'		=> 'Кодировка:', 
'combo_zip'			=> 'Сжатие:', 
'combo_comments'	=> 'Комментарий:',
'del_legend'		=> 'Автоудаление, если:',
'del_date'			=> 'файлам больше %s дней',
'del_count'			=> 'количество файлов более %s',
'tree'				=> 'Выберите объекты:',
'no_saved'			=> '*Нет сохраненных задач',
'btn_save'			=> 'Сохранить',
'btn_exec'			=> 'Выполнить',
'outfile'			=> 'Режим OUTFILE',// 2.0.7 pro

// Импорт	
'combo_file'		=> 'Файл:',
'combo_strategy'	=> 'Стратегия восстановления:',
'ext_legend'		=> 'Дополнительные опции:',
'correct'			=> 'Коррекция кодировки',
'autoinc'			=> 'Обнулить AUTO_INCREMENT',
'prefix'			=> 'Изменить префикс с %s на %s',// 2.0.7 pro
'savesql'			=> 'Сохранить в SQL-файл',// 2.0.7 pro
'infile'			=> ' в файл',// 2.0.7 pro

// Лог
'status_current'	=> 'Текущий статус:',
'status_total'		=> 'Общий статус:',
'time_elapsed'		=> 'Прошло:',
'time_left'			=> 'Осталось:',
'btn_stop'			=> 'Прервать',
'btn_pause'			=> 'Пауза',
'btn_resume'		=> 'Продолжить',
'btn_again'			=> 'Повторить',
'btn_clear'			=> 'Очистить лог',

// Файлы
'btn_delete'		=> 'Удалить',
'btn_download'		=> 'Скачать',
'btn_open'			=> 'Открыть',

// Сервисы
'opt_check'			=> 'Опции для Проверить:',
'opt_repair'		=> 'Опции для Починить:',
'btn_delete_db'		=> 'Удалить БД',
'btn_check'			=> 'Проверить',
'btn_repair'		=> 'Починить',
'btn_analyze'		=> 'Анализировать',
'btn_optimize'		=> 'Оптимизировать',
'btn_extra'			=> 'Дополнительно...',// 2.0.7 pro

// Опции
'cfg_legend'		=> 'Основные настройки:',
'cfg_time_web'		=> 'Время выполнения в web (сек.):',
'cfg_time_cron'		=> 'Время выполнения в cron (сек.):',
'cfg_backup_path'	=> 'Путь к каталогу backup:',
'cfg_backup_url'	=> 'URL к каталогу backup:',
'cfg_globstat'		=> 'Глобальная статистика:',
'cfg_extended'		=> 'Расширенные настройки:',
'cfg_charsets'		=> 'Фильтр для кодировок:',
'cfg_only_create'	=> 'Бэкап только структуры:',
'cfg_auth'			=> 'Цепочка авторизации:',
'cfg_confirm'		=> 'Спрашивать подтверждение для:',
'cfg_conf_import'	=> 'импорта БД',
'cfg_conf_file'		=> 'удаления файла',
'cfg_conf_db'		=> 'удаления БД',
'cfg_conf_truncate'	=> 'очистки таблиц',// 2.0.7 pro
'cfg_conf_drop'		=> 'удаления таблиц',// 2.0.7 pro
'cfg_outfile_path'	=> 'Путь для OUTFILE:',// 2.0.7 pro
'cfg_outfile_size'	=> 'Размер буффера для OUTFILE (МБ):',// 2.0.7 pro

// Соединение
'con_header'		=> 'Параметры соединения',
'connect'			=> 'Соединение',
'my_host'			=> 'Хост:',
'my_port'			=> 'Порт:',
'my_user'			=> 'Пользователь:',
'my_pass'			=> 'Пароль:',
'my_pass_hidden'	=> 'Пароль не показан',
'my_comp'			=> 'Протокол со сжатием',
'my_db'				=> 'Базы данных:',
'btn_cancel'		=> 'Отмена',

// Сохранение задания
'sj_header'			=> 'Сохранение задания',
'sj_job'			=> 'Задание',
'sj_name'			=> 'Имя (англ.):',
'sj_title'			=> 'Описание:',

// Создание БД
'cdb_header'		=> 'Создание базы данных',
'cdb_detail'		=> 'Детали',
'cdb_name'			=> 'Название:',
'combo_collate'		=> 'Сравнение',
'btn_create'		=> 'Создать',
'hint'				=> 'Подсказка',// 2.0.7 pro

// Авторизация
'js_required'		=> 'JavaScript должен быть включен',
'auth'				=> 'Авторизация',
'auth_user'			=> 'Пользователь:',
'auth_remember'		=> 'Запомнить',
'btn_enter'			=> 'Войти',
'btn_details'		=> 'Детали',

// Сообщения в логе
'not_found_rtl'		=> 'Отсутствует RTL-файл',
'backup_begin'		=> 'Начало экспорта БД `%s`',
'backup_TC'			=> 'Экспорт таблицы `%s`',
'backup_VI'			=> 'Экспорт представления `%s`',
'backup_PR'			=> 'Экспорт процедуры `%s`',
'backup_FU'			=> 'Экспорт функции `%s`',
'backup_EV'			=> 'Экспорт события `%s`',
'backup_TR'			=> 'Экспорт триггера `%s`',
'continue_from'		=> 'с позиции %s',
'backup_end'		=> 'Резервная копия БД `%s` создана.',
'autodelete'		=> 'Автоудаление старых файлов:',
'del_by_date'		=> '- `%s` - удален (по дате)',
'del_by_count'		=> '- `%s` - удален (по дате)',
'del_fail'			=> '- `%s` - удалить не удалось',
'del_nothing'		=> '- нет файлов для удаления',
'set_names'			=> 'Установлена кодировка соединения: `%s`',
'restore_begin'		=> 'Начало импорта БД `%s`',
'restore_TC'		=> 'Импорт таблицы `%s`',
'restore_VI'		=> 'Импорт представления `%s`',
'restore_PR'		=> 'Импорт процедуры `%s`',
'restore_FU'		=> 'Импорт функции `%s`',
'restore_EV'		=> 'Импорт события `%s`',
'restore_TR'		=> 'Импорт триггера `%s`',
'restore_keys'		=> 'Включение индексов',
'restore_end'		=> 'БД `%s` восстановлена из резервной копии.',
'stop_1'			=> 'Выполнение прервано пользователем', 
'stop_2'			=> 'Выполнение остановлено пользователем',
'stop_3'			=> 'Выполнение остановлено по таймеру',
'stop_4'			=> 'Выполнение остановлено по таймауту',
'stop_5'			=> 'Выполнение прервано из-за ошибки',
'job_done'			=> 'Задание успешно выполнено',
'file_size'			=> 'Размер файла',
'job_time'			=> 'Времени затрачено',
'seconds'			=> 'сек.',
'job_freeze'		=> 'Процесс не обновлялся более 30 секунд. Нажмите Продолжить',
'stop_job'			=> 'Запрос на остановку',

// Надписи в JS
'js' => array(

	// Названия вкладок
	'backup'		=> 'Экспорт базы данных',
	'restore'		=> 'Импорт базы данных',
	'log'			=> 'Лог действий',
	'result'		=> 'Результат выполнения',
	'files'			=> 'Файлы резервных копий',
	'services'		=> 'Сервисы',
	'options'		=> 'Опции',

	// Заголовки таблиц
	'dt'			=> 'Дата и время',
	'action'		=> 'Действие',
	'db'			=> 'База данных',
	'type'			=> 'Тип',
	'tab'			=> 'Табл.',
	'records'		=> 'Записей',
	'size'			=> 'Размер',
	'comment'		=> 'Комментарий',
	
	// Статусы
	'load'			=> 'Загрузка',
	'run'			=> 'Выполнение...',
	'sdb'			=> 'Создание базы данных',
	'sc'			=> 'Сохранение соединения',
	'sj'			=> 'Сохранение задания',
	'so'			=> 'Сохранение опций',

	// Сообщения
	'pro'			=> 'Опция доступна только в Pro-версии',
	'err_fopen'		=> 'Не удается открыть файл',
	'err_sxd2'		=> 'Просмотр содержимого файла доступен только для файлов созданных Sypex Dumper 2',
	'err_empty_db'	=> 'База данных пустая',
	'fdc'			=> 'Вы действительно хотите удалить файл?',
	'ddc'			=> 'Вы действительно хотите удалить базу данных?',
	'fic'			=> 'Вы действительно хотите импортировать файл?',
	'ttc'			=> 'Вы действительно хотите очистить таблицы?',// 2.0.7 pro
	'tdc'			=> 'Вы действительно хотите удалить таблицы?',// 2.0.7 pro

	// Сокращения размеров файла
	'sizes'			=> array('Б', 'КБ', 'МБ', 'ГБ'),

	// Изменение/исправление кодировки
	'chc_header'	=> 'Изменение кодировки',// 2.0.7 pro
	'coc_header'	=> 'Исправление кодировки',// 2.0.7 pro

	'hint_chc'		=> 'Изменение кодировки нужно в случаях, когда нужно изменить кодировку таблицы и данных, например, из cp1251 в utf8.',// 2.0.7 pro
	'hint_coc'		=> 'Исправление кодировки нужно в случаях, когда у таблицы указана одна кодировка, а данные в другой. Например, таблица в latin1, а данные в cp1251.',// 2.0.7 pro
	'need_backup'	=> 'Рекомендуется предварительно сделать бэкап базы данных.',// 2.0.7 pro
	
	// Долнительные сервисы
	'btn_chc'		=> 'Изменить кодировку',// 2.0.7 pro
	'btn_coc'		=> 'Исправить кодировку',// 2.0.7 pro
	'btn_enable'	=> 'Включить индексы',// 2.0.7 pro
	'btn_disable'	=> 'Выключить индексы',// 2.0.7 pro
	'btn_truncate'	=> 'Очистить таблицы',// 2.0.7 pro
	'btn_drop'		=> 'Удалить таблицы',// 2.0.7 pro
	'btn_drop_db'	=> 'Удалить БД',// 2.0.7 pro
)
);
?>
