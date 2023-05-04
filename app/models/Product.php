<?php
namespace App\models;
use App\helpers\Connection;

class Product{

    //получаем все товары в наличии остсортированные по новизне
    public static function getAll(){
        $query = Connection::make()->query("SELECT products.id as product_id, products.name as product_name, price, photo, categories.name as category, requests.user_id as user_id, users.is_blocked as block, description, updated_at, requests_id as request, is_published FROM products INNER JOIN categories ON products.category_id = categories.id INNER JOIN requests ON products.requests_id = requests.id INNER JOIN users ON requests.user_id = users.id WHERE products.is_published = 1 AND users.is_blocked = 0 ORDER BY updated_at DESC");

        return $query->fetchAll();
    }

    //ищем товар по id
    public static function find($id){
        $query = Connection::make()->prepare("SELECT products.id as product_id, products.name as product_name, price, photo, products.category_id as cateid, categories.name as category, description, updated_at, requests_id as request, is_published, (SELECT name FROM users WHERE requests.user_id = users.id) as username , (SELECT avatar FROM users WHERE requests.user_id = users.id) as ava, (SELECT vk FROM contacts WHERE contacts.user_id = requests.user_id) as vk, (SELECT telegram FROM contacts WHERE contacts.user_id = requests.user_id) as tg, user_id FROM products INNER JOIN categories ON products.category_id = categories.id INNER JOIN requests ON products.requests_id = requests.id WHERE products.id = ?");

        $query->execute([$id]);

        return $query->fetch();
    }

    //Получаем ппродукты по одной категории
    public static function productsByCategory($id){
        $query = Connection::make()->prepare("SELECT products.id as product_id, products.name as product_name, price, count, release_year, color, image, countries.name as country, categories.name as category, created_at, updated_at FROM products INNER JOIN countries ON products.country_id = countries.id INNER JOIN categories ON products.category_id = categories.id WHERE products.count > 0 AND products.category_id = ?");

        $query->execute([$id]);

        return $query->fetchAll();

    }

    //формируем строку с позиционными параметрами
    private static function getParameter($array){
        return implode(",", array_fill(0, count($array), "?"));
    }

    //получаем товары по нескольким указанным категориям
    public static function getProductsByCategories($categories){
        //формируем параметр запроса
        $parameter = self::getParameter($categories);

        $query = Connection::make()->prepare("SELECT products.id as product_id, products.name as product_name, price, photo, categories.name as category, description, updated_at, requests_id as request, is_published FROM products INNER JOIN categories ON products.category_id = categories.id WHERE category_id in ($parameter) AND  products.is_published = 1 ORDER BY updated_at DESC");

        $query->execute($categories);

        return  $query->fetchAll();
    }

    public static function getComment($id){
        $query = Connection::make()->prepare("SELECT id,content,photo_comment,user_id,date_writing,product_id,(SELECT name FROM users WHERE reviews.user_id = users.id) as username,(SELECT avatar FROM users WHERE reviews.user_id = users.id) as avatar FROM reviews WHERE product_id = ? and (SELECT is_blocked FROM users WHERE reviews.user_id = users.id) =0");

        $query->execute([$id]);

        return $query->fetchAll();

    }

    public static function get3LastProducts($id,$prodid){
        $query = Connection::make()->prepare("SELECT products.id as product_id, products.name as product_name, price, photo, categories.name as category, users.is_blocked as block, description, updated_at, requests_id as request, is_published FROM products INNER JOIN requests ON products.requests_id = requests.id INNER JOIN users ON requests.user_id = users.id INNER JOIN categories ON products.category_id = categories.id WHERE categories.id = ? AND products.is_published = 1 and products.id!=? and users.is_blocked = 0 ORDER BY updated_at DESC LIMIT 4");

        $query->execute([$id,$prodid]);

        return $query->fetchAll();

    }

    public static function get5ProductsTitleCategory($id){
        $query = Connection::make()->prepare("SELECT products.id as product_id, products.name as product_name, price, photo, categories.name as category, users.is_blocked as block, description, updated_at, requests_id as request, is_published FROM products INNER JOIN requests ON products.requests_id = requests.id INNER JOIN users ON requests.user_id = users.id INNER JOIN categories ON products.category_id = categories.id WHERE categories.id = ? AND products.is_published = 1 and users.is_blocked = 0 ORDER BY updated_at DESC LIMIT 5");

        $query->execute([$id]);

        return $query->fetchAll();

    }


    public static function editProduct($id, $name, $price, $description)
    {
        
        $query =  Connection::make()->prepare('UPDATE products SET name = :name, price = :price, description = :description WHERE products.id = :id');
  
        $query->execute([
            "id"=>$id,
            'name' => $name, 
            'price' => $price, 
            'description' => $description
        ]);
    
    }

    public static function getAllProductByUser($id){
        $query = Connection::make()->prepare("SELECT products.id as product_id, products.name as product_name, price, photo, products.category_id as cateid, categories.name as category, description, updated_at, requests_id as request, is_published, (SELECT name FROM users WHERE requests.user_id = users.id) as username, (SELECT vk FROM contacts WHERE contacts.user_id = requests.user_id) as vk, (SELECT telegram FROM contacts WHERE contacts.user_id = requests.user_id) as tg, user_id FROM products INNER JOIN categories ON products.category_id = categories.id INNER JOIN requests ON products.requests_id = requests.id WHERE requests.user_id = ? and is_published =1 and requests.status_id=2");

        $query->execute([$id]);

        return $query->fetchAll();

    }

    public static function getAllProductByUserAndCategory($user_id, $category_id){
        $query = Connection::make()->prepare("SELECT products.id as product_id, products.name as product_name, price, photo, products.category_id as cateid, categories.name as category, description, updated_at, requests_id as request, is_published, (SELECT name FROM users WHERE requests.user_id = users.id) as username, (SELECT vk FROM contacts WHERE contacts.user_id = requests.user_id) as vk, (SELECT telegram FROM contacts WHERE contacts.user_id = requests.user_id) as tg,user_id FROM products INNER JOIN categories ON products.category_id = categories.id INNER JOIN requests ON products.requests_id = requests.id WHERE requests.user_id = ? and is_published =1 and requests.status_id=2 and products.category_id=?");

        $query->execute([$user_id,$category_id]);

        return $query->fetchAll();

    }

    public static function getAllRequestProduct($id){
        $query = Connection::make()->prepare("SELECT products.id as product_id, products.name as product_name, price, photo, products.category_id as cateid, categories.name as category, description, updated_at, requests_id as request, is_published, (SELECT name FROM users WHERE requests.user_id = users.id) as username, (SELECT vk FROM contacts WHERE contacts.user_id = requests.user_id) as vk, (SELECT telegram FROM contacts WHERE contacts.user_id = requests.user_id) as tg, user_id FROM products INNER JOIN categories ON products.category_id = categories.id INNER JOIN requests ON products.requests_id = requests.id WHERE requests.user_id = ? and requests.status_id = 1");

        $query->execute([$id]);

        return $query->fetchAll();

    }

    public static function noProduct($id){
        $query = Connection::make()->prepare("SELECT products.id as product_id, products.name as product_name, price, photo, products.category_id as cateid, categories.name as category, description, updated_at, requests_id as request, is_published, (SELECT name FROM users WHERE requests.user_id = users.id) as username, (SELECT vk FROM contacts WHERE contacts.user_id = requests.user_id) as vk, (SELECT telegram FROM contacts WHERE contacts.user_id = requests.user_id) as tg, user_id FROM products INNER JOIN categories ON products.category_id = categories.id INNER JOIN requests ON products.requests_id = requests.id WHERE requests.user_id = ? and requests.status_id = 3 or requests.user_id = ? and is_published = 0 and requests.status_id != 1");

        $query->execute([$id,$id]);

        return $query->fetchAll();

    }

    public static function searchProductByNameOrUser($name){

        $query = Connection::make()->prepare("SELECT products.id as product_id, products.name as product_name, price, photo, products.category_id as cateid, categories.name as category, description, updated_at, requests_id as request, is_published, (SELECT name FROM users WHERE requests.user_id = users.id) as username, (SELECT contacts FROM contacts WHERE contacts.user_id = requests.user_id) as contact, user_id FROM products INNER JOIN categories ON products.category_id = categories.id INNER JOIN requests ON products.requests_id = requests.id INNER JOIN users ON requests.user_id = users.id WHERE products.name = :productName or users.name = :userName");

        
        $query->execute(["userName" => $name,"productName"=>$name]);

        return $query->fetchAll();

    }

    public static function createReqests($status_id, $user_id){
        $conn =Connection::make();
        $query =  $conn->prepare('INSERT INTO requests (status_id, user_id, date_departures) VALUES ( :status_id, :user_id, :date_departures)');

        $query->execute([
        'status_id' => $status_id, 
        'user_id' => $user_id, 
        'date_departures' => date('Y-m-d')
        ]);

        return $conn->lastInsertId();

    }


    public static function addProduct($name, $price, $photo, $description, $category_id, $requests_id, $is_published)
    {

        $query =  Connection::make()->prepare('INSERT INTO products (name, price, photo, description, category_id, requests_id, updated_at, is_published) VALUES (:name, :price, :photo, :description, :category_id, :requests_id, :updated_at, :is_published)');

        $query->execute([
        'name' => $name, 
        'price' => $price, 
        'photo' => $photo,
        'description' => $description,
        'category_id' => $category_id, 
        'requests_id' => $requests_id, 
        'updated_at' => date('Y-m-d'), 
        'is_published' => $is_published, 

        ]);
  
    }

    public static function getReqIdWhereProdId($id){
        $query =  Connection::make()->prepare("SELECT products.requests_id FROM products WHERE products.id = :id");
        $query->execute([
            'id' => $id
            ]);
            return $query->fetchAll();
    }

    public static function hideProductStatus($id){
        $query = Connection::make()->prepare("UPDATE requests SET status_id = 3 WHERE requests.id = :id");
        $query->execute([
            'id' => $id
            ]);
    }

    public static function hideProductPublish($id){
        $query = Connection::make()->prepare("UPDATE products SET is_published = 0 WHERE products.id = :id");
        $query->execute([
            'id' => $id
            ]);
    }


    public static function getRequest($id){
        $query = Connection::make()->prepare("SELECT *, (SELECT login FROM users WHERE requests.user_id = users.id) as login, (SELECT name FROM statuses WHERE requests.status_id = statuses.id) as status, (SELECT id FROM products WHERE products.requests_id = requests.id) as product_id FROM requests WHERE status_id = :id ORDER BY id DESC" );
        $query->execute([
            'id' => $id
            ]);

            return $query->fetchAll();
    }

    public static function publish($publish, $id){
        $query = Connection::make()->prepare('UPDATE products SET is_published = :publish WHERE products.id = :id;');

        $query->execute([
            'publish'=>$publish,
            'id' => $id
            ]);
    }

    public static function statusChange($status, $requests){
        $query = Connection::make()->prepare('UPDATE requests SET status_id = :status WHERE requests.id = :requests;');

        $query->execute([
            'status' => $status,
            'requests' => $requests
            ]);
    }

    public static function ProductIntitleCategory($name){
        $query = Connection::make()->prepare('SELECT products.id as product_id, products.name as product_name, price, photo, categories.name as category, description, updated_at, requests_id as request, is_published FROM products INNER JOIN categories ON products.category_id = categories.id WHERE products.is_published = 1 and categories.name=:name ORDER BY updated_at DESC');

        $query->execute([
            'name' => $name,
            ]);


        return $query->fetchAll();
    }

}
