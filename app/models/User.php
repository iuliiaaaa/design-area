<?php

namespace App\models;

use App\helpers\Connection;


class User
{
    
    public static function getUser($login, $password)
    {
        $query = Connection::make()->prepare("SELECT * FROM users WHERE users.login = :login");

        $query->execute([':login' => $login]);

        $user = $query->fetch();

        if (password_verify($password, $user->password)) {
            return $user;
        } else return null;
    }

    public static function find($id)
    {
        $query = Connection::make()->prepare("SELECT users.id ,users.name, users.email,users.password, users.login, users.avatar, is_blocked, (SELECT contacts.vk FROM contacts WHERE contacts.user_id = users.id) as vk, (SELECT contacts.telegram FROM contacts WHERE contacts.user_id = users.id) as tg, (SELECT contacts.id FROM contacts WHERE contacts.user_id = users.id) as contact_id FROM users WHERE users.id =?");

        $query->execute([$id]);

        return $query->fetch();
    }

    public static function getAll()
    {
        $query = Connection::make()->query("SELECT users.id ,users.name, users.surname, users.patronymic, users.email, role FROM users ");

        return $query->fetchAll();
    }



    public static function insert($name,$login, $email, $password, $avatar)
    {
        $create = Connection::make()->prepare("INSERT INTO users (id, name, login, email, password, avatar, is_blocked, role) VALUES (NULL, :name, :login, :email, :password, :avatar, :is_blocked, :role);");

        

        return $create->execute([
            "name" => $name,
            "login" => $login,
            "email" => $email,
            "avatar" => $avatar,
            "password" => password_hash($password, PASSWORD_DEFAULT),
            "is_blocked" => 0,
            "role" => "клиент",
        ]);
    }

    public static function delete($id)
    {
        $query = Connection::make()->prepare("DELETE FROM users WHERE id = ?");

        return $query->execute([$id]);
    }

    public static function findLogin($login)
    {
        $query = Connection::make()->prepare("SELECT users.id ,users.name, login, users.email, role FROM users WHERE users.login = ?");

        $query->execute([$login]);
        $res = $query->fetchAll();

        return !empty($res);
    }

    
    public static function findLoginUser($login)
    {
        $query = Connection::make()->prepare("SELECT users.id ,users.name, login, users.email, role FROM users WHERE users.login = ?");

        $query->execute([$login]);

        return $query->fetch();
    }




    public static function findEmailUser($email)
    {
        $query = Connection::make()->prepare("SELECT users.id ,users.name, login, users.email, role FROM users WHERE users.email = ?");

        $query->execute([$email]);

        return $query->fetch();
    }





    public static function findEmail($email)
    {
        $query = Connection::make()->prepare("SELECT users.id ,users.name, login, users.email, role FROM users WHERE users.email = ?");

        $query->execute([$email]);
        $res = $query->fetchAll();

        return !empty($res);
    }

    public static function getLogins()
    {
        $query = Connection::make()->query("SELECT users.login FROM users ");


        return $query->fetchAll();
    }

    //здесь размещаем все методы для работы с таблицей users


    public static function getAdmin($login, $password, $role)
    {
        $query = Connection::make()->prepare("SELECT * FROM users WHERE users.login = :login AND users.role= :role");
        $query->execute([
                ':login' => $login,
                ':role' => $role
        ]);

        $user = $query->fetch();

        if (password_verify($password, $user->password)) {
            return $user;
        } else return null;
    }


    public static function editProfile($id, $name, $login, $email, $avatar,$password,$oldpass)
    {
        $query =  Connection::make()->prepare('UPDATE users SET name = :name, login = :login, email = :email, avatar = :avatar, password = :password WHERE users.id = :id');

        $user = Connection::make()->prepare("SELECT password FROM users WHERE users.id = :id");

        $user->execute([
            "id"=>$id
        ]);

        $user=$user->fetch();

        if (password_verify($oldpass, $user->password)) {
            $query->execute([
                "id"=>$id,
                'name' => $name, 
                'login' => $login, 
                'email' => $email,
                'avatar' => $avatar,
                'password'=>password_hash($password, PASSWORD_DEFAULT)
            ]);
            return $user;
        } else return null;
    }




    public static function editProfileNoPassword($id, $name, $login, $email, $avatar)
    {
        $query =  Connection::make()->prepare('UPDATE users SET name = :name, login = :login, email = :email, avatar = :avatar WHERE users.id = :id;');

            $query->execute([
                "id"=>$id,
                'name' => $name, 
                'login' => $login, 
                'email' => $email,
                'avatar' => $avatar,
            ]);

    }


    public static function createComment($user_id, $content, $photo_comment, $product_id)
    {
        $query =  Connection::make()->prepare('INSERT INTO reviews (user_id, content, photo_comment, date_writing, product_id) VALUES ( :user_id, :content, :photo_comment, :date_writing, :product_id)');

        $query->execute([
            'user_id' => $user_id, 
            'content' => $content, 
            'photo_comment' => $photo_comment,
            'product_id' => $product_id,
            'date_writing' => date('Y-m-d')
        ]);
    
    }


    public static function deleteComment($id)
    {
        $query =  Connection::make()->prepare('DELETE FROM reviews WHERE reviews.id = :id');

        $query->execute([
            'id' => $id
        ]);
    
    }

    public static function getSearchUser($name){
        $query = Connection::make()->prepare('SELECT DISTINCT users.*, (SELECT COUNT(requests.id) FROM requests WHERE requests.status_id = 2 AND requests.user_id = users.id) as count FROM users WHERE users.id IN (SELECT DISTINCT requests.user_id FROM requests WHERE requests.status_id = 2 and users.name LIKE :name or users.login LIKE :name)');

        $query->execute([
            'name' => $name
        ]);
        return $query->fetchAll();
    }

    public static function getUsersAdmin($name){
        $query = Connection::make()->prepare('SELECT DISTINCT users.*, (SELECT COUNT(requests.id) FROM requests WHERE requests.status_id = 2 AND requests.user_id = users.id) as count FROM users WHERE users.name LIKE :name or users.login LIKE :name');

        $query->execute([
            'name' => $name
        ]);
        return $query->fetchAll();
    }

    public static function createContact($user_id,$vk,$tg)
    {
        $create = Connection::make()->prepare("INSERT INTO contacts (id, user_id, vk, telegram) VALUES (NULL, :user_id, :vk, :tg)");

        return $create->execute([
            "user_id" => $user_id,
            "vk"=>$vk,
            "tg" => $tg,
        ]);
    }
    
    public static function editContact($id, $vk, $tg)
    {
        $query =  Connection::make()->prepare('UPDATE contacts SET vk = :vk, telegram = :tg WHERE contacts.id = :id');

        $query->execute([
            "id"=>$id,
            'vk' => $vk,
            'tg' => $tg,
        ]);
    
    }

    public static function getAllAuthor(){
        $query = Connection::make()->query("SELECT DISTINCT users.*, (SELECT COUNT(requests.id) FROM requests WHERE requests.status_id = 2 AND requests.user_id = users.id) as count FROM users WHERE users.id IN (SELECT DISTINCT requests.user_id FROM requests WHERE requests.status_id = 2)");

        return $query->fetchAll();
    }

    public static function getUsers()
    {
        $query = Connection::make()->prepare('SELECT *,(SELECT COUNT(requests.id) FROM requests WHERE requests.status_id = 2 AND requests.user_id = users.id) as count FROM users WHERE role = :role ORDER BY count DESC');

        $query->execute([
            "role"=>'клиент'
        ]);

        return $query->fetchAll();
    }


    public static function block($block)
    {
        $query = Connection::make()->prepare('SELECT *,(SELECT COUNT(requests.id) FROM requests WHERE requests.status_id = 2 AND requests.user_id = users.id) as count FROM users WHERE is_blocked = :block  and role = :role ORDER BY count DESC');

        $query->execute([
            "role"=>'клиент',
            "block"=>$block
        ]);

        return $query->fetchAll();
    }
    
    public static function users(){

        $query = Connection::make()->prepare("SELECT *,(SELECT COUNT(requests.id) FROM requests WHERE requests.status_id = 2 AND requests.user_id = users.id) as count FROM users WHERE (SELECT COUNT(requests.id) FROM requests WHERE requests.status_id = 2 AND requests.user_id = users.id) = 0 and role = :role ORDER BY count DESC");

        $query->execute([
            "role"=>'клиент',
    
        ]);

        return $query->fetchAll();
    }

    public static function banned($banned, $id)
    {
        $query = Connection::make()->prepare("UPDATE users SET is_blocked = :banned WHERE users.id = :id");

        $query->execute([
            "banned"=>$banned,
            "id"=>$id,
        ]);
    }

    public static function allCommentUser($id){
        $query = Connection::make()->prepare("SELECT *, (SELECT photo FROM products WHERE products.id = product_id) as photo FROM reviews WHERE user_id = :id");

        $query->execute([
            "id"=>$id,
        ]);

        return $query->fetchAll();
    }

    public static function getAvatar($login){
        $query = Connection::make()->prepare("SELECT avatar FROM users WHERE login = :login");

        $query->execute([
            "login"=>$login,
        ]);

        return $query->fetch();
    }


    public static function countWork($id){
        $query = Connection::make()->prepare("SELECT DISTINCT (SELECT COUNT(requests.id) FROM requests WHERE requests.status_id = 2 AND requests.user_id = users.id) as pub, (SELECT COUNT(requests.id) FROM requests WHERE requests.status_id = 1 AND requests.user_id = users.id) as req,(SELECT COUNT(requests.id) FROM requests WHERE requests.status_id = 3 AND requests.user_id = users.id) as rej FROM users WHERE users.id =:id");

        $query->execute([
            "id"=>$id,
        ]);

        return $query->fetchAll();
    }

    public static function getAllAuthorAndCount($id){
        $query = Connection::make()->prepare("SELECT users.name as username, users.id, categories.name, COUNT(products.name) as count FROM products INNER JOIN categories ON category_id = categories.id INNER JOIN requests ON requests_id = requests.id INNER JOIN users ON requests.user_id = users.id WHERE requests.status_id = 2 and user_id = :id GROUP BY requests.user_id, categories.name");

        $query->execute([
            "id"=>$id,
        ]);

        return $query->fetchAll();
    }

    public static function AuthorAndCount($id){
        $query = Connection::make()->prepare("SELECT categories.name  as category_name, COUNT(products.name) as count FROM products INNER JOIN categories ON category_id = categories.id INNER JOIN requests ON requests_id = requests.id WHERE requests.status_id = 2 AND requests.user_id = :id GROUP BY categories.name");

        $query->execute([
            "id"=>$id,
        ]);

        return $query->fetchAll();
    }


    public static function getCountAuthor($user_id){
        $query = Connection::make()->prepare("SELECT categories.name, categories.id, COUNT(products.name) as count FROM products INNER JOIN categories ON category_id = categories.id INNER JOIN requests ON requests_id = requests.id WHERE requests.status_id = 2 AND requests.user_id = :user_id GROUP BY categories.id,categories.name");

        $query->execute([
            "user_id"=>$user_id,
        ]);

        return $query->fetchAll();
    }

    public static function getIdAndNameAuthor(){

        $query = Connection::make()->query("SELECT DISTINCT users.id, users.name, users.avatar, users.is_blocked,(SELECT COUNT(requests.id) FROM requests WHERE requests.status_id = 2 AND requests.user_id = users.id) as count FROM users WHERE users.id IN (SELECT DISTINCT requests.user_id FROM requests WHERE requests.status_id = 2) and users.is_blocked =0");

        return $query->fetchAll();
    }
    
    public static function getCategoryAuthor($user_id){
        $query = Connection::make()->prepare("SELECT categories.name,categories.id FROM products INNER JOIN categories ON category_id = categories.id INNER JOIN requests ON requests_id = requests.id WHERE requests.status_id = 2 AND requests.user_id = :user_id GROUP BY categories.id");

        $query->execute([
            "user_id"=>$user_id,
        ]);

        return $query->fetchAll();
    }
    
}
