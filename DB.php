<?php


    class DB{

        function con(){
            $host = "localhost";
            $db = "employee_information";
            $user = "root";
            $pass = "";

            return new PDO("mysql:host=$host;dbname=$db;",$user,$pass);
        }

        function getEm($query,$params = []){ //get Them inshort - getEm - means getting them (the data) in the database
            $stmt = DB::con()->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll();
        }
    }