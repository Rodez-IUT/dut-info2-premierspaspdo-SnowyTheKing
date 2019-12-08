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

class AllUserController
{
    public function doQuery($pdo)
    {
        $lettre = httpHelper::getParam('lettre') ?: 'lettreTest';
        $status = httpHelper::getParam('status') ?: 'statusid';

        $view = new View ("dut-info2-premierspaspdo-SnowyTheKing/views/index");
        $view -> setVar('lettre', $lettre);
        $view -> setVar('status', $status);
        return $view;

        
        

    }

}