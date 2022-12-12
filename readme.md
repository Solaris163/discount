Тестовое задание на должность разработчика по 1С-Битрикс. В рамках задания необходимо реализовать страницу, на которой авторизованный пользователь может получить скидку и уникальный код, идентифицирующий эту скидку для данного пользователя. Если пользователь запрашивает новую скидку раньше чем через 1 час, то ему отображается старая скидка. При нажатии на кнопку "Проверить скидку" пользователю отображается размер скидки. Если скидка получена более 3 часов назад, или она получена другим пользователем, то отображается уведомление "Скидка недоступна".
Получение и вывод скидки происходит с помощью компонента solaris:discount, который расположен по адресу /local/components/solaris/discount/.
Для запуска скрипта по созданию таблицы в базе данных и созданию тестовых пользователей, необходимо зайти на страницу /discount/install.php предварительно авторизовавшись под пользователем с правами администратора.
Страница для получения скидки располагается по адресу /discount/index.php. На этой странице вставлен вышеупомянутый компонент solaris:discount, в который передаются три параметра:
1. Время запрета получения новой скидки (в часах)
2. Период действия скидки (в часах)
3. URL страницы авторизации
Получение и проверка скидки реализованы без перезагрузки страницы с помощью AJAX. Языковые фразы для файлов component.php и template.php вынесены в языковые файлы. Скрипты js и стили вынесены в отдельные файлы.
В файле /discount/install.php находится логика по созданию в базе данных таблицы со скидками и двух тестовых пользователей с логинами test1 и test2 и паролями 123123
По адресу /local/lib/solaris/discount/discount.php расположен класс для работы с таблицей базы данных, который зарегистрирован в файле local/php_interface/init.php