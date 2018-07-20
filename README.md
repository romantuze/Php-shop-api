# Php shop api

PHP7, MVC, Mysql (PDO)

## Getting Started

Дамб базы находится в файле db.sql

### Инструкция

Выдача товара по ID
```
/api/product/1
```

Выдача товаров по вхождению подстроки в названии
```
/api/productsearch/nexus
```

Выдача товаров по производителю/производителям
```
/api/productsmanufacturer/lg&apple
/api/productsmanufacturer/apple
```

Выдача товаров по разделу (только раздел)
```
/api/productscategory/1
```

Выдача товаров по разделу и вложенным разделам
```
/api/productscategoryall/1
```
