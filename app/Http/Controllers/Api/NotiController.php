<?php

namespace App\Http\Controllers\Api;


use App\Models\Noti;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\NotiResource;

class NotiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $qb = Noti::query();
        $query = $request->query('q');
        if ($request->has('q')) {
            $data = $qb->where('nameSurname', 'LIKE', "%$query%")->get();
            return NotiResource::collection($data);
        } 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $noti  = new Noti;
        $noti->NameSurname = Str::slug($request->NameSurname);
        $noti->ComeDate  = $request->ComeDate;
        $noti->WhereFrom = $request->WhereFrom;
        $noti->WhoTook = $request->WhoTook;
        $noti->DeliverDate = $request->DeliverDate;
        $noti->save();

        return NotiResource::collection($noti);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Noti  $noti
     * @return \Illuminate\Http\Response
     */
    public function show(Noti $noti)
    {
        return new NotiResource($noti);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Noti  $noti
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Noti $noti)
    {
        $noti->update([
            'NameSurname' => $request->input('NameSurname'),
            'ComeDate' => $request->ComeDate,
            'WhereFrom' => $request->input('WhereFrom'),
            'WhoTook' => $request->input('WhoTook'),
            'DeliverDate' => $request->DeliverDate,
        ]);

        return new NotiResource($noti);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Noti  $noti
     * @return \Illuminate\Http\Response
     */
    public function destroy(Noti $noti)
    {   
        $noti->delete();
        return response(null, 204);
    }

    public function test(Request $request)
    {
        // $path = $request->input('tebligat');
        $path = $request->file('tebligat');
        response()->json(['data' => $path]);
        
        // $path = $request->tebligat->path();  
        // $path = $request->tebligat;
        // $path = storage_path() . '/app/public/test.csv';
        

        // Reading file
        $file = fopen($path, "r");
        // $file =  $request->file('tebligat');
        $importData_arr = array(); // Read through the file and store the contents as an array
        $i = 0;
        //Read the contents of the uploaded file 
        while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) 
        {
            $num = count($filedata);
            // Skip first row (Remove below comment if you want to skip the first row)
            if ($i == 0) {
            $i++;
            continue;
            }
            for ($c = 0; $c < $num; $c++) {
                $importData_arr[$i][] = $filedata[$c];
            }
            $i++;
        }
        fclose($file); //Close after reading

        // print_r($importData_arr);

        foreach($importData_arr as $row)
        {
            $name = $row[0];
            $comeDate = $row[1];
            $whereFrom = $row[2];

            $comeDate = date('Y-m-d',strtotime($comeDate));
            
            $db_row = Noti::where('NameSurname',$name)
            ->where('ComeDate',$comeDate)
            ->first();

            echo $db_row;

            if($db_row) continue;

            Noti::create([
                'NameSurname'=>$name,
                'ComeDate'=>$comeDate,
                'WhereFrom'=>$whereFrom,
            ]);


        }
    }
}
