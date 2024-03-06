<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Question as ResourcesQuestion;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResourcesQuestion::collection(Question::with('questionnaire')->orderBy('id', 'desc')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'description' => 'required',
                'choice_one' => 'required',
                'choice_two' => 'required',
                'choice_three' => 'required',
                'choice_four' => 'required',
                'response' => 'required|string|max:255',
                'questionnaire_id' => 'required|numeric|exists:questionnaires,id',
                'state' => 'required|string|max:30'
            ]);

            Question::create([
                'description' => trim($request['description']),
                'choice_one' => trim($request['choice_one']),
                'choice_two' => trim($request['choice_two']),
                'choice_three' => trim($request['choice_three']),
                'choice_four' => trim($request['choice_four']),
                'response' => trim($request['response']),
                'questionnaire_id' => trim($request['questionnaire_id']),
                'state' => trim($request['state'])
            ]);

            return response()->json(['message' => 'Question added sucess'], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing your request'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        $question->load('questionnaire');
        return new ResourcesQuestion($question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        try 
        {
            $request->validate([
                'description' => 'required',
                'choice_one' => 'required',
                'choice_two' => 'required',
                'choice_three' => 'required',
                'choice_four' => 'required',
                'response' => 'required|string|max:255',
                'questionnaire_id' => 'required|numeric|exists:questionnaires,id'
            ]);

            $question->update([
                'description' => trim($request['description']),
                'choice_one' => trim($request['choice_one']),
                'choice_two' => trim($request['choice_two']),
                'choice_three' => trim($request['choice_three']),
                'choice_four' => trim($request['choice_four']),
                'response' => trim($request['response']),
                'questionnaire_id' => trim($request['questionnaire_id']),
            ]);

            return response()->json(['message' => 'Question updated sucess'], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing your request'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        try {
            $question->delete();
            return response()->json(['message' => 'Question deleted succes'], 200);
        }catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing your request'], 500);
        }
    }

    public function setstate($id,$newState){
        try 
        {
            $question = Question::find($id);

            $question->update([
                'state' => $newState
            ]);

            return response()->json(['message' => 'Question state updated success'], Response::HTTP_OK);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing your request'], 500);
        }
    }
}
