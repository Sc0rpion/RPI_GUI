# PS4 Remote Package Installer WEB GUI

WEB GUI для PS4 Remote Package Installer (https://mega.nz/#!GVMmgaqY!0jtBc1BWaPD2_5MoYszzxdMjcCKMq8zvM6s6Mwzl8yw)<br />

# Требования:
PS4 с HEN 1.8 (http://zecoxao.github.io/) <br />
Установленный RPI https://mega.nz/#!rYMknQJS!D6-D4JVJ4QkvR5-HcEWH3f5xsnYRQ316CN5gQ_zf46c <br />
Любой web сервер с PHP и cURL <br />
Нахождение WEB и PS4 в одной сети <br />
<br />
Скорость ограничена только пропускной способностью вашей сети

# Полный гайд с использованием WEB Сервера UwAmp

PS4 и ваш PC должны быть в одной сети и видеть друг друга

1) Чистите все следы от прежних HEN, чистите куки, кэш и запускайте HEN 1.8 (http://zecoxao.github.io)
2) Устанавливаете PKG (https://mega.nz/#!GVMmgaqY!0jtBc1BWaPD2_5MoYs..)
3) Скачиваете и распаковываете (https://mega.nz/#!vlE1WIgB!U7FM9XDcXJUlW7ge7V..)
ему требуется https://www.microsoft.com/ru-ru/download/details.aspx..
4) В папку www скидываете игру *.pkg
5) Запускаете UwAmp.exe, должно выглядеть так https://cdn1.savepice.ru/uploads/2018/10/24/7c71590f2..
6) Заходите в браузер по адресу http://<ip вашего pc>:8080, не http://localhost
7) Копируйте cсылку на игру. Должно быть что то типо http://192.168.1.104:8080/GodOfWar.pkg
8) Запускайте http://<ip вашего pc>:8080/action.php
9) Вставляете ссылку игры в url pkg и вписываете ip своей приставки
10) Нажимаете отправить

Если долго грузит страницу, обновляйте и оправляйте опять. 

Если все прошло хорошо, будет что то вроде 

Успешно, игра: Valkyria Chronicles устанавивается, task_id: 77
Проверить операцию task_id: 77

Далее либо нажимайте "Проверить операцию task_id: 77" либо вводите в форму "Статус операции по task_id" полученный ранее task_id и ip приставки
и увидете прогресс установки. Для обновления информации о прогрессе установке, нужно нажать кнопку update

Пример вывода прогресса:

Устанавливается файл №1 из 1, осталось всего времени 8.6 мин., 24%. Скопировалось 6.89 ГБ из 28.815 ГБ

Во время установки нельзя сворачивать/закрывать Remote Package Installer на PS4 и UwAmp.exe на PC

Возможные ошибки ведущие к появлению "Нет связи с PS4, либо не установлен cURL" Введен не верный ip адрес консоли, На PS4 используется не HEN 1.8, Не запущен Remote Package Installer на PS4.
