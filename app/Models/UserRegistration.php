<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class UserRegistration extends Model {
    protected $table = 'register';
    public $timestamps = true;

    protected $fillable = [
        'name', 'email', 'message', 'attachment',
    ];
}
?>