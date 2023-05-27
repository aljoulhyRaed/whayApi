<?php

namespace App\Http\Controllers;

use App\Models\Ayah;
use App\Models\Surah;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use function PHPSTORM_META\type;

class SurahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $url = 'http://api.alquran.cloud/v1/surah';

        // $data = Http::get($url);




        // foreach ($data["data"] as $s) {

        //     Surah::create([
        //         's_no' => $s['number'], 'name_ar' => $s['name'],
        //         'name_en' => $s['englishName'],
        //         'name_en_t' => $s['englishNameTranslation'],
        //         'type' => $s['revelationType'] == 'Meccan' ? false : true
        //     ]);
        // }


        foreach (Surah::orderBy('id', 'desc')->paginate(5) as $sr) {

            $url = 'http://api.alquran.cloud/v1/surah/' . $sr->s_no;

            //            echo $url;
            $data = Http::get($url);




            foreach ($data["data"]["ayahs"] as $ay) {

                try {

                    Ayah::updateOrCreate(
                        ['no_all' => $ay['number']],
                        [
                            'ayah_no' => $ay['numberInSurah'],
                            'no_all' => $ay['number'],
                            'verse' => $ay['text'],
                            'sajda' => gettype($ay['sajda']) == "boolean" ? false : true,
                            'surah_id' => $sr->id
                        ]
                    );
                } catch (Exception $e) {


                    $hh = false;
                    return [
                        'ay' => $ay,
                        'typeof' => gettype($hh),
                        'error' => $e->getMessage()
                    ];
                }
            }
        }


        return Ayah::first();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Surah  $surah
     * @return \Illuminate\Http\Response
     */
    public function show(Surah $surah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Surah  $surah
     * @return \Illuminate\Http\Response
     */
    public function edit(Surah $surah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Surah  $surah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Surah $surah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Surah  $surah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Surah $surah)
    {
        //
    }
}
