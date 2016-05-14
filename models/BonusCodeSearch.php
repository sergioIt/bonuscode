<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 15.05.16
 * Time: 1:30
 */

namespace app\models;

    use Yii;
    use yii\base\Model;
    use yii\data\ActiveDataProvider;


class BonusCodeSearch extends BonusCode{

    public function rules()
    {
        // only fields in rules() are searchable
        return [
            [['id','status'], 'integer'],
            [['series', 'number','created','expires','used'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = BonusCode::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // load the search form data and validate
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // adjust the query by adding the filters
        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['like', 'series', $this->series])
            ->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'created', $this->created])
            ->andFilterWhere(['like', 'expires', $this->expires])
            ->andFilterWhere(['like', 'used', $this->used])


        ;

        return $dataProvider;
    }

}