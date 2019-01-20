1. copy .env.example to .env
2. copy .env.example to .env.testing
3. docker-compose -f docker-compose.yml build
4. docker-compose -f docker-compose.yml up -d
5. Перейти по адресу 127.0.0.1:3009

####Тесты находятся в папке tests 
- функциональные тесты в папке Feature
    - файл ClickTest
- unit тесты в папке Unit
    - файл UnitClickTest