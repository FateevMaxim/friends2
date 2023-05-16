<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Configuration;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $config = Configuration::query()->select('address', 'title_text', 'address_two')->first();
        return view('profile.edit', [
            'user' => $request->user(),
            'config' => $config,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function deleteClient (Request $request)
    {
        User::destroy($request['id']);
        return redirect('dashboard')->with('message', 'Клиент удалён');
    }

    public function blockClient (Request $request)
    {
        $user = User::find($request['id']);
        !$user->block ? $user->block = true : $user->block = null;
        $user->save();
        return redirect('dashboard')->with('message', 'Блокировка обновлена');
    }

    public function editClient (Request $request)
    {
        $user = User::find($request['userId']);
        $user->city = $request['editCity'];
        $user->save();
        return redirect('dashboard')->with('message', 'Город клиента изменён');
    }

    public function searchClient (Request $request)
    {
        $users = User::query()->where('login', 'LIKE', '%'.$request->phone.'%')->orWhere('code', 'LIKE', '%'.$request->phone.'%')->get();
        $messages = Message::all();
        $search_phrase = $request->phone;
        $config = Configuration::query()->select('address', 'title_text', 'address_two')->first();
        return view('admin')->with(compact('users', 'messages', 'search_phrase', 'config'));
    }

    public function accessClient (Request $request)
    {
        $user = User::find($request['id']);
        !$user->is_active ? $user->is_active = true : $user->is_active = false;
        $user->save();
        return redirect('dashboard')->with('message', 'Доступ обновлён');
    }


    public function deleteMessage (Request $request)
    {
        Message::destroy($request['id']);
        return redirect()->back()->with('message', 'Сообщение удалено');
    }
    public function addMessage (Request $request)
    {
        $message = new Message();
        $message->message = $request['message'];
        $message->save();
        return redirect('dashboard')->with('message', 'Сообщение отправлено');
    }
}
