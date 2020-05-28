<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Question
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $alias 别名
 * @property string|null $question 题干
 * @property int|null $type 类型
 * @property int|null $parentId 父题干ID
 * @property string|null $tags 题目标签,如 1,2,3
 * @property string|null $analysis 题目解析
 * @property int|null $click_count 点击量
 * @property int|null $test_count 测试量
 * @property int|null $pass_count 通过量
 * @property int|null $itemCount 题目数量
 * @property int|null $commentCount 评论数
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereAnalysis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereClickCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereCommentCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereItemCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question wherePassCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereTestCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Answer[] $answer 答案
 * @property-read int|null $answer_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereAnswer($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Answer[] $option
 * @property-read int|null $option_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Answer[] $options
 * @property-read int|null $options_count
 */
class Question extends Model
{

    protected $table = 'exam_question';

    public function options()
    {
        return $this->hasMany(Answer::class,'question_id','id');
    }



}