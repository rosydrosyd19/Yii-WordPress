<?php

namespace app\models;

use Yii;

class FotoPegawai extends model
{
    public $post_id;
    public $post_title;
    public $post_content;
    public $guid;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['post_id'], 'required'],
            [['post_id'], 'default', 'value' => null],
            [['post_id'], 'integer'],
            [['post_title', 'post_content' ,'guid',], 'safe'],
            [['pegawai_id'], 'unique'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'post_id' => 'post_id',
            'post_title' => 'post_title',
            'guid' => 'guid',
        ];
    }
}
