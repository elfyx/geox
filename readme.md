##### 3. REST API приложение для работы с геообъектами

В проект добавлены Docker контейнеры и docker-compose.yml для запуска контейнеров через docker-compose.

Запуск (порты 80 и 8060 не должны быть заняты)
```
git clone https://github.com/elfyx/geox.git
chmod 777 -R geox/storage geox/bootstrap/cache
cd geox
docker-compose up -d
docker-compose exec geox sh -c 'composer install'
docker-compose exec geox sh -c 'php artisan migrate'
docker-compose exec geox sh -c 'php artisan db:seed'
```

После запуска контейнера будут доступны:
* http://localhost Приветственное сообщение
* http://localhost:8060 Adminer
  - Сервер: mysql57
  - Имя пользователя: root
  - Пароль: root


### API

---
GET http://localhost/api/v1/geo-objects Получить список геообъектов
```
curl -X GET \
-H "Accept: application/json" \
"http://localhost/api/v1/geo-objects"
```
---
GET http://localhost/api/v1/geo-objects/{id} Получить определенный геообъектов
```
curl -X GET \
-H "Accept: application/json" \
"http://localhost/api/v1/geo-objects/1"
```
---
POST http://localhost/api/v1/geo-objects Создать геообъект
```
curl -X POST \
-H "Content-type: application/json" \
-H "Accept: application/json" \
-d '{
  "geo_type_id": 4,
  "name": "Object_100",
  "description": "Description_100",
  "geo_feature": {
     "geom": {
     "type": "Polygon",
     "coordinates": [
       [
         [78.2666015625, 62.95522304515911],
         [69.3896484375, 58.790978406215565],
         [80.85937499999999,60.13056361691419],
         [78.2666015625, 62.95522304515911]
       ]
      ]
     }
  }
}' \
"http://localhost/api/v1/geo-objects"
```
---
PUT http://localhost/api/v1/geo-objects/{id} Обновить геообъект
```
curl -X PUT \
-H "Content-type: application/json" \
-H "Accept: application/json" \
-d '{
  "geo_type_id": 4,
  "name": "Object_500",
  "description": "Description_500",
  "geo_feature": {
     "geom": {
     "type": "Polygon",
     "coordinates": [
       [
         [78.2666015625, 62.95522304515911],
         [69.3896484375, 58.790978406215565],
         [80.85937499999999,60.13056361691419],
         [78.2666015625, 62.95522304515911]
       ]
      ]
     }
  }
}' \
"http://localhost/api/v1/geo-objects/1"
```
---
DELETE http://localhost/api/v1/geo-objects/{id} Удалить геообъект
```
curl -X DELETE \
-H "Content-type: application/json" \
-H "Accept: application/json" \
"http://localhost/api/v1/geo-objects/2"
```
---
DELETE http://localhost/api/v1/geo-objects/{id}?arhive Отправить в архив геообъект
```
curl -X DELETE \
-H "Content-type: application/json" \
-H "Accept: application/json" \
"http://localhost/api/v1/geo-objects/3?arhive"
```
---
GET http://localhost/api/v1/geo-objects/{id}/features История геометрий определенного геообъекта
```
curl -X GET \
-H "Accept: application/json" \
"http://localhost/api/v1/geo-objects/1/features"
```
---


Время затраченное на выполнение около 7ч.