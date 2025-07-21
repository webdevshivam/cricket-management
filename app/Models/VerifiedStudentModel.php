
<?php

namespace App\Models;

use CodeIgniter\Model;

class VerifiedStudentModel extends Model
{
    protected $table            = 'verified_students';
    protected $primaryKey       = 'id';

    protected $allowedFields    = [
        'original_trial_id',
        'name',
        'email',
        'mobile',
        'age',
        'city',
        'cricket_type',
        'payment_status',
        'balance_amount',
        'verified_at',
        't_shirt_given',
        'moved_at',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    protected $returnType       = 'array';

    protected $skipValidation   = true;

    public function moveFromTrialPlayer($trialPlayer)
    {
        $data = [
            'original_trial_id' => $trialPlayer['id'],
            'name' => $trialPlayer['name'],
            'email' => $trialPlayer['email'],
            'mobile' => $trialPlayer['mobile'],
            'age' => $trialPlayer['age'],
            'city' => $trialPlayer['city'],
            'cricket_type' => $trialPlayer['cricket_type'],
            'payment_status' => $trialPlayer['payment_status'],
            'balance_amount' => $trialPlayer['balance_amount'] ?? 0,
            'verified_at' => $trialPlayer['verified_at'],
            't_shirt_given' => $trialPlayer['t_shirt_given'] ?? 0,
            'moved_at' => date('Y-m-d H:i:s')
        ];

        return $this->insert($data);
    }

    public function getByPaymentStatus($status)
    {
        return $this->where('payment_status', $status)->orderBy('moved_at', 'DESC')->findAll();
    }

    public function updatePaymentStatus($id, $status)
    {
        $updateData = ['payment_status' => $status];

        if ($status === 'full') {
            $updateData['balance_amount'] = 0;
        }

        return $this->update($id, $updateData);
    }
}
