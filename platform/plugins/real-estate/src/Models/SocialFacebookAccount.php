<?php

// SocialFacebookAccount.php

namespace Botble\RealEstate\Models;

use Botble\Base\Models\BaseModel;

class SocialFacebookAccount extends BaseModel
{
  protected $fillable = ['user_id', 'provider_user_id', 'provider'];

  public function user()
  {
      return $this->belongsTo(User::class);
  }
}