# API для управления организациями (с Docker)

## Установка и запуск через Docker
#### 1. Клонируйте репозиторий

```bash
git clone https://github.com/yourusername/organization-api.git
cd organization-api
```

#### 2. Соберите Docker образы
Запустите команду для сборки Docker-образов:

```bash
docker-compose build
```
#### 3. Запустите контейнеры
Запустите все сервисы с помощью Docker Compose:

```bash
docker-compose up -d
```

Приложение Laravel: http://localhost

#### 4. Выполните миграции и сидеры
После запуска контейнеров, нужно выполнить миграции и сидеры:

Подключитесь к контейнеру приложения:

```bash
docker-compose exec app bash
```

Выполните миграции и сидеры для наполнения базы данных:

```bash
php artisan migrate --seed
```

#### 5. Получите доступ к API
Теперь API будет доступно по адресу: http://localhost.

### Swagger

В контейнере прописать

```
composer require "darkaonline/l5-swagger"
php artisan vendor:publish --provider="L5Swagger\L5SwaggerServiceProvider"
php artisan l5-swagger:generate
```

доки доступны в api/documentation

Использование API
Аутентификация
Для работы с API необходимо передавать API ключ в заголовке всех запросов:

API_KEY: ваш-api-ключ
API ключ можно настроить в файле .env:

env
```
API_KEY=ваш-реальный-api-ключ
```

## Дополнительно
Остановка контейнеров
Чтобы остановить контейнеры:

```bash
docker-compose down
```

Логи контейнеров
Чтобы просматривать логи приложения, используйте команду:

Тестирование
Запустите тесты с помощью PHPUnit в контейнере:

```bash
docker-compose exec app bash
php artisan test
```

## Структура вашего проекта
Ваши контейнеры используют следующие пути:

#### 1. Получить организации по зданию
Метод: GET \
URL: /api/organizations/building/{buildingId} \
Описание: Получить все организации, связанные с указанным зданием по его ID. \

#### 2. Получить организации по виду деятельности
Метод: GET
URL: /api/organizations/activity/{activityId} \
Описание: Получить все организации, относящиеся к указанному виду деятельности. \

#### 3. Получить организации по имени вида деятельности
Метод: GET \
URL: /api/organizations/activity-name \
Описание: Получить все организации, относящиеся к виду деятельности по его названию (поиск по имени). \

#### 4. Получить организацию по ID
Метод: GET \
URL: /api/organization/{id} \

#### 5. Поиск организаций по имени
Метод: GET \
URL: /api/organizations/search/{name} \
Описание: Найти организации, название которых частично совпадает с переданным. \

#### 6. Получить организации в радиусе от заданной точки
Метод: GET \
URL: /api/organizations/near \
Описание: Получить список организаций в пределах заданного радиуса от указанной точки на карте. \

