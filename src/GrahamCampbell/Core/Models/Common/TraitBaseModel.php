<?php namespace GrahamCampbell\Core\Models\Common;

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

use Carbon\Carbon;
use Illuminate\Support\Facades\Event as LaravelEvent;

trait TraitBaseModel {

    /**
     * Get the id.
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Get created_at.
     *
     * @return \Carbon\Carbon
     */
    public function getCreatedAt() {
        return new Carbon($this->created_at);
    }

    /**
     * Get updated_at.
     *
     * @return \Carbon\Carbon
     */
    public function getUpdatedAt() {
        return new Carbon($this->updated_at);
    }

    /**
     * Create a new model.
     *
     * @param  array  $input
     * @return mixed
     */
    public static function create(array $input) {
        LaravelEvent::fire(static::$name.'.creating');
        static::beforeCreate($input);
        $return = parent::create($input);
        static::afterCreate($input, $return);
        LaravelEvent::fire(static::$name.'.created');
        return $return;
    }

    /**
     * Before creating a new model.
     *
     * @param  array  $input
     * @return mixed
     */
    public static function beforeCreate(array $input) {}

    /**
     * After creating a new model.
     *
     * @param  array  $input
     * @param  mixed  $return
     * @return mixed
     */
    public static function afterCreate(array $input, $return) {}

    /**
     * Update an existing model.
     *
     * @param  array  $input
     * @return mixed
     */
    public function update(array $input = array()) {
        LaravelEvent::fire(static::$name.'.updating');
        $this->beforeUpdate($input);
        $return = parent::update($input);
        $this->afterUpdate($input, $return);
        LaravelEvent::fire(static::$name.'.updated');
        return $return;
    }

    /**
     * Before updating an existing new model.
     *
     * @param  array  $input
     * @return mixed
     */
    public function beforeUpdate(array $input) {}

    /**
     * After updating an existing model.
     *
     * @param  array  $input
     * @param  mixed  $return
     * @return mixed
     */
    public function afterUpdate(array $input, $return) {}

    /**
     * Delete an existing model.
     *
     * @return mixed
     */
    public function delete() {
        LaravelEvent::fire(static::$name.'.deleting');
        $this->beforeDelete();
        $return = parent::delete();
        $this->afterDelete($return);
        LaravelEvent::fire(static::$name.'.deleted');
        return $return;
    }

    /**
     * Before deleting an existing model.
     *
     * @return mixed
     */
    public function beforeDelete() {}

    /**
     * After deleting an existing model.
     *
     * @param  mixed  $return
     * @return mixed
     */
    public function afterDelete($return) {}

}
