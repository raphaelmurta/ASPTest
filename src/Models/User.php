<?php

namespace ASPTest\Models;

use ASPTest\Database\Connect as Database;
use PDO;

class User
{

      public static function create(object $request){
        $db = Database::conn();
        $age = isset($request->age) ? $request->age : null;

        $sql = "INSERT
          INTO `users` (first_name, last_name, email, age)
          VALUES(?,?,?,?)";

        $stm = $db->prepare($sql);
        $stm->bindValue(1, $request->first_name, PDO::PARAM_STR);
        $stm->bindValue(2, $request->last_name, PDO::PARAM_STR);
        $stm->bindValue(3, $request->email, PDO::PARAM_STR);
        $stm->bindValue(4, $age, PDO::PARAM_STR);

        return $stm->execute();
      }

      public static function generatePwd(object $request){
        $db = Database::conn();

        $sql = "UPDATE users SET password = ?  WHERE id = ?";
        $stm = $db->prepare($sql);
        $stm->bindValue(1, $request->password, PDO::PARAM_STR);
        $stm->bindValue(2, $request->id, PDO::PARAM_STR);

        return $stm->execute();
      }

      public static function find($data){
        $db = Database::conn();

        $sql = "SELECT * FROM users WHERE $data[0] = ? ";
        $stm = $db->prepare($sql);
        $stm->bindValue(1, $data[1], PDO::PARAM_STR);
        $stm->execute();

        return $stm;
      }

      public static function findLast(){
        $db = Database::conn();
        $sql = "SELECT * FROM users ORDER BY id DESC LIMIT 1 ";
        $stm = $db->prepare($sql);
        $stm->execute();

        return $stm->fetchObject();
      }
}
