<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Класс User представляет модель пользователя в приложении.
 *
 * Этот класс наследуется от Authenticatable и использует трейт HasFactory и Notifiable.
 * Он определяет свойства, которые можно массово заполнять, скрытые свойства, а также
 * связи с другими моделями.
 */
class User extends Authenticatable
{
    /**
     * Массив атрибутов, которые можно массово заполнять.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Массив атрибутов, которые должны быть скрыты для массивов.
     *
     * @var string[]
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Определяет преобразования типов для атрибутов модели.
     *
     * @return array<string, string> Ассоциативный массив, где ключ — имя атрибута, а значение — тип преобразования.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Определяет связь "один ко многим" с моделью Task.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Экземпляр связи HasMany.
     */
    public function tasks(): HasMany
    {
        return $this -> hasMany(Task::class);
    }
}
