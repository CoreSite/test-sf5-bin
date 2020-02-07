# Имитация передачи данных между сервисами с использованием NDJSON

## Команды

* app:gen-products :N - генерирует NDJSON файл на N строк
* app:download-products http://localhost:8081/file/download/5 - скачивает из указанного источника данные в формате NDJSON
* app:upload-products :N - загружает на фиксированные ресурс N строк и выводит ответ от ресурса

## FileController

* Route: GET /download/{count<\d+>?1000} - генерирует данные в формате NDJSON, в количестве указанном в параметре count
* Route: POST /upload - получает данные в формате NDJSON и выводит отчет о количестве полученных элиментов


