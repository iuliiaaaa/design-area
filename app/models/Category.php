<?php

namespace App\models;
use App\helpers\Connection;

class Category{
    //получаем все категории
    public static function getAll(){
        $query = Connection::make()->query("SELECT * FROM categories");
        return $query->fetchAll();
    }

    public static function getMainCategory(){
        $query = Connection::make()->query("SELECT * FROM categories WHERE main=1");

        return $query->fetchAll();
    }

    public static function getCountCategory($id){
        $query = Connection::make()->prepare("SELECT COUNT(name) as ct FROM products WHERE category_id=:id and is_published=1");
        $query->execute([
            "id" => $id,
        ]);
        return $query->fetch();
    }

    public static function deleteCategory($id)
    { 
        $query = Connection::make()->prepare("DELETE FROM categories WHERE id = :id ");

        $query->execute([
            "id" => $id,
        ]);
    }
    
    public static function addCategory($name,$small_description,  $main, $img)
    {
        $query =  Connection::make()->prepare('INSERT INTO categories (id, name, small_description, main, img) VALUES (NULL, :name, :small_description, :main, :img)');

        $query->execute([
        'name' => $name,
        'small_description' => $small_description,
        'main' => $main,
        'img' => $img
        ]);

    }

    public static function editCategory($name, $id, $small_des, $main, $img)
    {
        $query =  Connection::make()->prepare('UPDATE categories SET name = :name, small_description = :small_des, main = :main, img = :img WHERE id = :id');

        $query->execute([
        'name' => $name,
        'id' => $id,
        'small_des' => $small_des,
        'main' => $main,
        'img' => $img,

    ]);

        return Connection::make()->lastInsertId();
    }

    public static function sort($id){
        $query = Connection::make()->prepare("SELECT products.id, products.name, products.price, products.photo, products.description, categories.name as category, updated_at FROM products INNER JOIN categories ON products.category_id = categories.id WHERE products.category_id = :id");

        $query->execute([
            'id' => $id
        ]);

        return $query->fetchAll();
    }

    public static function find($id){
        $query = Connection::make()->prepare("SELECT * FROM categories WHERE categories.id=?");
        $query->execute([$id]);

        return $query->fetch();
    }
}