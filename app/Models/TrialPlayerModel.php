<?php

namespace App\Models;

use CodeIgniter\Model;

class TrialPlayerModel extends Model
{
  protected $table            = 'trial_players';
  protected $primaryKey       = 'id';

  protected $allowedFields    = [
    'name',
    'age',
    'mobile',
    'email',
    'state_id',
    'city',
    'trial_city_id',
    'cricket_type',
    'payment_type',
    'payment_status',
    'balance_amount',
    'is_verified',
    'verified_at',
    't_shirt_given',
    'created_at',
  ];

  protected $beforeInsert = ['setDefaultPaymentStatus'];

  protected function setDefaultPaymentStatus(array $data)
  {
    if (!isset($data['data']['payment_status'])) {
      $data['data']['payment_status'] = 'no_payment';
    }
    if (!isset($data['data']['payment_type'])) {
      $data['data']['payment_type'] = 'none';
    }
    return $data;
  }

  protected $useTimestamps    = true;
  protected $createdField     = 'created_at';
  protected $updatedField     = '';

  protected $returnType       = 'array';

  // No validation applied
  protected $skipValidation   = true;
}
