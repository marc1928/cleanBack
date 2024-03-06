<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Questionnaire as ResourcesQuestionnaire;
use App\Models\Questionnaire;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QuestionnaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResourcesQuestionnaire::collection(Questionnaire::orderByDesc('created_at')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try 
        {
            $request->validate([
                'name' => 'required|string|max:255|unique:questionnaires,name',
                'state' => 'required|string|max:30',
            ]);

            Questionnaire::create([
                'name' => strtoupper(trim($request['name'])),
                'state' => trim($request['state'])
            ]);

            return response()->json(['message' => 'Questionnaire added sucess']);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing your request'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Questionnaire $questionnaire)
    {
       return new ResourcesQuestionnaire($questionnaire);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Questionnaire $questionnaire)
    {
        try 
        {
            $request->validate([
                'name' => 'required|string|max:255'
            ]);

            $questionnaire->update([
                'name' => strtoupper(trim($request['name']))
            ]);

            return response()->json(['message' => 'Questionnaire updated sucess']);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing your request'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $questionnaire = Questionnaire::find($id);

        if (!$questionnaire) {
            return response()->json(['message' => 'Questionnaire introuvable.'], Response::HTTP_NOT_FOUND);
        }

        if ($questionnaire->questions()->exists()) {
            return response()->json(['message' => 'Veuillez d\'abord supprimer le(s) question(s) lié(s) à ce questionnaire.'], Response::HTTP_BAD_REQUEST);
        }

        $questionnaire->delete();

        return response()->json(['message' => 'Questionnaire supprimé avec succès'], Response::HTTP_OK);
    }

    public function setstate($id,$newState){
        try {
            $questionnaire = Questionnaire::find($id);

            $questionnaire->update([
                'state' => $newState
            ]);

            return response()->json(['message' => 'Questionnaire state updated success'], Response::HTTP_OK);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing your request'], 500);
        }
    }
}
