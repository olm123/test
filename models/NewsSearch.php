<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\News;

/**
 * NewsSearch represents the model behind the search form about `app\models\News`.
 */
class NewsSearch extends News
{
    const STATUS_DISABLE = 0;
    const STATUS_ACTIVE = 1;

    public $date_from;
    public $date_to;
    public $status_active;
    public $status_non_active;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at', 'status', 'author'], 'integer'],
            [['status_active', 'status_non_active'], 'boolean'],
            [['name', 'preview_text', 'full_text',  'date_from',  'date_to', 'image'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = News::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['attributes' => [
                'created_at',
            ]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'author' => $this->author,
            'status' => $this->status,
        ]);


        if ($this->date_from != null) {
            $query->andFilterWhere(['>=', 'created_at', \Yii::$app->formatter->asTimestamp($this->date_from)]);
        }
        if ($this->date_to != null) {
            $query->andFilterWhere(['<=', 'created_at', \Yii::$app->formatter->asTimestamp($this->date_to)]);
        }

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'preview_text', $this->preview_text])
            ->andFilterWhere(['like', 'full_text', $this->full_text])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
