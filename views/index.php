<!--
  ~ yasmf - Yet Another Simple MVC Framework (For PHP)
  ~     Copyright (C) 2019   Franck SILVESTRE
  ~
  ~     This program is free software: you can redistribute it and/or modify
  ~     it under the terms of the GNU Affero General Public License as published
  ~     by the Free Software Foundation, either version 3 of the License, or
  ~     (at your option) any later version.
  ~
  ~     This program is distributed in the hope that it will be useful,
  ~     but WITHOUT ANY WARRANTY; without even the implied warranty of
  ~     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  ~     GNU Affero General Public License for more details.
  ~
  ~     You should have received a copy of the GNU Affero General Public License
  ~     along with this program.  If not, see <https://www.gnu.org/licenses/>.
  -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>all_user</title>
</head>
<body>
<?php
spl_autoload_extensions(".php");
spl_autoload_register();

use yasmf\HttpHelper;
?>
<h1>ALL USERS</h1>
<form method="POST" action>
    <p>start with letter :
        <input type="lettre" name="lettre" /> and status is
        <select name="status">
            <option>Active account</option>
            <option>Waiting for account validation</option>
            <option>Waiting for account deletion</option>
        </select>
        <input type ="submit" value="Valider"></p>
</form>



<table>
    <tr>
        <th>ID&nbsp;&nbsp;&nbsp;</th>
        <th>Username&nbsp;&nbsp;&nbsp;</th>
        <th>Email&nbsp;&nbsp;&nbsp;</th>
        <th>Status</th>
    </tr>

</table>


</body>
</html>