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
2) Устанавливаете PKG (https://mega.nz/#!GVMmgaqY!0jtBc1BWaPD2_5MoYszzxdMjcCKMq8zvM6s6Mwzl8yw)
3) Скачиваете и распаковываете (https://mega.nz/#!P19iWSZL!QA26mvJworiXgiASX9FshliXYKgO9XLspUo-fjQBM60)
ему требуется https://www.microsoft.com/ru-ru/download/details.aspx?id=30679
4) В папку www скидываете игру *.pkg
5) Запустите Remote Package Installer
6) Запускаете UwAmp.exe
7) Заходите в браузер по адресу http://<ip вашего pc>:8080, не http://localhost:8080
8) Вписываете ip своей PS4 и выбираете игру из списка, рядом дожден автоматически вписаться ее url
9) Нажимаете отправить

Если долго грузит страницу, обновляйте и оправляйте опять. 

Если все прошло хорошо, будет что то вроде 

Успешно, игра: Valkyria Chronicles устанавивается, task_id: 77
Проверить операцию task_id: 77

Все task_id находятся в task_id.txt в папке www

Как только установка успешно началась, появилось уведомление на PS4, в браузере увидели "Успешно", Remote Package Installer на PS4, подождите минуту и можно свернуть. Дальше весь прогресс можно смотреть на PS4

Во время установки нельзя закрывать UwAmp.exe на PC

Возможные ошибки ведущие к появлению "Нет связи с PS4, либо не установлен cURL" Введен не верный ip адрес консоли, На PS4 используется не HEN 1.8, Не запущен Remote Package Installer на PS4.

По всем вопросам и предложениям жду в личку, скрипт буду обновлять и дорабатывать.
