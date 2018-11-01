<?php

namespace Domain\Base\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Artesaos\Defender\Traits\HasDefender;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BaseAuthModel extends Authenticatable implements JWTSubject
{
    use BaseModelTrait;
    use HasDefender;

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
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

    public function getRememberToken()
    {
        return null; // not supported
    }

    public function setRememberToken($value)
    {
        // not supported
    }

    public function getRememberTokenName()
    {
        return null; // not supported
    }

    /**
     * Overrides the method to ignore the remember token.
     */
    public function setAttribute($key, $value)
    {
        $isRememberTokenAttribute = $key == $this->getRememberTokenName();
        if (!$isRememberTokenAttribute) {
            parent::setAttribute($key, $value);
        }
    }
}
