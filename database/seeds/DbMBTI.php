<?php

use Illuminate\Database\Seeder;

class DbMBTI extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mbtis')->insert(array(
          array('mbti_type' => 'ISTJ'),
          array('mbti_type' => 'ISFJ'),
          array('mbti_type' => 'INFJ'),
          array('mbti_type' => 'INTJ'),
          array('mbti_type' => 'ISTP'),
          array('mbti_type' => 'ISFP'),
          array('mbti_type' => 'INFP'),
          array('mbti_type' => 'INTP'),
          array('mbti_type' => 'ESTP'),
          array('mbti_type' => 'ESFP'),
          array('mbti_type' => 'ENFP'),
          array('mbti_type' => 'ENTP'),
          array('mbti_type' => 'ESTJ'),
          array('mbti_type' => 'ESFJ'),
          array('mbti_type' => 'ENFJ'),
          array('mbti_type' => 'ENTJ'),
        ));
    }
}
