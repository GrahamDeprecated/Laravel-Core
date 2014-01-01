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

namespace GrahamCampbell\Core\Providers\Interfaces;

/**
 * This is the base provider interface.
 *
 * @package    Laravel-Core
 * @author     Graham Campbell
 * @copyright  Copyright 2013-2014 Graham Campbell
 * @license    https://github.com/GrahamCampbell/Laravel-Core/blob/develop/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Laravel-Core
 */
interface BaseProviderInterface
{
    /**
     * Create a new model.
     *
     * @param  array  $input
     * @return mixed
     */
    public function create(array $input);

    /**
     * Find an existing model.
     *
     * @param  int    $id
     * @param  array  $columns
     * @return mixed
     */
    public function find($id, array $columns = array('*'));

    /**
     * Find all models.
     *
     * @param  array  $columns
     * @return mixed
     */
    public function all(array $columns = array('*'));

    /**
     * Get a list of the models.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index();

    /**
     * Get the number of rows.
     *
     * @return int
     */
    public function count();
}