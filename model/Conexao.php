<?php
class Conexao
{
    public function conectar()
    {
        $host = "localhost";
        $username = "root";
        $password = "";
        $db = "testephp_1";

        $conexao = mysqli_connect($host, $username, $password, $db);
        $query = "select * from usuario";
        $result = mysqli_query($conexao,  $query);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<pre>";
            print_r($row);
            echo "</pre>";
        }
    }
}
