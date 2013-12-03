<?php namespace GrahamCampbell\Core\Models;

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
 *
 * @package    Laravel-Core
 * @author     Graham Campbell
 * @license    Apache License
 * @copyright  Copyright 2013 Graham Campbell
 * @link       https://github.com/GrahamCampbell/Laravel-Core
 */

use Illuminate\Database\Eloquent\Model as Eloquent;
use GrahamCampbell\Core\Models\Interfaces\IBaseModel;
use GrahamCampbell\Core\Models\Common\TraitBaseModel;

abstract class BaseModel extends Eloquent implements IBaseModel {

    use TraitBaseModel;

    /**
     * A list of methods protected from mass assignment.
     *
     * @var array
     */
    protected $guarded = array('_token', '_method', 'id');

}
