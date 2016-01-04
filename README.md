<a href="http://dru.io" title="Русскоязычное сообщество Drupal" alt="Русскоязычное сообщество Drupal">
<img src="http://dru.io/sites/all/themes/druio_theme/logo.png" alt="Dru.io" width="170" />
</a>

**Адрес сообщества:** <a href="http://dru.io" title="Русскоязычное сообщество Drupal">dru.io</a>

### Навигация по репозиторию:

- [Issues](https://github.com/dru-io/Dru.io/issues) - вопросы, предложения улучшения, запросы, обсуждения. Тут происходит обсуждение технической стороны проекта.
- [Список изменений в сообществе за 2015](https://github.com/dru-io/Dru.io/wiki/%D0%A1%D0%BF%D0%B8%D1%81%D0%BE%D0%BA-%D0%BE%D0%B1%D0%BD%D0%BE%D0%B2%D0%BB%D0%B5%D0%BD%D0%B8%D0%B9-2015).
- Актуальная кодовая база - данный репозиторий.
- Актуальная [база данных](http://dru.io/sites/default/files/database.sql.gz). Создается ежедневно в 3 часа ночи. 

## Описание

Здесь мы храним код нашего проекта: базу, ядро и модули.
Это место где мы обсуждаем и предлагаем новые идеи для проекта, развивая сообщество общими усилиями.

### Я не программист, но я хочу принять участие.

Добро пожаловать в:
* [issues](https://github.com/dru-io/Dru.io/issues). Там вы сможете предложить новую идею, раздел для сайта, или указать на ошибки. Вы также можете принимать участие в обсуждениях и предложениях других участников Drupal-сообщества. Мы вместе принимаем решения.
* https://gitter.im/dru-io/Dru.io -- если требуется что-то обсудить или предложить идею, пока еще не оформившуюся, это чат разработчиков, где рады любым мнениям и отзывам.

### Я программист и хочу принять участие

При создании сообщества использовались следующие технологии: php, css, scss, js, html. Если вам знакомы все или часть из них, то вы сможете помочь и принять участие в разработке проекта. 

## Совместная разработка

Необходимый инструментарий:

* Аккаунт на Github
* Git
* Drush

### Развёртывание локальной версии dru.io

Ниже приведена пошаговая инструкция для развертывания дистрибутива dru.io в собственной среде разработки. Консольные команды указаны с расчетом на то, что выполняться они будут в корне каталога сайта.

1. Скачиваем и импортируем [актуальную версию базы данных](http://dru.io/sites/default/files/database.sql.gz)

2. Делаем форк текущего репозитория ([скриншот](http://dru.io/sites/default/files/dev-help1.png))

3. Клонируем форкнутый репозиторий на локальный компьютер:

  ~~~
  git clone git@github.com:YOUR_GITHUB_NAME/Dru.io.git .
  ~~~

4. Добавляем привязку удалённого репозитория:

  ~~~
  git remote add upstream git@github.com:dru-io/Dru.io.git
  ~~~

5. Копируем дефолтный конфиг:

  ~~~
  cd sites/default
  cp default.settings.php settings.php
  ~~~

6. Добавляем в конфиг информацию о базе данных и директориях:

  ~~~php
  $databases = array(
    'default' => array(
      'default' => array(
        'database' => 'DATABASE_NAME',
        'username' => 'DATABASE_USERNAME',
        'password' => 'DATABASE_PASSWORD',
        'host' => 'localhost',
        'port' => '',
        'driver' => 'mysql',
        'prefix' => '',
      ),
    ),
  );
  $conf['file_temporary_path'] = 'path/to/temp';
  ~~~

7. Логинимся под администратором:

  ~~~
  drush uli
  ~~~

P.s. Аватарки пользователей заменяются на аватар по умолчанию, другие картинки будут "битые", так как файлы сайта отствуют в репозитории.
Легкое решение проблем с картинками и многоими другими файлами: в файле .htaccess после `RewriteEngine on` прописываем  `Redirect 301 /sites/default/files http://dru.io/sites/default/files`.
Только не коммитите этот файл, чтобы он не улетел на продакшен ;)

### Отправка ваших изменений

1. Перед началом работы над локальной версией dru.io всегда забираем актуальную версию оригинального репозитория:

  ~~~
  git pull upstream master
  ~~~

2. Делаем правки

3. Коммитим правки:

  ~~~
  git add .
  git commit -am 'Commit message'
  ~~~

4. Отправляем коммит в свой удалённый репозиторий на Github:

  ~~~
  git push origin master
  ~~~

5. Переходим на Github и создаём Pull request ([скриншот](http://dru.io/sites/default/files/dev-help2.png))

### Редактирование темы.

Если вы хотите помочь в редактировании темы оформления, то вам следуюет знать некоторые моменты.

При разработке темы использован SASS + susy (для сетки). Ни в коем случае **не надо править style.css**, правятся SASS файлы. Компиляция проводится на продакшене.

Чтобы скомпилировать их, потребуется node.js + gulp.

1. Первым делом ставим nodejs, как это делается, зависит от вашей ОС.
2. Заходим в папку темы (druio_theme) и устанавливаем дополнения для nodejs.
  
~~~
  npm install gulp
  npm install gulp-sass
  npm install gulp-sourcemaps
~~~

3. Всё готово. Чтобы скомпилировать, из корня папки вызываем команду `gulp watch`. Он будет работать до тех пор пока не завершится сеанс терминала, либо вы не остановите. Т.е. компиляция проходит на лету до тех пор пока не отключите эту самую компиляцию, запускается единожды перед работой.

*Создано [сообществом](https://github.com/dru-io/Dru.io/graphs/contributors), для сообщества.*
