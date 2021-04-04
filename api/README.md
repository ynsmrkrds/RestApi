# REST API

Bu REST API'da GET, POST, PUT ve DELETE isteklerini karşılayabilecek 4 farklı endpoint sunulmaktadır. Bu API'ya gelen her istek için random 0-3 sn arasında başarılı bir yanıt dönülmekte ve yanıt dönülmeden hemen önce "{metot tipi}, {istek cevaplama ms}, {timestamp}" gibi bir içerik ile log dosyasına isteğin ne kadar sürdüğü yazılmaktadır. (Örnek log: "GET, 1000, 1614679220")

Async çalışan bir producer, log dosyasına anlık olarak yazılan satırları alıp Kafka'ya belirlenen bir formatta göndermektedir. Bir consumer Kafka'ya gönderilen log bilgisini yakalayıp, MySQL veritabanına yazmaktadır.

## API DÖKÜMANI

> Postman ile hazırlanan API dökümanına _"https://documenter.getpostman.com/view/15150899/TzCMc7eb"_ adresinden ulaşabilirsiniz.

Yol | Metod | Tip | Gönderilen JSON | Açıklama
--- | ----- | --- | ---- | --------
/api/users | GET | JSON | - | Tüm user'ları getirir
/api/users/{id} | GET | JSON | - | ID'si verilen user'ı getirir
/api/users | POST | JSON | {"userName": "Yunus Emre", "userSurname": "KARADAŞ", "gender" : "E"} | Yeni bir user ekler
/api/users | PUT | JSON |{"id" : "1", "userName" : "Yunus Emre", "userSurname" : "EMİROĞULLARI", "gender" : "E"} | ID'si verilen user'i günceller
/api/users | DELETE | JSON |{"id" : "1"} | ID'si verilen user'ı siler

## PROJEYİ ÇALIŞTIMAK İÇİN GEREKENLER

* Apache Web Server v2.4.29
* PHP v7.2.24
* Apache Kafka v2.6.1
* MySQL v5.7.33

## PROJENİN ÇALIŞTIRILMASI İÇİN YAPILMASI GEREKENLER

1. MySQL veritabanında kullanıcı adı "phpuser", şifresi ise "phpuser" olan bir kullanıcı oluşturulmalıdır.

    > Ubuntu Server için;

    a. MySQL sunucusuna erişip aşağıdaki kodu çalıştırın.

        CREATE USER 'phpuser'@'localhost' IDENTIFIED BY 'phpuser';

    b. Oluşturulan kullanıcıya veritabanındaki tüm ayrıcalıkları tanımak için aşağıdaki kodu çalıştırın.

        GRANT ALL PRIVILEGES ON * . * TO 'phpuser'@'localhost';

    c. Değişiklikleri hemen uygulamak için aşağıdaki kodu çalıştırın.

        FLUSH PRIVILEGES;

2. "api/database" klasörü içerisinde yer alan "database_scripts.sql" dosyası MySQL'e import edilmelidir.

    > Ubuntu Server için;

    MySQL sunucusuna erişip aşağıdaki kodu çalıştırın. ({PATH} yazan yere proje dosyanızın konumunu yazınız.)

        source {PATH}\api\database\database_scripts.sql;

3. Projenin çalıştırılacağı ortamda Zookeeper ve Kafka Server çalışıyor olmalıdır.

    > Ubuntu Server için;

    * "https://downloads.apache.org/kafka/2.6.1/kafka_2.13-2.6.1.tgz" adresinden Kafka'yı indirebilirsiniz.
    * Kafka'nın yüklü olduğu klasörde _"bin/zookeeper-server-start.sh config/zookeeper.properties"_ komutunu çalıştırarak Zookeeper'ı başlatabilirsiniz.
    * Kafka'nın yüklü olduğu klasörde _"bin/kafka-server-start.sh config/server.properties"_ komutunu çalıştırarak Kafka Server'ı başlatabilirsiniz.

4. Projenin Apache Kafka ile çalışabilmesi için _"LogTopic"_ adında bir topic oluşturulmalıdır.

    >Ubuntu Server için;

    * Kafka'nın yüklü olduğu klasörde _"bin/kafka-topics.sh --create --zookeeper localhost:2181 --replication-factor 1 --partitions 1 --topic LogTopic"_ komutu çalıştırılarak _2181_ portunda çalışan _"LogTopic"_ isminde bir topic oluşturabilirsiniz.

5. Proje dizininde yer alan "consumer.php" programını çalıştırılmalıdır.

    >Ubuntu Server için;

        php consumer.php
