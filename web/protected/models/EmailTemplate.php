<?php
/**
 * EmailTemplate.php
 * The system email template model for the DSP
 *
 * This file is part of the DreamFactory Document Service Platform (DSP)
 * Copyright (c) 2012-2013 DreamFactory Software, Inc. <developer-support@dreamfactory.com>
 *
 * This source file and all is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 *
 * Columns:
 *
 * @property integer             $id
 * @property string              $name
 * @property string              $description
 * @property string              $subject
 * @property string              $body_text
 * @property string              $body_html
 * @property string              $defaults
 *
 * Relations:
 *
 */
class EmailTemplate extends BaseDspSystemModel
{
	/**
	 * Returns the static model of the specified AR class.
	 *
	 * @param string $className active record class name.
	 *
	 * @return Role the static model class
	 */
	public static function model( $className = __CLASS__ )
	{
		return parent::model( $className );
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return static::tableNamePrefix() . 'email_template';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		$_rules = array(
			array( 'name', 'required' ),
			array( 'name', 'unique', 'allowEmpty' => false, 'caseSensitive' => false ),
			array( 'name', 'length', 'max' => 64 ),
			array( 'subject', 'length', 'max' => 80 ),
			array( 'description, body_text, body_html, defaults', 'safe' ),
			array( 'id, name', 'safe', 'on' => 'search' ),
		);

		return array_merge( parent::rules(), $_rules );
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		$_relations = array();

		return array_merge( parent::relations(), $_relations );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$_labels = array(
			'name'        => 'Name',
			'description' => 'Description',
			'subject'     => 'Subject',
			'body_text'   => 'Body Text Format',
			'body_html'   => 'Body HTML Format',
			'defaults'    => 'Default Values',
		);

		return array_merge( parent::attributeLabels(), $_labels );
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$_criteria = new CDbCriteria();

		$_criteria->compare( 'id', $this->id );
		$_criteria->compare( 'name', $this->name, true );
		$_criteria->compare( 'subject', $this->subject );
		$_criteria->compare( 'created_date', $this->created_date, true );
		$_criteria->compare( 'last_modified_date', $this->last_modified_date, true );
		$_criteria->compare( 'created_by_id', $this->created_by_id );
		$_criteria->compare( 'last_modified_by_id', $this->last_modified_by_id );

		return new CActiveDataProvider(
			$this,
			array(
				 'criteria' => $_criteria,
			)
		);
	}

	/**
	 * {@InheritDoc}
	 */
	protected function beforeSave()
	{
		if ( is_array( $this->defaults ) )
		{
			$this->defaults = json_encode( $this->defaults );
		}

		return parent::beforeSave();
	}

	/**
	 * {@InheritDoc}
	 */
	public function afterFind()
	{
		if ( isset( $this->defaults ) )
		{
			$this->defaults = json_decode( $this->defaults, true );
		}
		else
		{
			$this->defaults = array();
		}

		parent::afterFind();
	}

	/**
	 * @param string $requested
	 * @param array  $columns
	 * @param array  $hidden
	 *
	 * @return array
	 */
	public function getRetrievableAttributes( $requested, $columns = array(), $hidden = array() )
	{
		return parent::getRetrievableAttributes(
			$requested,
			array_merge(
				array(
					 'name',
					 'description',
					 'subject',
					 'body_text',
					 'body_html',
					 'defaults',
				),
				$columns
			),
			$hidden
		);
	}
}