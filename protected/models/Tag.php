<?php

/**
 * This is the model class for table "{{tag}}".
 *
 * The followings are the available columns in table '{{tag}}':
 * @property string $id
 * @property integer $user
 * @property integer $parent_tag
 * @property string $tag_name
 * @property string $created
 * @property string $modified
 */
class Tag extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{tag}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user, tag_name', 'required'),
            array('user, parent_tag', 'numerical', 'integerOnly' => true),
            array('tag_name', 'length', 'max' => 150),
            array('created, modified', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user, parent_tag, tag_name, created, modified', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user' => 'User',
            'parent_tag' => 'Parent Tag',
            'tag_name' => 'Tag Name',
            'created' => 'Created On',
            'modified' => 'Modofied On',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->alias = 't';
        $criteria->condition = 't.user IN(0,' . Yii::app()->user->id . ') OR t.user IS NULL';

        $criteria->compare('t.id', $this->id, true);
        $criteria->compare('t.user', $this->user);
        $criteria->compare('t.parent_tag', $this->parent_tag);
        $criteria->compare('t.tag_name', $this->tag_name, true);
        $criteria->compare('t.created', $this->created, true);
        $criteria->compare('t.modified', $this->modified, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->params['pageSize'],
            ),
            'sort' => array('defaultOrder' => 't.tag_name'),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Tag the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function get_tag($id) {
        $value = Tag::model()->findByAttributes(array('id' => $id));
        if (empty($value->tag_name)) {
            return null;
        } else {
            return $value->tag_name;
        }
    }

    public static function get_user($id) {
        $value = Tag::model()->findByAttributes(array('id' => $id));
        if (empty($value->user)) {
            return null;
        } else {
            return $value->user;
        }
    }

    public static function get_tags($id) {
        $model = Transaction::model()->findByPk($id);
        if (!empty($model->tag)) {
            $exval = explode(',', $model->tag);
            $tags = '';
            $total = count($exval);
            $total_minus = ($total - 1);
            for ($i = 0; $i < $total; $i++) {
                //$tags .= '<span class="label label-warning">' . Tag::get_tag($exval[$i]) . '</span> ';
                $tags .= CHtml::link(Tag::get_tag($exval[$i]), array('transaction/tag', 'id' => $exval[$i]), array('data-placement' => 'bottom', 'title' => Tag::get_tag($exval[$i]), 'rel' => 'tooltip', 'data-original-title' => Tag::get_tag($exval[$i]), 'class' => 'btn btn-xs btn-info')) . ' ';
            }
        } else {
            $tags = null;
        }
        return $tags;
    }

    public static function get_tag_new($model, $field) {
        $parent1 = Yii::app()->db->createCommand()
                ->select('id,parent_tag,tag_name')
                ->from('{{tag}}')
                ->where('parent_tag=0 AND user IN(0,' . Yii::app()->user->id . ')')
                ->order('parent_tag,tag_name')
                ->queryAll();
        $option = '<select id="' . $model . '_' . $field . '" name="' . $model . '[' . $field . ']" class="select2">';
        $option .= '<option value="">All</option>';
        foreach ($parent1 as $key => $values1) {
            $option .= '<option value="' . $values1["id"] . '" class="text-primary">&Hopf; ' . $values1["tag_name"] . '</option>';
            $parent2 = Yii::app()->db->createCommand()
                    ->select('id,parent_tag,tag_name')
                    ->from('{{tag}}')
                    ->where('parent_tag=' . $values1["id"] . ' AND user IN(0,' . Yii::app()->user->id . ')')
                    ->order('tag_name')
                    ->queryAll();
            foreach ($parent2 as $key => $values2) {
                $option .= '<option value="' . $values2["id"] . '" class="text-success">&rAarr; ' . $values2["tag_name"] . '</option>';
                $parent3 = Yii::app()->db->createCommand()
                        ->select('id,parent_tag,tag_name')
                        ->from('{{tag}}')
                        ->where('parent_tag=' . $values2["id"] . ' AND user IN(0,' . Yii::app()->user->id . ')')
                        ->order('tag_name')
                        ->queryAll();
                foreach ($parent3 as $key => $values3) {
                    $option .= '<option value="' . $values3["id"] . '" class="text-danger">&DoubleRightArrow; ' . $values3["tag_name"] . '</option>';
                    $parent4 = Yii::app()->db->createCommand()
                            ->select('id,parent_tag,tag_name')
                            ->from('{{tag}}')
                            ->where('parent_tag=' . $values3["id"] . ' AND user IN(0,' . Yii::app()->user->id . ')')
                            ->order('tag_name')
                            ->queryAll();
                    foreach ($parent4 as $key => $values4) {
                        $option .= '<option value="' . $values4["id"] . '" class="text-warning">&srarr; ' . $values4["tag_name"] . '</option>';
                    }
                }
            }
        }
        $option .= '</select>';

        return $option;
    }

    public static function get_tag_edit($model, $field, $id) {
        $parent1 = Yii::app()->db->createCommand()
                ->select('id,parent_tag,tag_name')
                ->from('{{tag}}')
                ->where('parent_tag=0 AND user IN(0,' . Yii::app()->user->id . ')')
                ->order('parent_tag,tag_name')
                ->queryAll();
        $option = '<select id="' . $model . '_' . $field . '" name="' . $model . '[' . $field . ']" class="select2">';
        $option .= '<option value="">All</option>';
        foreach ($parent1 as $key => $values1) {
            if ($id == $values1["id"]) {
                $option .= '<option selected="selected" value="' . $values1["id"] . '" class="text-primary">&Hopf; ' . $values1["tag_name"] . '</option>';
            } else {
                $option .= '<option value="' . $values1["id"] . '" class="text-primary">&Hopf; ' . $values1["tag_name"] . '</option>';
            }
            $parent2 = Yii::app()->db->createCommand()
                    ->select('id,parent_tag,tag_name')
                    ->from('{{tag}}')
                    ->where('parent_tag=' . $values1["id"] . ' AND user IN(0,' . Yii::app()->user->id . ')')
                    ->order('tag_name')
                    ->queryAll();
            foreach ($parent2 as $key => $values2) {
                if ($id == $values2["id"]) {
                    $option .= '<option selected="selected"value="' . $values2["id"] . '" class="text-success">&rAarr; ' . $values2["tag_name"] . '</option>';
                } else {
                    $option .= '<option value="' . $values2["id"] . '" class="text-success">&rAarr; ' . $values2["tag_name"] . '</option>';
                }
                $parent3 = Yii::app()->db->createCommand()
                        ->select('id,parent_tag,tag_name')
                        ->from('{{tag}}')
                        ->where('parent_tag=' . $values2["id"] . ' AND user IN(0,' . Yii::app()->user->id . ')')
                        ->order('tag_name')
                        ->queryAll();
                foreach ($parent3 as $key => $values3) {
                    if ($id == $values3["id"]) {
                        $option .= '<option selected="selected" value="' . $values3["id"] . '" class="text-danger">&DoubleRightArrow; ' . $values3["tag_name"] . '</option>';
                    } else {
                        $option .= '<option value="' . $values3["id"] . '" class="text-danger">&DoubleRightArrow; ' . $values3["tag_name"] . '</option>';
                    }
                    $parent4 = Yii::app()->db->createCommand()
                            ->select('id,parent_tag,tag_name')
                            ->from('{{tag}}')
                            ->where('parent_tag=' . $values3["id"] . ' AND user IN(0,' . Yii::app()->user->id . ')')
                            ->order('tag_name')
                            ->queryAll();
                    foreach ($parent4 as $key => $values4) {
                        if ($id == $values4["id"]) {
                            $option .= '<option selected="selected"value="' . $values4["id"] . '" class="text-warning">&srarr; ' . $values4["tag_name"] . '</option>';
                        } else {
                            $option .= '<option value="' . $values4["id"] . '" class="text-warning">&srarr; ' . $values4["tag_name"] . '</option>';
                        }
                    }
                }
            }
        }
        $option .= '</select>';

        return $option;
    }

}
