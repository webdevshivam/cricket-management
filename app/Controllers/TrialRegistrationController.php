<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\QrCodeSettingModel;
use App\Models\TrialcitiesModel;
use App\Models\TrialPlayerModel;
use CodeIgniter\HTTP\ResponseInterface;
use TCPDF;

class TrialRegistrationController extends BaseController
{
    public function index()
    {
        // Load the view for trial registration
        //all trial city_name

        $model = new TrialcitiesModel();
        $qrCodeSetting = new QrCodeSettingModel();
        $data['qr_code_setting'] = $qrCodeSetting->first();
        $data['trial_cities'] = $model->where('status', 'enabled')->findAll();
        return view('frontend/trial/registration', $data);
    }
    public function register()
    {
        //get form data
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'mobile' => $this->request->getPost('phone'),
            'age' => $this->request->getPost('age'),
            'state_id' => $this->request->getPost('state'),
            'city' => $this->request->getPost('city'),
            'trial_city_id' => $this->request->getPost('trialCity'),
            'cricket_type' => $this->request->getPost('cricket_type'),
        ];
        $model = new TrialPlayerModel();
        if ($model->insert($data) === false) {
            echo "Error: " . $model->errors();
        } else {
            return redirect()->to('/trial-registration')->with('success', 'Registration successful!');
        }
    }

    public function adminIndex()
    {

        $model = new \App\Models\TrialPlayerModel();


        $data['registrations'] = $model->orderBy('id', 'DESC')->paginate(10);
        $data['pager'] = $model->pager;

        return view('admin/trial/registration', $data);
    }

    public function verify()
    {
        $mobile = $this->request->getPost('mobile');
        
        if (!$mobile) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Mobile number is required'
            ]);
        }
        
        $model = new TrialPlayerModel();
        $player = $model->where('mobile', $mobile)->first();
        
        if (!$player) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Player not found with this mobile number'
            ]);
        }
        
        // Calculate cricket type fees
        $fees = $this->getCricketTypeFees($player['cricket_type']);
        $balanceAmount = 0;
        
        if ($player['payment_type'] === 'partial') {
            $balanceAmount = $fees - 199;
        }
        
        return $this->response->setJSON([
            'success' => true,
            'player' => $player,
            'balance_amount' => $balanceAmount,
            'total_fees' => $fees
        ]);
    }
    
    public function updateVerification()
    {
        $data = $this->request->getPost();
        $model = new TrialPlayerModel();
        
        $updateData = [
            'is_verified' => 1,
            'verified_at' => date('Y-m-d H:i:s'),
            't_shirt_given' => isset($data['t_shirt_given']) ? 1 : 0,
            'payment_status' => $data['payment_status'] ?? 'pending'
        ];
        
        if ($model->update($data['player_id'], $updateData)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Player verification updated successfully'
            ]);
        }
        
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Failed to update verification'
        ]);
    }
    
    private function getCricketTypeFees($cricketType)
    {
        $fees = [
            'bowler' => 999,
            'batsman' => 999,
            'wicket-keeper' => 1199,
            'all-rounder' => 1199
        ];
        
        return $fees[$cricketType] ?? 999;
    }

    public function verificationDashboard()
    {
        $model = new TrialPlayerModel();
        
        $data['total_players'] = $model->countAll();
        $data['verified_players'] = $model->where('is_verified', 1)->countAllResults(false);
        $data['pending_verification'] = $model->where('is_verified', 0)->countAllResults(false);
        $data['partial_payment'] = $model->where('payment_type', 'partial')->countAllResults(false);
        $data['full_payment'] = $model->where('payment_type', 'full')->countAllResults(false);
        
        return view('admin/trial/verification_dashboard', $data);
    }
    
    public function getPlayers()
    {
        $model = new TrialPlayerModel();
        $paymentType = $this->request->getGet('payment_type');
        
        if ($paymentType && in_array($paymentType, ['partial', 'full'])) {
            $model->where('payment_type', $paymentType);
        }
        
        $players = $model->orderBy('created_at', 'DESC')->findAll();
        
        return $this->response->setJSON([
            'success' => true,
            'players' => $players
        ]);
    }

    public function updateSingle()
    {
        $data = $this->request->getPost();
        $model = new TrialPlayerModel();
        
        $updateData = [];
        if (isset($data['payment_type'])) {
            $updateData['payment_type'] = $data['payment_type'];
        }
        if (isset($data['payment_status'])) {
            $updateData['payment_status'] = $data['payment_status'];
        }
        
        if (empty($updateData)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'No data to update'
            ]);
        }
        
        if ($model->update($data['player_id'], $updateData)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Player updated successfully'
            ]);
        }
        
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Failed to update player'
        ]);
    }
    
    public function bulkUpdate()
    {
        $data = $this->request->getPost();
        $playerIds = json_decode($data['player_ids'], true);
        
        if (empty($playerIds)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'No players selected'
            ]);
        }
        
        $model = new TrialPlayerModel();
        $updateData = [];
        
        if (!empty($data['payment_type'])) {
            $updateData['payment_type'] = $data['payment_type'];
        }
        if (!empty($data['payment_status'])) {
            $updateData['payment_status'] = $data['payment_status'];
        }
        
        if (empty($updateData)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'No data to update'
            ]);
        }
        
        $updated = 0;
        foreach ($playerIds as $playerId) {
            if ($model->update($playerId, $updateData)) {
                $updated++;
            }
        }
        
        return $this->response->setJSON([
            'success' => $updated > 0,
            'message' => "Updated {$updated} players successfully"
        ]);
    }
    
    public function bulkDelete()
    {
        $data = $this->request->getPost();
        $playerIds = json_decode($data['player_ids'], true);
        
        if (empty($playerIds)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'No players selected'
            ]);
        }
        
        $model = new TrialPlayerModel();
        $deleted = 0;
        
        foreach ($playerIds as $playerId) {
            if ($model->delete($playerId)) {
                $deleted++;
            }
        }
        
        return $this->response->setJSON([
            'success' => $deleted > 0,
            'message' => "Deleted {$deleted} players successfully"
        ]);
    }

    public function exportPdf()
    {
        $model = new TrialPlayerModel();
        $registrations = $model->orderBy('id', 'DESC')->findAll();

        // Create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator('MPCL Cricket League');
        $pdf->SetAuthor('Admin');
        $pdf->SetTitle('Trial Registrations Report');
        $pdf->SetSubject('Trial Registrations');

        // Set default header data
        $pdf->SetHeaderData('', 0, 'MPCL Trial Registrations', 'Generated on ' . date('Y-m-d H:i:s'));

        // Set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // Set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // Set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // Set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // Add a page
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('helvetica', '', 10);

        // Create HTML content
        $html = '<h2 style="text-align: center; color: #333;">Trial Registrations Report</h2>';
        $html .= '<table border="1" cellpadding="5" cellspacing="0" style="width: 100%;">';
        $html .= '<thead>';
        $html .= '<tr style="background-color: #f8f9fa;">';
        $html .= '<th><strong>S.No</strong></th>';
        $html .= '<th><strong>Name</strong></th>';
        $html .= '<th><strong>Email</strong></th>';
        $html .= '<th><strong>Mobile</strong></th>';
        $html .= '<th><strong>Age</strong></th>';
        $html .= '<th><strong>City</strong></th>';
        $html .= '<th><strong>Cricket Type</strong></th>';
        $html .= '<th><strong>Registered On</strong></th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        $i = 1;
        foreach ($registrations as $reg) {
            $html .= '<tr>';
            $html .= '<td>' . $i++ . '</td>';
            $html .= '<td>' . htmlspecialchars($reg['name']) . '</td>';
            $html .= '<td>' . htmlspecialchars($reg['email']) . '</td>';
            $html .= '<td>' . htmlspecialchars($reg['mobile']) . '</td>';
            $html .= '<td>' . htmlspecialchars($reg['age']) . '</td>';
            $html .= '<td>' . htmlspecialchars($reg['city']) . '</td>';
            $html .= '<td>' . htmlspecialchars($reg['cricket_type']) . '</td>';
            $html .= '<td>' . date('d M Y', strtotime($reg['created_at'] ?? '')) . '</td>';
            $html .= '</tr>';
        }

        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '<br><p style="text-align: center; font-size: 10px; color: #666;">Total Registrations: ' . count($registrations) . '</p>';

        // Print text using writeHTMLCell()
        $pdf->writeHTML($html, true, false, true, false, '');

        // Close and output PDF document
        $filename = 'trial_registrations_' . date('Y-m-d_H-i-s') . '.pdf';
        $pdf->Output($filename, 'D'); // 'D' forces download
    }
}
