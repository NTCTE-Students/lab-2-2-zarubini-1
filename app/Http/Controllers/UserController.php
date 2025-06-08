<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Регистрирует нового пользователя.
     *
     * @param \Illuminate\Http\Request $request HTTP-запрос, содержащий данные для регистрации пользователя.
     *
     * @return \Illuminate\Http\RedirectResponse Редирект на главную страницу после успешной регистрации.
     *
     * @throws \Illuminate\Validation\ValidationException Если данные запроса не проходят валидацию.
     */
    public function register(Request $request): RedirectResponse
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Create a new user instance
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash the password
        ]);

        return redirect()
            -> route('index');
    }

    /**
     * Выполняет вход пользователя в систему.
     *
     * @param \Illuminate\Http\Request $request HTTP-запрос, содержащий данные для входа.
     *
     * @return \Illuminate\Http\RedirectResponse Редирект на главную страницу при успешном входе
     * либо возврат на предыдущую страницу при неудачной попытке.
     *
     * @throws \Illuminate\Validation\ValidationException Если данные запроса не проходят валидацию.
     */
    public function login(Request $request): RedirectResponse
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Attempt to log the user in
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()
                -> route('index');
        }

        return redirect()
            -> back();
    }

    /**
     * Завершает сеанс аутентификации пользователя и перенаправляет на главную страницу.
     *
     * @return \Illuminate\Http\RedirectResponse Ответ с перенаправлением на маршрут 'index'.
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();

        return redirect()
            -> route('index');
    }

    public function index(Request $request): View
    {
        if (Auth::check()) {

            $user_tasks = Auth::user() -> tasks();

            if ($request -> input('status_filter') && in_array($request -> input('status_filter'), ['in_progress', 'pending', 'complete'])) {
                $user_tasks -> where('status', $request -> input('status_filter'));
            }
            if ($request -> input('order_by')) {
                if ($request -> input('order_by') == 'date_desc') {
                    $user_tasks -> orderByDesc('created_at');
                }
            }
            if ($request -> input('find')) {
                $user_tasks -> where('title', $request ->input('find')) -> get();
            }

            return view('index', [
                'user_tasks' => $user_tasks,
            ]);
        } else {
            return view('index', [
                'user_tasks' => null,
            ]);
        }
    }
}
