<?php

namespace App\Http\Controllers;

use App\Models\ClientTrackList;
use App\Models\Configuration;
use App\Models\Message;
use App\Models\QrCodes;
use App\Models\TrackList;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index ()
    {

        if (Auth::user()->is_active === 1 && Auth::user()->type === null){
            $tracks = ClientTrackList::query()
                ->leftJoin('track_lists', 'client_track_lists.track_code', '=', 'track_lists.track_code')
                ->select( 'client_track_lists.track_code', 'client_track_lists.detail', 'client_track_lists.created_at',
                    'track_lists.to_china','track_lists.to_almaty','client_track_lists.id','track_lists.to_client','track_lists.client_accept','track_lists.status')
                ->where('client_track_lists.user_id', Auth::user()->id)
                ->where('client_track_lists.status',null)
                ->orderByDesc('client_track_lists.id')
                ->get();
            $config = Configuration::query()->select('address', 'title_text', 'address_two')->first();
            $count = count($tracks);

            $messages = Message::all();

            return view('dashboard')->with(compact('tracks', 'count', 'messages', 'config'));
        }elseif (Auth::user()->is_active === 1 && Auth::user()->type === 'stock'){
            $config = Configuration::query()->select('address', 'title_text', 'address_two')->first();
            $qr = QrCodes::query()->select()->where('id', 1)->first();
            $count = TrackList::query()->whereDate('created_At', Carbon::today())->count();
            return view('stock')->with(compact('count', 'config', 'qr'));
        }elseif (Auth::user()->is_active === 1 && Auth::user()->type === 'almatyin'){
            $config = Configuration::query()->select('address', 'title_text', 'address_two')->first();
            $qr = QrCodes::query()->select()->where('id', 1)->first();
            $count = TrackList::query()->whereDate('to_almaty', Carbon::today())->count();
            return view('almaty')->with(compact('count', 'config', 'qr'));
        }elseif (Auth::user()->is_active === 1 && Auth::user()->type === 'almatyout'){
            $config = Configuration::query()->select('address', 'title_text', 'address_two')->first();
            $qr = QrCodes::query()->select()->where('id', 1)->first();
            $count = TrackList::query()->whereDate('to_client', Carbon::today())->count();
            return view('almatyout')->with(compact('count', 'config', 'qr'));
        }elseif (Auth::user()->is_active === 1 && Auth::user()->type === 'othercity'){
            $config = Configuration::query()->select('address', 'title_text', 'address_two')->first();
            $qr = QrCodes::query()->select()->where('id', 1)->first();
            $count = TrackList::query()->whereDate('to_client', Carbon::today())->count();
            return view('othercity')->with(compact('count', 'config', 'qr'));
        }elseif (Auth::user()->is_active === 1 && Auth::user()->type === 'admin' || Auth::user()->is_active === 1 && Auth::user()->type === 'moderator'){
            $messages = Message::all();
            $config = Configuration::query()->select('address', 'title_text', 'address_two')->first();
            $search_phrase = '';
            $users = User::query()->select('id', 'name', 'surname', 'type', 'login', 'city', 'is_active', 'block', 'code', 'password', 'created_at')->where('type', null)->where('is_active', false)->get();
            return view('admin')->with(compact('users', 'messages', 'search_phrase', 'config'));
        }
        $config = Configuration::query()->select('whats_app', 'title_text', 'address_two')->first();
        return view('register-me')->with(compact( 'config'));
    }

    public function archive ()
    {
            $tracks = ClientTrackList::query()
                ->leftJoin('track_lists', 'client_track_lists.track_code', '=', 'track_lists.track_code')
                ->select( 'client_track_lists.track_code', 'client_track_lists.detail', 'client_track_lists.created_at',
                    'track_lists.to_china','track_lists.to_almaty','track_lists.to_client','track_lists.client_accept','track_lists.status')
                ->where('client_track_lists.user_id', Auth::user()->id)
                ->where('client_track_lists.status', '=', 'archive')
                ->get();
        $config = Configuration::query()->select('address', 'title_text', 'address_two')->first();
            $count = count($tracks);
            return view('dashboard')->with(compact('tracks', 'count', 'config'));
    }



}
