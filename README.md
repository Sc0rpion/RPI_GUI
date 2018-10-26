# PS4 Remote Package Installer WEB GUI v0.1

WEB GUI для PS4 Remote Package Installer (https://mega.nz/#!GVMmgaqY!0jtBc1BWaPD2_5MoYszzxdMjcCKMq8zvM6s6Mwzl8yw)<br />

Для смены языка измените $lang в index.php [rus]  / For change language edit $lang in index.php [eng]

[На русском](https://github.com/Sc0rpion/RPI_GUI#%D1%82%D1%80%D0%B5%D0%B1%D0%BE%D0%B2%D0%B0%D0%BD%D0%B8%D1%8F) <br>
[On English](https://github.com/Sc0rpion/RPI_GUI#requirements)

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
2) Устанавливаете [remote_pkg_installer.pkg - 4.1 MB](https://mega.nz/#!GVMmgaqY!0jtBc1BWaPD2_5MoYszzxdMjcCKMq8zvM6s6Mwzl8yw)
3) Скачиваете и распаковываете [UwAmp.zip - 77.8 MB](https://mega.nz/#!ehsw1SgJ!WvfBG_9aSxFc2_Z--dOMw27kLibdtGW113EnykQe1jk)
ему требуется  [C ++ Redistributable Package for Visual Studio 2012 Update 4](https://www.microsoft.com/ru-ru/download/details.aspx?id=30679)
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


# Requirements:
PS4 with HEN 1.8
Installed RP
Any web server with PHP and cURL
Finding WEB and PS4 on the same network
The speed is limited only by the bandwidth of your network.

# Full guide using UwAmp WEB Server

PS4 and your PC must be on the same network and see each other

1. Clean all traces from previous HEN, clean cookies, cache and run HEN 1.8 (http://zecoxao.github.io)
2. Install the PKG [remote_pkg_installer.pkg - 4.1 MB](https://mega.nz/#!GVMmgaqY!0jtBc1BWaPD2_5MoYszzxdMjcCKMq8zvM6s6Mwzl8yw)
3. Download and unpack [UwAmp.zip - 77.8 MB](https://mega.nz/#!ehsw1SgJ!WvfBG_9aSxFc2_Z--dOMw27kLibdtGW113EnykQe1jk) it requires [C ++ Redistributable Package for Visual Studio 2012 Update 4](https://www.microsoft.com/ru-ru/download/details.aspx?id=30679)
4. In the folder www you throw off the game * .pkg
5. Run Remote Package Installer
6. Run UwAmp.exe
7. Access the browser at http: // <ip of your pc>: 8080, not http: // localhost: 8080
8. Enter the ip of your PS4 and choose a game from the list, next time it’s rainy to automatically enter its url
9. Push send

If the page loads for a long time, update and send it again.

If everything went well, it will be something like:

Successful game: Valkyria Chronicles is set, task_id: 77 Check operation task_id: 77

All task_id are in task_id.txt in the www folder.

As soon as the installation started successfully, a notification appeared on the PS4, in the browser we saw "Successfully", Remote Package Installer on the PS4, wait a minute and can be minimized. Further, all the progress can be viewed on the PS4

During installation, you can not close UwAmp.exe on PC

Possible errors leading to the appearance of "No connection with PS4, or cURL is not installed" The wrong console ip address is entered, PS4 does not use HEN 1.8, Remote Package Installer is not running on PS4.

For all questions and suggestions I wait, the script will be updated and refined.
