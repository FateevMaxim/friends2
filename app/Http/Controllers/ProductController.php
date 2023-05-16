<?php

namespace App\Http\Controllers;

use App\Imports\TracksImport;
use App\Models\ClientTrackList;
use App\Models\Configuration;
use App\Models\TrackList;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function addChina(Request $request)
    {

        $array =  preg_split("/\s+/", $request["track_codes"]);
        $wordsFromFile = [];
        foreach ($array as $ar){
            $wordsFromFile[] = [
                'track_code' => $ar,
                'to_china' => date(now()),
                'status' => 'Получено в Китае',
                'reg_china' => 1,
                'created_at' => date(now()),
            ];
        }
        TrackList::insertOrIgnore($wordsFromFile);
        return response('success');

    }

    public function almatyIn(Request $request)
    {

        $array =  preg_split("/\s+/", $request["track_codes"]);
        $wordsFromFile = [];
        foreach ($array as $ar){
            $wordsFromFile[] = [
                'track_code' => $ar,
                'to_almaty' => date(now()),
                'status' => 'Получено на складе в Алматы',
                'reg_almaty' => 1,
                'updated_at' => date(now()),
            ];
        }
        TrackList::upsert($wordsFromFile, ['track_code', 'to_almaty', 'status', 'reg_almaty', 'updated_at']);
        return redirect()->back()->with('message', 'Трек код успешно добавлен');

    }

    public  function acceptProduct (Request $request)
    {
        $track_lists = TrackList::query()->where('track_code', $request->track_code)->first();
        $track_lists->status = 'Товар принят';
        $track_lists->client_accept = date(now());
        $track_lists->save();

        $client_track_lists = ClientTrackList::query()->where('track_code', $request->track_code)->first();
        $client_track_lists->status = 'archive';
        $client_track_lists->save();
        return redirect()->back()->with('message', 'Товар успешно доставлен!');
    }

    public function almatyOut(Request $request)
    {
        $status = "Выдано клиенту";
        if ($request["send"] === 'true'){
            $status = "Отправлено в Ваш город";
        }
        $array =  preg_split("/\s+/", $request["track_codes"]);

        $wordsFromFile = [];
        foreach ($array as $ar){
            $wordsFromFile[] = [
                'track_code' => $ar,
                'to_client' => date(now()),
                'status' => $status,
                'reg_client' => 1,
                'updated_at' => date(now()),
            ];
        }
        TrackList::upsert($wordsFromFile, ['track_code', 'to_client', 'status', 'reg_client', 'updated_at']);
        return response('success');

    }
    public function getInfoProduct(Request $request)
    {

        $track_code = ClientTrackList::query()->select('user_id')->where('track_code', $request['track_code'])->first();
        $track_code_statuses =  TrackList::query()->select('to_china', 'to_almaty', 'to_client', 'client_accept')->where('track_code', $request['track_code'])->first();
        if ($track_code){
            $user_data = User::query()->select('name', 'surname', 'login', 'city', 'block')->where('id', $track_code->user_id)->first();
        }else{
            $user_data = [
                'name' => 'нет',
                'surname' => 'нет',
                'login' => 'нет',
                'block' => 'нет',
                'city' => 'нет',
            ];
        }

        return response([$track_code_statuses, $user_data]);

    }


    public function addClient(Request $request)
    {

        if (Str::length($request["track_code"]) > 100){
            return redirect()->back()->with('error', 'Неверный трек, пожалуйста, перепроверьте');
        }

        $issetTrack = ClientTrackList::query()->where('track_code', $request["track_code"])->exists();
        if ($issetTrack){
            return redirect()->back()->with('error', 'Трек код уже добавлен');
        }
        $track_list = new ClientTrackList();
        $track_list->track_code = $request["track_code"];
        $track_list->detail = $request["detail"];
        $track_list->user_id = Auth::user()->id;
        $track_list->save();

        return redirect()->back()->with('message', 'Трек код успешно добавлен');
    }


    public function deleteTrack (Request $request)
    {
        $validated = $request->validate([
            'delete_track' => 'required|string|max:100',
        ]);

        if ($validated){
            $archive = ClientTrackList::query()->select('id')->where('track_code', $request['delete_track'])->first();
            ClientTrackList::destroy($archive->id);
            return redirect()->back()->with('message', 'Трек код успешно удалён');
        }

    }

    public function archiveProduct (Request $request)
    {
        $validated = $request->validate([
            'archive_track' => 'required|string|max:100',
        ]);

        if ($validated){
            $archive = ClientTrackList::query()->where('track_code', $request['archive_track'])->first();
            $archive->status = 'archive';
            $archive->save();
            return redirect()->back()->with('message', 'Трек код успешно добавлен в архив');
        }

    }

    public function unArchiveProduct (Request $request)
    {
        $validated = $request->validate([
            'archive_track' => 'required|string|max:100',
        ]);

        if ($validated){
            $archive = ClientTrackList::query()->where('track_code', $request['archive_track'])->first();
            $archive->status = null;
            $archive->save();
            return redirect()->back()->with('message', 'Трек код успешно извлечён из архива');
        }

    }

    public function fileImport(Request $request)
    {
        Excel::import(new TracksImport($request['date']), $request->file('file')->store('temp'));
        return back()->with('message', 'Трек коды успешно добавлены');
    }

    public function result ()
    {
        $chinaTracks = TrackList::select('id', 'to_china', DB::raw("DATE_FORMAT(to_china, '%m') as month_name"))
            ->whereYear('to_china', date('Y'))
            ->groupBy('to_china')
            ->pluck('id', 'month_name');
        $almatyTracks = TrackList::select('id', 'to_almaty', DB::raw("DATE_FORMAT(to_almaty, '%m') as month_name"))
            ->whereYear('to_almaty', date('Y'))
            ->groupBy('to_almaty')
            ->pluck('id', 'month_name');
        $clientTracks = TrackList::select('id', 'to_client', DB::raw("DATE_FORMAT(to_client, '%m') as month_name"))
            ->whereYear('to_client', date('Y'))
            ->groupBy('to_client')
            ->pluck('id', 'month_name');

        $datesTracks = ($chinaTracks)->merge($almatyTracks)->merge($clientTracks)->sortKeys();


        $datesTracks = $datesTracks->toArray();;
        $g = 0;
        $chT = 0;
        $alT = 0;
        $clT = 0;
        foreach ($datesTracks as $dateT => $value){
            $datesTracks[$dateT] = $g;
            $g++;
        }
        $labels = array_flip($datesTracks);

        $data = array();
        $data2 = array();
        $data3 = array();


        foreach ($datesTracks as $dateT => $value){
            $data[$chT] = TrackList::query()->where('to_china', 'LIKE', '%-'.$dateT.'-%')->count();
            $chT++;
        }
        foreach ($datesTracks as $dateT => $value){
            $data2[$alT] = TrackList::query()->where('to_almaty', 'LIKE', '%-'.$dateT.'-%')->count();
            $alT++;
        }
        foreach ($datesTracks as $dateT => $value){
            $data3[$clT] = TrackList::query()->where('to_client', 'LIKE', '%-'.$dateT.'-%')->count();
            $clT++;
        }

        $arr = array(
            '01' => 'Янв.',
            '02' => 'Фев.',
            '03' => 'Март',
            '04' => 'Апр.',
            '05' => 'Май',
            '06' => 'Июнь',
            '07' => 'Июль',
            '08' => 'Авг.',
            '09' => 'Сен.',
            '10.' => 'Окт.',
            '11.' => 'Ноя.',
            '12' => 'Дек.'
        );
        foreach ($labels as $k => $v) {
            $labels[$k] = $arr[$v] ?? $v;
        }
        $data = collect($data);
        $data2 = collect($data2);
        $data3 = collect($data3);

        $chinaTracksDays = TrackList::select('id','to_china', DB::raw("DATE(to_china) as date"))
            ->whereMonth('to_china', Carbon::now()->format('m'))
            ->groupBy('to_china')
            ->pluck('id', 'date');
        $almatyTracksDays = TrackList::select('id','to_almaty', DB::raw("DATE(to_almaty) as date"))
            ->whereMonth('to_almaty', Carbon::now()->format('m'))
            ->groupBy('to_almaty')
            ->pluck('id', 'date');
        $clientTracksDays = TrackList::select('id','to_client', DB::raw("DATE(to_client) as date"))
            ->whereMonth('to_client', Carbon::now()->format('m'))
            ->groupBy('to_client')
            ->pluck('id', 'date');


        $dates = ($chinaTracksDays)->merge($almatyTracksDays)->merge($clientTracksDays)->sortKeys();
        $dates = $dates->toArray();
        $i = 0;
        $ch = 0;
        $al = 0;
        $cl = 0;
        foreach ($dates as $date => $value){
            $dates[$date] = $i;
            $i++;
        }
        $labelsDays = array_flip($dates);

        $dataDays = array();
        $dataDays2 = array();
        $dataDays3 = array();

        foreach ($dates as $date => $value){
            $dataDays[$ch] = TrackList::query()->where('to_china', 'LIKE', $date.'%')->count();
            $ch++;
        }
        foreach ($dates as $date => $value){
            $dataDays2[$al] = TrackList::query()->where('to_almaty', 'LIKE', $date.'%')->count();
            $al++;
        }
        foreach ($dates as $date => $value){
            $dataDays3[$cl] = TrackList::query()->where('to_client', 'LIKE', $date.'%')->count();
            $cl++;
        }

        $dataDays = collect($dataDays);
        $dataDays2 = collect($dataDays2);
        $dataDays3 = collect($dataDays3);





        $clients = User::query()->where('type', null)->count();
        $clients_today = User::query()->where('type', null)->whereDate('created_at',  Carbon::today())->count();
        $clients_false = User::query()->where('type', null)->where('is_active', false)->count();
        $clients_true = User::query()->where('type', null)->where('is_active', true)->count();
        $clients_auth = User::query()->where('type', null)->whereDate('login_date', Carbon::today())->count();


        $tracks_today = ClientTrackList::query()->whereDay('created_at', date('d'))->count();
        $tracks_month = ClientTrackList::query()->whereMonth('created_at', date('m'))->count();
        $tracks_total = ClientTrackList::query()->count();

        $config = Configuration::query()->select('address', 'title_text')->first();
        return view('result', compact('labels', 'data', 'data2', 'data3', 'clients', 'clients_today',
            'clients_false', 'clients_true', 'clients_auth', 'tracks_today', 'tracks_month', 'tracks_total', 'labelsDays',
            'dataDays', 'dataDays2', 'dataDays3', 'config'));
    }
}
