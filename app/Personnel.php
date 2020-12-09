<?php namespace App;


use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;



class Personnel extends Authenticatable implements JWTSubject {
use Notifiable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'personnels';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nom','prenom','photo','email', 'password'];
	protected $hidden = [

	'password', 'remember_token',

	];
	 public function getAuthPassword()
    {
        return $this->password;
    }
	public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    /**
     * Get the presentation linked to this personnel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function presentations(){
        return $this->belongsToMany('App\Presentation')->select('presentations.*');
    }

    public function groupes(){
        return $this->belongsToMany('App\Groupe');
    }
}
