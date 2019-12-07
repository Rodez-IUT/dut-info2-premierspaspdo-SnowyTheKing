<?php

namespace controllers;
date_default_timezone_set('Europe/Paris');
use yasmf\HttpHelper;
use yasmf\View;

/**
 * yasmf - Yet Another Simple MVC Framework (For PHP)
 *     Copyright (C) 2019   Franck SILVESTRE
 *
 *     This program is free software: you can redistribute it and/or modify
 *     it under the terms of the GNU Affero General Public License as published
 *     by the Free Software Foundation, either version 3 of the License, or
 *     (at your option) any later version.
 *
 *     This program is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *     GNU Affero General Public License for more details.
 *
 *     You should have received a copy of the GNU Affero General Public License
 *     along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

class HelloWorldController
{
    public function doQuery($pdo)
    {
        if (isset($_POST['lettre'])) {

            /*
            * Mettre ici le code avec une requête en 'query'
            */

            //Si une lettre est demandé on va filtrer
            //Le prepare va permettre d'utiliser le excecute en bas pour pouvoir remplacer "username" et "name" par les valeurs
            //qui seront récuprées par le POST
            //Query exécute directement la requête.
            //requeête préparé en dessous
            $stmt = $pdo->prepare("SELECT users.*, status.name                     
										FROM users 
					                    JOIN status ON users.status_id = status.id  
										WHERE name = :name AND username LIKE :username");
            $retour = $stmt->execute(array('username' => $_POST['lettre'] . "%", 'name' => $_POST['status']));
            while ($row = $stmt->fetch()) {
                ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['name']; ?>
                        <?php
                        if ($row['name'] != "Waiting for account deletion") {
                            ?>
                            <a href="all_users.php?status_id=3&user_id=<?php echo $row['id']; ?>&action=askDeletion">
                                ask for deletion</a>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <?php
            }
        }

    }

    public function insert($pdo){
        if( isset($_GET['action'])){
            if($_GET['action']== 'askDeletion'){
                $insert = $pdo->prepare("INSERT INTO my_activities.action_log (action_date, action_name, user_id)
														VALUES (:actionDate, :actionName, :userId)
														");
                $retour = $insert->execute(array(date('Y-m-d H:i:s'),'actionName'=> $_GET['action'],
                    'userId'=> $_GET['user_id']));


                //throw new Exception	("t'es nul");
                $bascule = $pdo->prepare("UPDATE my_activities.users
														SET status_id = '3'
														WHERE id = :userid
														");
                $retour = $bascule->execute(array('userid' =>$_GET['user_id']));
            }
        }
    }

}