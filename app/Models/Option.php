<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Option extends Model
{
    protected $fillable = ['question_id', 'question_option_title', 'is_answer'];

    public static function quiztionOptions($request, $id){
        try {
            $rule = [
                'question_option_title' 		=> 'Required',
            ];
            $validation = Validator::make($request, $rule);
            if ($validation->fails()) {
                return false;
            }
            else {
                DB::beginTransaction();
                if($request['type'] == "Free text"){
                    Option::create([
                        'question_id'               =>$id,
                        'question_option_title'     =>$request['question_option_free_text'],
                        'is_answer'                 =>0,
                    ]);
                }else if($request['type'] == "Multiple choice"){
                    foreach ($request['question_option_title'] as $key => $question){
                        Option::create([
                            'question_id'               =>$id,
                            'question_option_title'     =>$question,
                            'is_answer'                 =>(isset($request['is_answer'][$key])) ? '1' : '0',
                        ]);
                    }
                }else if($request['type'] == "True/false"){

                    if($request['is_answer'] == 1){
                        Option::create([
                            'question_id'               => $id,
                            'question_option_title'     => 'true',
                            'is_answer'                 => (isset($request['is_answer'])) ? '1' : '0',
                        ]);
                    } else {
                        Option::create([
                            'question_id'               => $id,
                            'question_option_title'     => 'false',
                            'is_answer'                 => (isset($request['is_answer'])) ? '0' : '1',
                        ]);
                    }

                }else if($request['type'] == "Single Choice"){
                    foreach ($request['question_option_title_single'] as $key => $question){
                        Option::create([
                            'question_id'               =>$id,
                            'question_option_title'     =>$question,
                            'is_answer'                 =>(isset($request['is_answer'][$key])) ? '1' : '0',
                        ]);
                    }
                }else if($request['type'] == "Fill in the blanks"){
                    foreach ($request['question_option_title_fill_blank'] as $key => $question){
                        Option::create([
                            'question_id'               =>$id,
                            'question_option_title'     =>$question,
                            'is_answer'                 =>0,
                        ]);
                    }
                }else {
                    echo "Please select Type?";
                }
                DB::commit();
                return true;
            }
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }

    }
}
