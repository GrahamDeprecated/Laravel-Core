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

namespace GrahamCampbell\Core\Models\Common;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event as LaravelEvent;

/**
 * This is the base model trait.
 *
 * @package    Laravel-Core
 * @author     Graham Campbell
 * @copyright  Copyright 2013-2014 Graham Campbell
 * @license    https://github.com/GrahamCampbell/Laravel-Core/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Laravel-Core
 */
trait BaseModelTrait
{
    /**
     * Create a new model.
     *
     * @param  array  $input
     * @return mixed
     */
    public static function create(array $input)
    {
        DB::beginTransaction();

        try {
            LaravelEvent::fire(static::$name.'.creating');
            static::beforeCreate($input);
            $return = parent::create($input);
            static::afterCreate($input, $return);
            LaravelEvent::fire(static::$name.'.created');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $return;
    }

    /**
     * Before creating a new model.
     *
     * @param  array  $input
     * @return mixed
     */
    public static function beforeCreate(array $input)
    {
        // can be overwritten by extending class
    }

    /**
     * After creating a new model.
     *
     * @param  array  $input
     * @param  mixed  $return
     * @return mixed
     */
    public static function afterCreate(array $input, $return)
    {
        // can be overwritten by extending class
    }

    /**
     * Update an existing model.
     *
     * @param  array  $input
     * @return mixed
     */
    public function update(array $input = array())
    {
        DB::beginTransaction();

        try {
            LaravelEvent::fire(static::$name.'.updating', $this);
            $this->beforeUpdate($input);
            $return = parent::update($input);
            $this->afterUpdate($input, $return);
            LaravelEvent::fire(static::$name.'.updated', $this);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $return;
    }

    /**
     * Before updating an existing new model.
     *
     * @param  array  $input
     * @return mixed
     */
    public function beforeUpdate(array $input)
    {
        // can be overwritten by extending class
    }

    /**
     * After updating an existing model.
     *
     * @param  array  $input
     * @param  mixed  $return
     * @return mixed
     */
    public function afterUpdate(array $input, $return)
    {
        // can be overwritten by extending class
    }

    /**
     * Delete an existing model.
     *
     * @return mixed
     */
    public function delete()
    {
        DB::beginTransaction();

        try {
            LaravelEvent::fire(static::$name.'.deleting', $this);
            $this->beforeDelete();
            $return = parent::delete();
            $this->afterDelete($return);
            LaravelEvent::fire(static::$name.'.deleted', $this);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $return;
    }

    /**
     * Before deleting an existing model.
     *
     * @return mixed
     */
    public function beforeDelete()
    {
        // can be overwritten by extending class
    }

    /**
     * After deleting an existing model.
     *
     * @param  mixed  $return
     * @return mixed
     */
    public function afterDelete($return)
    {
        // can be overwritten by extending class
    }
}
