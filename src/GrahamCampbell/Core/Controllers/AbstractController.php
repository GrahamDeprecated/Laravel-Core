<?php

/**
 * This file is part of Laravel Core by Graham Campbell.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace GrahamCampbell\Core\Controllers;

use Illuminate\Routing\Controller;
use GrahamCampbell\Core\Models\Interfaces\IBaseModel;
use GrahamCampbell\Core\Models\Common\TraitBaseModel;

/**
 * This is the abstract controller class.
 *
 * @package    Laravel-Core
 * @author     Graham Campbell
 * @license    Apache License
 * @copyright  Copyright 2013 Graham Campbell
 * @link       https://github.com/GrahamCampbell/Laravel-Core
 */
abstract class AbstractController extends Controller
{
    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

    /**
     * Check ajax request.
     *
     * @return \Illuminate\Http\Response
     */
    protected function checkAjax()
    {
        if (!Request::ajax()) {
            return App::abort(405, 'Ajax Is Required');
        }
    }
}
